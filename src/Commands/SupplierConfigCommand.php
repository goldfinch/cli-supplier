<?php

namespace Goldfinch\CLISupplier\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'vendor:cli-supplier:config')]
class SupplierConfigCommand extends GeneratorCommand
{
    protected static $defaultName = 'vendor:cli-supplier:config';

    protected $description = 'Create CLI Supplier YML config';

    protected $path = 'app/_config';

    protected $type = 'config';

    protected $stub = './stubs/config.stub';

    protected $extension = '.yml';
}
