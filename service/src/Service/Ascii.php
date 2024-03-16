<?php

namespace App\Service;

use App\Model\Ascii\AsciiList;

class Ascii
{
    public function generate(int $numberOfCharsToRemove = 1): AsciiList
    {
        $ascii = new AsciiList();
        $resultList = $this->removeArbitraryChars($ascii->getOriginalList(), $numberOfCharsToRemove);
        $ascii->setResultList($resultList);
        $ascii->setDifference($this->calculateDifference($ascii->getOriginalList(), $ascii->getResultList()));
        return $ascii;
    }

    /**
     * @param array<string> $list
     * @param int $numberOfCharsToRemove
     * @return array<string>
     */
    private function removeArbitraryChars(array $list, int $numberOfCharsToRemove = 1): array
    {
        for ($i = 1; $i <= $numberOfCharsToRemove; $i++) {
            unset($list[array_rand($list)]);
        }
        return $list;
    }

    /**
     * @param array<string> $list1
     * @param array<string> $list2
     * @return array<string>
     */
    private function calculateDifference(array $list1, array $list2): array
    {
        // A native PHP function is likely the most efficient method for checking the difference between two arrays
        return array_diff($list1, $list2);
    }
}
