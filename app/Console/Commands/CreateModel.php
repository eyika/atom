<?php

namespace App\Console\Commands;

use Eyika\Atom\Framwork\Foundation\Console\Command;
use Eyika\Atom\Framework\Support\Str;

class CreateModel extends Command
{
    public function handle(array $arguments = [])
    {
        $name = str::pascal($arguments[0] ?? '');
        $name_lower = Str::plural(Str::snake($name));
        $model_folder = strtolower(PHP_OS_FAMILY) === "windows" ? __DIR__."\\..\\..\\Models\\" : __DIR__."/../../Models/";
        
        $model_template = "<?php

namespace App\Models;

use App\Models\Model;

final class {$name} extends Model
{
    // Model implementation here
}
";
        if (file_exists($model_folder.$name.'.php')) {
            $this->error("Model with name $name already exists");
            return;
        }
        file_put_contents($model_folder.$name.'.php', $model_template);
        $this->info("Model with name $name created successfully");
    }
}
