<?php

namespace App\Service;

use Exads\ABTestData;
use Exads\ABTestException;

class ABTestService
{
    protected const EXISTING_IDS = [1, 2, 3];

    /**
     * @return array<ABTestData>
     * @throws ABTestException
     */
    public function getAll(): array
    {
        $list = [];
        foreach (self::EXISTING_IDS as $id) {
            $list[$id] = new ABTestData($id);
        }
        return $list;
    }

    /**
     * @param int $id
     * @return array<string, int|string>|null
     */
    public function getById(int $id): ?array
    {
        try {
            $designs = (new ABTestData($id))->getAllDesigns();
        } catch (ABTestException) {
            return null;
        }
        $selectedPercent = rand(1, 100);
        $accumulatedPercent = 0;
        foreach ($designs as $design) {
            $accumulatedPercent += $design['splitPercent'];
            if ($selectedPercent <= $accumulatedPercent) {
                return $design;
            }
        }
        return null;
    }

    /**
     * @param int $id
     * @param int $testCount
     * @return array<int|string, array<string, float|int|string>>
     */
    public function testDistributionById(int $id, int $testCount = 1000): array
    {
        $distributions = [];
        for ($i = 1; $i <= $testCount; $i++) {
            $design = $this->getById($id);
            if ($design === null) {
                continue;
            }
            $count = isset($distributions[$design['designId']]) ? $distributions[$design['designId']]['occurrences'] + 1 : 1;
            $distribution = [
                'designName' => $design['designName'],
                'splitPercent' => $design['splitPercent'],
                'occurrences' => $count,
                'frequency' => round(($count / $i) * 100, 1),
            ];
            $distributions[$design['designId']] = $distribution;
        }
        ksort($distributions);
        return $distributions;
    }
}
