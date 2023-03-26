<?php

namespace Tests\Unit;

use App\Services\Timetable;
use Tests\TestCase;

/**
 * Test class for Timetable service.
 */
class TimeTableTest extends TestCase
{

    /**
     * Test student sort.
     *
     * @dataProvider sortStudentsProvider
     */
    public function testSortStudents($originalList, $orderedList): void
    {
        $mockClient = $this->createMock('Wonde\Client');

        $timetable = new Timetable($mockClient);
        $this->assertEquals($orderedList, $timetable->sortStudents($originalList));
    }

    /**
     * Dataprovider for testSortStudents
     */
    public function sortStudentsProvider() {
        return [
            [
                [
                    (object)[
                        'surname' => 'Jones',
                    ],
                    (object)[
                        'surname' => 'Atherton',
                    ],
                    (object)[
                        'surname' => 'Williams',
                    ],
                ],
                [
                    'Atherton' => (object)[
                        'surname' => 'Atherton',
                    ],
                    'Jones' => (object)[
                        'surname' => 'Jones',
                    ],
                    'Williams' => (object)[
                        'surname' => 'Williams',
                    ],
                ],
            ],
        ];
    }
}
