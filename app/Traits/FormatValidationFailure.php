<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FormatValidationFailure
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $codes = method_exists($this, 'codes') ? self::codes() : [];

        $formatted = collect($errors->getMessages())->flatMap(function ($messages, $field) use ($codes) {
            return collect($messages)->map(function ($message) use ($field, $codes) {
                return [
                    'message' => $message,
                    'code' => $codes[self::getRuleKey($field, $message)] ?? $codes[$field] ?? 'UMP-0200-0000',
                ];
            });
        })->values();

        throw new HttpResponseException(response()->json($formatted, 406));
    }

    protected function getRuleKey(string $field, string $message): string
    {
        $messages = method_exists($this, 'messages') ? self::messages() : [];

        foreach ($messages as $ruleKey => $msg) {
            if ($msg === $message) {
                return $ruleKey;
            }
        }

        return $field;
    }
}
