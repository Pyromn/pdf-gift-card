<?php
/**
 * Contains the AAASmokeTest.php class.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     GPL
 *
 * @since       2017-12-15
 */

namespace Pyromn\PdfGiftCard\Tests;

use PHPUnit\Framework\TestCase;

class AAASmokeTest extends TestCase
{
    public const MIN_PHP_VERSION = '5.6.0';

    /**
     * Very Basic smoke test case for testing against parse errors, etc.
     *
     * @test
     */
    public function smoke()
    {
        $this->assertTrue(true);
    }
}
