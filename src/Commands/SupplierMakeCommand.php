<?php

namespace Goldfinch\CLISupplier\Commands;

use Symfony\Component\Finder\Finder;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;

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
        $supplierName = $input->getArgument('name');
        $shortname = $input->getArgument('shortname');

        if (!$shortname) {
            $shortname = strtolower($supplierName);
        }

        $supplierName = 'App\Console\Suppliers\\' . $supplierName . $this->prefix; // TODO

        if (!$this->setSupplierInConfig($supplierName, $shortname)) {
            // create config

            $command = $this->getApplication()->find('vendor:cli-supplier:config');

            $arguments = [
                'name' => 'cli-supplier',
            ];

            $greetInput = new ArrayInput($arguments);
            $returnCode = $command->run($greetInput, $output);

            $this->setSupplierInConfig($supplierName, $shortname);
        }

        parent::execute($input, $output);

        return Command::SUCCESS;
    }

    private function setSupplierInConfig($supplierName, $shortname)
    {
        $rewritten = false;

        $finder = new Finder();
        $files = $finder->in(BASE_PATH . '/app/_config')->files()->contains('Goldfinch\CLISupplier\Controllers\CLISupplierController:');

        foreach ($files as $file) {

            // stop after first replacement
            if ($rewritten) {
                break;
            }

            if (strpos($file->getContents(), 'registered_supplies') !== false) {

                $ucfirst = ucfirst($supplierName);

                if ($shortname) {
                    $supplierLine = $shortname.': '.$supplierName;
                } else {
                    // not reachable at the moment as we modifying $shortname if it's not presented
                    $supplierLine = '- ' . $supplierName;
                }

                $newContent = $this->addToLine(
                    $file->getPathname(),
                    'registered_supplies:','    '.$supplierLine,
                );

                file_put_contents($file->getPathname(), $newContent);

                $rewritten = true;
            }
        }

        return $rewritten;
    }

    public function configure(): void
    {
        $this->addArgument(
            'name',
            InputArgument::REQUIRED,
            'The name class of the ' . strtolower($this->type)
       );

       $this->addArgument(
            'shortname',
            InputArgument::OPTIONAL,
       );
    }
}
