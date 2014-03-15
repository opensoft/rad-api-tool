<?php
/**
 * This file is part of the Rad Api Tool.
 *
 * Copyright (c) OpenSoft (http://www.opensoftdev.ru)
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Opensoft\RadApiTool;

use Symfony\Component\Console\Output\ConsoleOutputInterface;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class ConsoleDump implements DumpInterface
{
    /**
     * @var ConsoleOutputInterface
     */
    private $output;

    /**
     * @param ConsoleOutputInterface $consoleOutput
     */
    public function __construct(ConsoleOutputInterface $consoleOutput)
    {
        $this->output = $consoleOutput;
    }

    /**
     * @param string $path
     * @param string $content
     */
    public function dump($path, $content)
    {
        $this->output->writeln(sprintf('File: "%s":', $path));
        $this->output->writeln($content);
    }
}
