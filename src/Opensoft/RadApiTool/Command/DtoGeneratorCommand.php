<?php

/**
 * This file is part of the Rad Api Tool.
 *
 * Copyright (c) OpenSoft (http://www.opensoftdev.ru)
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Opensoft\RadApiTool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Opensoft\RadApiTool\ConsoleDump;
use Opensoft\RadApiTool\DumpInterface;
use Opensoft\RadApiTool\FileDump;
use Opensoft\RadApiTool\Generator;

/**
 * Class RoutesGeneratorCommand
 * @package Opensoft\RadApiTool\Command
 */
class DtoGeneratorCommand extends Command
{
    protected function configure()
    {
        $this->setName("rad-api-tool:generate:dto")
            ->setDescription("Generates DTO file")
            ->addArgument(
                'output_filename',
                InputArgument::REQUIRED,
                "Output filename with relative path"
            )
            ->addOption(
                'dry-run',
                'd',
                InputOption::VALUE_NONE,
                'Generate and print to console DTO file, without actually writing to a file'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('dry-run')) {
            $resultOutput = new ConsoleDump($output);
        } else {
            $resultOutput = new FileDump();
        }
        $outputFilename = $input->getArgument('output_filename');
        $generator = new Generator();
        /** @var DialogHelper $helper */
        $helper = $this->getHelperSet()->get('dialog');
        $className = $helper->ask(
            $output,
            'Enter fully qualified class name (Acme\Entity):',
            'Acme\Entity'
        );
        $property = 'id';
        $properties = array();
        while (true) {
            $property = $helper->ask(
                $output,
                "Enter property name ($property):",
                $property
            );
            if (!$property) {
                break;
            }
            $type = $helper->ask(
                $output,
                'Enter type (integer):',
                'integer'
            );
            $properties[$property] = $type;
            $property = '';
        }
        $result = $generator->dtoGenerator($className, $properties);
        $resultOutput->dump($outputFilename, $result);

        return 0;
    }
}
