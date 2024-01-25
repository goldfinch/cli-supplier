<?php

namespace Goldfinch\Mill\Commands;

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

    protected $type = 'mill';

    protected $stub = './stubs/supplier.stub';

    protected $prefix = 'Supplier';

    protected function execute($input, $output): int
    {
        $supplierName = $input->getArgument('name');
        $target = $input->getArgument('target');

        if (!$this->setMillInConfig($supplierName, $target)) {
            // create config

            $command = $this->getApplication()->find('vendor:cli-supplier:config');

            $arguments = [
                'name' => 'cli-supplier',
            ];

            $greetInput = new ArrayInput($arguments);
            $returnCode = $command->run($greetInput, $output);

            $this->setMillInConfig($supplierName, $target);
        }

        parent::execute($input, $output);

        return Command::SUCCESS;
    }

    private function setMillInConfig($supplierName, $target)
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

                $newContent = $this->addToLine(
                    $file->getPathname(),
                    'registered_supplies:','    '.$supplierName.': '.$target,
                );

                file_put_contents($file->getPathname(), $newContent);

                $rewritten = true;
            }
        }

        return $rewritten;
    }

    // protected function getArguments()
    // {
    //     return [
    //         [
    //             'name',
    //             InputArgument::REQUIRED,
    //             'The name of the ' . strtolower($this->type),
    //         ],
    //         [
    //             'natargetme',
    //             InputArgument::REQUIRED,
    //             'The target class of the ' . strtolower($this->type),
    //         ],
    //     ];
    // }

    // protected function promptForMissingArgumentsUsing()
    // {
    //     return [
    //         'name' => 'What should the ' . strtolower($this->type) . ' be named?',
    //         'target' => 'What is the target of ' . strtolower($this->type) . '? Use full namespace path to the class',
    //     ];
    // }

    public function configure(): void
    {
        $this->addArgument(
            'name',
            InputArgument::REQUIRED,
            'The target class of the ' . strtolower($this->type)
       );

       $this->addArgument(
            'target',
            InputArgument::REQUIRED,
            'What is the target of ' . strtolower($this->type) . '? Use full namespace path to the class'
       );
    }
}
