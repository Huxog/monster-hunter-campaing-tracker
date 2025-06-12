<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Set main body array for http response
     *
     * @param mixed $data value of the response for the http response
     * @param mixed $metadata value of the response metadata for the http response
     * @return Array

     **/
    public static function arrayResponse(mixed $data, mixed $metadata = []): array
    {
        return [
            'metadata' => $metadata,
            'data' => $data,
        ];;
    }
}
