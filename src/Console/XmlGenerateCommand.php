<?php

declare(strict_types=1);

namespace Hexide\Seo\Console;

use Exception;
use Hexide\Seo\Exceptions\FailedToOpenFileException;
use Hexide\Seo\Exceptions\FailedToWriteToFileException;
use Hexide\Seo\Exceptions\MissingInterfaceException;
use Hexide\Seo\Interfaces\XmlGenerator;
use Hexide\Seo\Models\XmlSitemap;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class XmlGenerateCommand extends Command
{
    protected $signature = 'xml:generate';

    protected $description = 'Command to generate xml sitemaps';

    private array $allowedMimeTypes = ['text/xml', 'application/xml'];

    public function handle(): void
    {
        $hasNewFiles = $this->generateAdditionalSitemaps();

        if ($hasNewFiles) {
            try {
                $this->generateMainSitemap();
            } catch (Exception $e) {
                $message = "XML Sitemap generation for general sitemap - " . $e->getMessage();

                // if command was executed in cron, we have to log errors
                Log::error($message);

                // in case command was executed manually
                $this->error($message);
            }
        }
    }

    /**
     * @throws FailedToOpenFileException
     * @throws FailedToWriteToFileException
     */
    private function generateMainSitemap(): void
    {
        $files = $this->getFilesFromDirectory('public/sitemaps', url('sitemaps'));

        $text = view('seo::partials.sitemap', ['urls' => $files])->render();

        $this->writeToFile($text, 'public/sitemap.xml');
    }

    private function getFilesFromDirectory(string $scanPath, string $sitemapPath): array
    {
        $result = [];
        $files = array_diff(scandir($scanPath), ['.', '..']);
        foreach ($files as $file) {
            if (is_dir($scanPath . '/' . $file)) {
                $result = array_merge(
                    $result,
                    $this->getFilesFromDirectory($scanPath . '/' . $file, $sitemapPath . '/' . $file)
                );
            } elseif (in_array(mime_content_type($scanPath . '/' . $file), $this->allowedMimeTypes)) {
                $result[] = $sitemapPath . '/' . $file;
            }
        }

        return $result;
    }

    private function generateAdditionalSitemaps(): bool
    {
        $sitemaps = XmlSitemap::all();
        $generated = false;
        foreach ($sitemaps as $sitemap) {
            try {
                if ($sitemap->needsUpdate()) {
                    $path = "public/sitemaps/{$sitemap->slug}";
                    $this->update($sitemap, $path);
                    $generated = true;
                    $sitemap->update(['generated_at' => now()]);
                }
            } catch (Exception $e) {
                $message = "XML Sitemap generation for {$sitemap->slug} - " . $e->getMessage();

                // if command was executed in cron, we have to log errors
                Log::error($message);

                // in case command was executed manually
                $this->error($message);
            }
        }

        return $generated;
    }

    /**
     * @throws FailedToOpenFileException
     * @throws FailedToWriteToFileException
     * @throws MissingInterfaceException
     */
    private function update(XmlSitemap $sitemap, string $globalPath): void
    {
        $generator = $sitemap->getGeneratorInstance();

        if (!in_array(XmlGenerator::class, class_implements($generator))) {
            throw new MissingInterfaceException("Generator class {$sitemap->generator} missing XmlGenerator interface");
        }

        if (file_exists($globalPath)) {
            File::deleteDirectory($globalPath);
        }

        File::makeDirectory($globalPath, 0775, true, true);

        $page = 0;

        do {
            $data = $generator->generate(++$page);

            $numOfData = count($data);

            if ($numOfData == 0) {
                break;
            }

            $viewData = [
                'data' => $data,
                'globalChangeFreq' => $sitemap->changefreq,
                'globalPriority' => $sitemap->priority,
            ];
            $text = view('seo::partials.xml', $viewData)->render();

            $this->writeToFile($text, "{$globalPath}/{$page}.xml");

            $shouldContinue = $numOfData == config('hexide-seo.batch_size');
        } while ($shouldContinue);
    }

    /**
     * @throws FailedToOpenFileException
     * @throws FailedToWriteToFileException
     */
    private function writeToFile(string $text, string $path): void
    {
        $stream = fopen($path, 'w');

        if (!$stream) {
            throw new FailedToOpenFileException("Failed to open stream: {$path}");
        }

        $isWritten = fwrite($stream, $text);
        fclose($stream);

        if (!$isWritten) {
            throw new FailedToWriteToFileException("Failed to write to file {$path}");
        }
    }
}
