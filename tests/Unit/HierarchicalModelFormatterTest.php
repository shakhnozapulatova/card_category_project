<?php

namespace Tests\Unit;

use App\Exceptions\HierarchicalFormatterException;
use App\Services\HierarchicalFormatter;
use PHPUnit\Framework\TestCase;

class HierarchicalModelFormatterTest extends TestCase
{

    /**
     * @var HierarchicalFormatter
     */
    private $hierarchicalFormatter;

    public function setUp(): void
    {
        $this->hierarchicalFormatter = new HierarchicalFormatter();
    }

    public function test_recursive_formatter_can_build_5_hierarchical_levels()
    {
        $flattenData = [
            [
                'id' => 1,
                'parent_id' => null,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'parent_id' => 2,
            ],
            [
                'id' => 4,
                'parent_id' => 3,
            ],
            [
                'id' => 5,
                'parent_id' => 4,
            ],
            [
                'id' => 6,
                'parent_id' => null,
            ],
        ];

        $hierarchicalFormattedArray = [
            [
                'id' => 1,
                'parent_id' => null,
                'children' => [
                    [
                        'id' => 2,
                        'parent_id' => 1,
                        'children' => [
                            [
                                'id' => 3,
                                'parent_id' => 2,
                                'children' => [
                                    [
                                        'id' => 4,
                                        'parent_id' => 3,
                                        'children' => [
                                            [
                                                'id' => 5,
                                                'parent_id' => 4,
                                                'children' => null
                                            ]
                                        ]
                                    ],
                                ]
                            ],
                        ]
                    ],
                ],
            ],
            [
                'id' => 6,
                'parent_id' => null,
                'children' => null
            ]
        ];

        $result = $this->hierarchicalFormatter->formatRecursively($flattenData);

        $this->assertEquals($hierarchicalFormattedArray, $result);
    }

    public function test_recursive_formatter_element_parent_key_not_equals_primary_key()
    {
        $flattenData = [
            [
                'id' => 1,
                'parent_id' => 1,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
            ],
        ];

        $this->expectException(HierarchicalFormatterException::class);

        $this->hierarchicalFormatter->formatRecursively($flattenData);
    }

    public function test_recursive_formatter_with_empty_primary_key_fails()
    {
        $missingPrimaryKeyArray = [
            [
                'parent_id' => 1,
            ],
            [
                'id' => 1,
                'parent_id' => 2,
            ]
        ];

        $this->expectException(HierarchicalFormatterException::class);

        $this->hierarchicalFormatter->formatRecursively($missingPrimaryKeyArray);
    }

    public function test_recursive_formatter_with_empty_array_return_the_same_array()
    {
        $emptyArray = [];

        $result = $this->hierarchicalFormatter->formatRecursively($emptyArray);

        $this->assertEquals([], $result);
    }
}
