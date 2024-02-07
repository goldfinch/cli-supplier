<?php

namespace Goldfinch\CLISupplier\Commands;

use Goldfinch\Taz\Services\InputOutput;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:cli-supplier')]
class SupplierMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:cli-supplier';

    protected $description = 'Create CLI supplier [CLISupplier]';

    protected $path = '[psr4]/Console/Suppliers';

    protected $type = 'supplier';

    protected $stub = './stubs/supplier.stub';

    protected $prefix = 'Supplier';

    protected function execute($input, $output): int
    {
        $state = parent::execute($input, $output);

        if ($state === false) {
            return Command::FAILURE;
        }

        $nameInput = $this->getAttrName($input);

        $shortName = $this->askClassNameQuestion('What [short name] this supplier need to be called by (eg: ' . strtolower($nameInput) . ')', $input, $output, '/^([A-z0-9\_-]+)$/', 'Name can contains letter, numbers, underscore and dash');

        // find config
        $config = $this->findYamlConfigFileByName('app-cli-supplier');

        // create new config if not exists
        if (!$config) {

            $command = $this->getApplication()->find('vendor:cli-supplier:config');
            $command->run(new ArrayInput(['name' => 'cli-supplier']), $output);

            $config = $this->findYamlConfigFileByName('app-cli-supplier');
        }

        // update config
        $this->updateYamlConfig(
            $config,
            'Goldfinch\CLISupplier\Controllers\CLISupplierController' . '.registered_supplies.' . $shortName,
            $this->getNamespaceClass($input)
        );

        if ($state !== false) {
            $io = new InputOutput($input, $output);
            $io->info('To refresh supplier list you might need to run [php taz dev/build]');
        }

        return Command::SUCCESS;
    }
}
