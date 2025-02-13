<?php
/**
 * Contains the BaseClassTest class.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     GPL
 *
 * @since       2017-12-15
 */

namespace Pyromn\PdfGiftCard\Tests;

use PHPUnit\Framework\TestCase;
use Pyromn\PdfGiftCard\GiftCardPrinter;

class BaseClassTest extends TestCase
{
    /**
     * @test
     */
    public function can_be_instantiated()
    {
        $invoicr = new GiftCardPrinter();

        $this->assertInstanceOf(GiftCardPrinter::class, $invoicr);
    }
}
