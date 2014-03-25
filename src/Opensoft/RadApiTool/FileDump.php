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

/**
 * Class FileDump
 *
 * @package Opensoft\RadApiTool
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class FileDump implements DumpInterface
{
    /**
     * @param string $path
     * @param string $content
     */
    public function dump($path, $content)
    {
        file_put_contents($path, $content);
    }
}
