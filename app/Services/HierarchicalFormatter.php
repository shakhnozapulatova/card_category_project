<?php


namespace App\Services;


use App\Exceptions\HierarchicalFormatterException;

class HierarchicalFormatter
{
    /**
     * @param array $flattenList
     * @param string|null $rootIndex
     * @param string $parentKey
     * @param string $primaryKey
     * @param string $childNoodle
     * @return array|iterable
     * @throws HierarchicalFormatterException
     */

    public function formatRecursively(array $flattenList,
                                      string $rootIndex = null,
                                      string $parentKey = 'parent_id',
                                      string $primaryKey = 'id',
                                      $childNoodle = 'children')
    {
        $result = [];

        if (count($flattenList) <= 1) {
            return $flattenList;
        }

        foreach ($flattenList as $element) {
            if (!array_key_exists($primaryKey, $element)) {
                throw new HierarchicalFormatterException('Primary key cannot be empty!');
            }

            if ($element[$primaryKey] === $element[$parentKey]) {
                throw new HierarchicalFormatterException('Parent and primary key cannot be the same');
            }

            $result[$element[$parentKey]][] = array_merge($element, [$childNoodle => &$result[$element[$primaryKey]]]);
        }

        return $result[$rootIndex];
    }
}
