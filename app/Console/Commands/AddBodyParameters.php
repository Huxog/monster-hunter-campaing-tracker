<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddBodyParameters extends Command
{
    protected $signature = 'scribe:generate-body-params';
    protected $description = 'Add bodyParameters() method to all FormRequest classes that are missing it';

    public function handle(): int
    {
        $requestFiles = File::allFiles(app_path('Http/Requests'));
        $updated = 0;

        foreach ($requestFiles as $file) {
            $path = $file->getRealPath();
            $content = File::get($path);

            // Skip if it already has a bodyParameters() method
            if (strpos($content, 'function bodyParameters(') !== false) {
                continue;
            }

            // Generate a stubbed method
            $stub = <<<EOT

    /**
     * Provide descriptions and examples for the request body parameters.
     *
     * @return array
     */
    public function bodyParameters(): array
    {
        return [
            // 'field_name' => [
            //     'description' => 'Describe the field...',
            //     'example' => 'example_value',
            // ],
        ];
    }

EOT;

            // Insert before the final closing brace
            $updatedContent = preg_replace('/}\s*$/', $stub . "\n}", $content);
            File::put($path, $updatedContent);
            $this->info("✔ Added bodyParameters() to {$file->getFilename()}");
            $updated++;
        }

        $this->line("✅ Finished. Modified {$updated} file(s).");

        return Command::SUCCESS;
    }
}
