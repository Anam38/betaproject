<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CommandMakeRepo extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * Create a new command instance.
     *
     * @return void
     */
     protected function getStub()
      {
          return __DIR__.'/stubs/repo.stub';
      }
      /**
       * Get the default namespace for the class.
       *
       * @param  string  $rootNamespace
       * @return string
       */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }
}
