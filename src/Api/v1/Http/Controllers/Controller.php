<?php

declare(strict_types=1);

namespace Hexide\Seo\Api\v1\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * HTTP header status code.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * Illuminate\Http\Request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * Getter for statusCode.
     *
     * @return int
     */
    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode.
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Response with the current error.
     *
     * @param string $message
     *
     * @return mixed
     */
    protected function respondWithError($message)
    {
        return $this->respondWithArray([
            'message' => $message,
            'error' => [
                'http_code' => $this->statusCode,
            ],
        ]);
    }

    /**
     * Generate a Response with a 404 HTTP header and a given message.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function errorNotFound($message = null)
    {
        if (! $message) {
            $message = __('admin_labels.not_found');
        }

        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Respond with a given array of items.
     *
     * @return JsonResponse
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        return response()->json(['data' => $array], $this->statusCode, $headers);
    }
}
