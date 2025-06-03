<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class in app/Services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $serviceName = $this->argument('name');

        // Ensure the name ends with "Service"
        if (!str_ends_with($serviceName, 'Service')) {
            $serviceName .= 'Service';
        }

        $serviceDirectory = app_path('Services');
        $servicePath = "{$serviceDirectory}/{$serviceName}.php";

        // Ensure the directory exists
        if (!File::exists($serviceDirectory)) {
            File::makeDirectory($serviceDirectory, 0755, true);
        }

        // Check if the file already exists
        if (File::exists($servicePath)) {
            $this->fail("The service '{$serviceName}' already exists!");
            return;
        }

        // Service class template
        $template = '<?php

namespace App\Services;

class ' . $serviceName . '
{
    /**
    * Function description
    * @return array
    */
    public static function getAll(): array
    {
        return [];
    }
    /**
    * Function description
    * @param int $id
    * @return array
    */
    public static function getById($id): array
    {
        return [];
    }
    /**
    * Function description
    * @param array $data
    * @return array
    */
    public static function create($data): array
    {
        return [];
    }
    /**
    * Function description
    * @param array $data
    * @param array $id
    * @return array
    */
    public static function update($data, $id): array
    {
        return [];
    }
    /**
    * Function description
    * @param array $id
    * @return array
    */
    public static function delete($id): array
    {
        return [];
    }
}
';

        // Attempt to create file; output status
        File::put($servicePath, $template) ?  $this->info("Service '{$serviceName}' created successfully") : $this->error("Could not create '{$serviceName}'");
    }
}
