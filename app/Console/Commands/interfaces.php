<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class interfaces extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interfaces {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new interface repositories';

    public function getStub() {
        if ($this->signature)
        return app_path() . '/Console/Commands/Stubs/MakeInterface.stub';
    }

    public function getDefaultNamespace($rootNamespace) {
        return $rootNamespace . '\Interfaces';
    }

    public function replaceClass($stub, $name) {
        return str_replace('DummyInterfaces', $this->argument('name'), $stub);
    }
}
