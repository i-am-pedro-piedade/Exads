<?php

namespace App\Service;

class Divisors
{
    /**
     * @param int $min
     * @param int $max
     * @return array<int, array<string, array<int>|int>>
     */
    public function generateNumbersAndDivisors(int $min = 1, int $max = 100): array
    {
        $numbers = [];
        for ($i = $min; $i <= $max; $i++) {
            $numbers[] = [
                'number' => $i,
                'divisors' => $this->findAllDivisorsOf($i)
            ];
        }
        return $numbers;
    }

    /**
     * @param int $number
     * @return int[]
     */
    private function findAllDivisorsOf(int $number): array
    {
        // Optimization: calculate up to the square root of the number and add complementary factors
        $max = sqrt($number);
        // 1 and the number itself are always divisors innit
        $divisors = [1, $number];
        for ($i = 2; $i <= $max; $i++) {
            if ($number % $i === 0) {
                $divisors[] = $i;
                $complementaryFactor = intval($number / $i);
                if ($complementaryFactor !== $i) {
                    $divisors[] = $complementaryFactor;
                }
            }
        }
        sort($divisors);
        return $divisors;
    }
}
