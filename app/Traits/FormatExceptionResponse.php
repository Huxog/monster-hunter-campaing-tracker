<?php

namespace App\Traits;

use function PHPUnit\Framework\isNull;

trait FormatExceptionResponse
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param string $message The error message to be displayed
     * @param string $code The error message to be displayed
     * @return array
     **/
    public static function formatMessage(string $message, string|null $code = null): array
    {
        return [
                    'message' => $message,
                    'code' => $code ?? 'UMP-0200-0000',
                ];
    }
}
