<?php

declare(strict_types=1);

namespace Hexide\Seo\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class BaseApiController extends BaseController
{
    /**
     * HTTP header status code.
     */
    protected int $statusCode = 200;

    /**
     * Illuminate\Http\Request instance.
     */
    protected Request $request;

    /**
     * Getter for statusCode.
     */
    protected function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode.
     *
     * @param int $statusCode Value to set
     */
    protected function setStatusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Response with the current error.
     */
    protected function respondWithError(string $message): JsonResponse
    {
        return $this->respondWithData([
            'message' => $message,
            'error' => [
                'http_code' => $this->statusCode,
            ],
        ]);
    }

    /**
     * Generate a Response with a 404 HTTP header and a given message.
     */
    protected function errorNotFound(string $message = null): JsonResponse
    {
        if (!$message) {
            $message = __('Not found');
        }

        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Respond with a given array of items wrapped into data key.
     */
    protected function respondWithData(array $array, array $headers = []): JsonResponse
    {
        return $this->respondWithArray(['data' => $array], $headers);
    }

    /**
     * Respond with a given array of items.
     */
    protected function respondWithArray(array $array, array $headers = []): JsonResponse
    {
        return response()->json($array, $this->statusCode, $headers);
    }
}
