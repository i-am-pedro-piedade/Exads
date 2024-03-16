<?php

namespace App\Tests\PhpUnit\Unit\Service;

use App\Service\Ascii;
use App\Tests\PhpUnit\UnitTestCase;

class AsciiTest extends UnitTestCase
{
    public function testAsciiListsAreCorrectTypes(): void
    {
        $ascii = new Ascii();
        $list = $ascii->generate();
        $this->assertIsArray($list->getOriginalList());
        $this->assertIsArray($list->getResultList());
        $this->assertIsArray($list->getDifference());
    }

    public function testRemovedCount(): void
    {
        $ascii = new Ascii();
        $elementsToRemove = 10;
        $list = $ascii->generate($elementsToRemove);
        $this->assertSame(count($list->getResultList()), count($list->getOriginalList()) - $elementsToRemove);
        $this->assertSame(count($list->getDifference()), $elementsToRemove);
    }

    public function testRemovedElementsDoNotExistInResultList(): void
    {
        $ascii = new Ascii();
        $list = $ascii->generate(10);
        $removed = $list->getDifference();
        foreach ($removed as $char) {
            $this->assertFalse(array_search($char, $list->getResultList()));
        }
    }
}
