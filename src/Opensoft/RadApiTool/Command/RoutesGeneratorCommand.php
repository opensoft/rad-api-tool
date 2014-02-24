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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Opensoft\RadApiTool\Generator;

/**
 * @author Anton Volkov <anton.volkov@opensoftdev.ru>
 */
class RoutesGeneratorCommand extends Command
{
    protected function configure()
    {
        $this->setName("rad-api-tool:generate:routes")
            ->setDescription("Generates routes file with provided parameters")
            ->addArgument(
                'vendor_name',
                InputArgument::REQUIRED,
                "Your company name"
            )
            ->addArgument(
                'bundle_name',
                InputArgument::REQUIRED,
                "Name of your bundle"
            )
            ->addArgument(
                'entity_name',
                InputArgument::REQUIRED,
                "Entity name in provided bundle"
            )
            ->addArgument(
                'base_url',
                InputArgument::REQUIRED,
                "Your company name"
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vendorName = $input->getArgument('vendor_name');
        $bundleName = $input->getArgument('bundle_name');
        if (stristr($bundleName, 'bundle')) {
            $bundleName = preg_replace('/(bundle|Bundle)/', '', $bundleName);
        }
        $entityName = $input->getArgument('entity_name');
        $baseUrl = $input->getArgument('base_url');
        $generator = new Generator();
        $generator->generator($vendorName, $bundleName, $entityName, $baseUrl);
        $output->writeln('vendor_name: ' . $input->getArgument('vendor_name'));
        $output->writeln('bundle_name: ' . $input->getArgument('bundle_name'));
        $output->writeln('entity_name: ' . $input->getArgument('entity_name'));
        $output->writeln('base_url: ' . $input->getArgument('base_url'));
    }
}
