<?php

namespace App\Traits;

trait FormatExceptionResponse
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param  string  $message  The error message to be displayed
     * @param  string  $code  The error message to be displayed
     **/
    public static function formatMessage(string $message, ?string $code = null): array
    {
        return [
            'message' => $message,
            'code' => $code ?? 'UMP-0200-0000',
        ];
    }
}
