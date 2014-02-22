#!/usr/bin/env php
<?php

date_default_timezone_set('UTC');

set_time_limit(0);

(@include_once __DIR__ . '/../../../vendor/autoload.php');

use Symfony\Component\Console\Application;
use Opensoft\RadApiTool\Command\RoutesGeneratorCommand;
use Opensoft\RadApiTool\Command\DtoGeneratorCommand;
use Opensoft\RadApiTool\RoutesGenerator;

$application = new Application();
$application->add(new RoutesGeneratorCommand);
$application->add(new DtoGeneratorCommand);
$application->run();
