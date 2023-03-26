<?php

namespace App\Services;

use Wonde\Client;
use Illuminate\Support\Facades\Cache;

/**
 * Service function to fetch data for timetable display.
 */
class Timetable {

    /**
     * Seconds to cache responses from the API.
     */
    const CACHE_LIFETIME = 3600;

    /**
     * The school as provided by the API.
     *
     * @var object
     */
    protected $school;

    public function __construct(Client $client)
    {
        $this->school = $client->school(config('services.client.school_id'));
    }

    /**
     * Get an employee with their classes using an employee id.
     *
     * @param string $id
     *   The id of the employee.
     * @return object
     *
     * @throws Exception
     */
    public function getEmployee($id)
    {
        $employee = Cache::remember($id . '-employee', static::CACHE_LIFETIME, function() use ($id) {
            try {
                $employee = $this->school->employees->get($id, ['classes']);
            } catch (\Exception $e) {
                echo "Did you use a valid employee id?\n";
                echo $e->getMessage();
                exit();
            }
            return $employee;
        });

        return $employee;
    }

    /**
     * Get the full name of an employee using an employee id.
     *
     * @param string $id
     *   The id of the employee.
     * @return string
     *   Forename and surname of the employee.
     */
    public function getEmployeeName($id)
    {
        $employee = $this->getEmployee($id);
        return $employee->forename . ' ' . $employee->surname;
    }

    /**
     * Get the classes of an employee.
     *
     * @param object $employee
     * @return array
     *   An array of classes associated with an employee.
     */
    public function getClasses($employee)
    {
        $classesWithLessons = Cache::remember($employee->id . '-classes', static::CACHE_LIFETIME, function () use ($employee) {
            foreach ($employee->classes->data as $class) {
                $classesWithLessons[] = $this->school->classes->get($class->id, ['lessons', 'students']);
            }
            return $classesWithLessons;
        });

        return $classesWithLessons;
    }

    /**
     * Build a timetable, ordered by lesson date and time.
     *
     * @param array $classes
     * @return array
     *   An array of lessons keyed and ordered by lesson time.
     */
    public function buildTimeTable($classes) {
        foreach ($classes as $class) {
            foreach ($class->lessons->data as $lesson) {
                $startTime = strtotime($lesson->start_at->date);
                $timetable[$startTime] = [
                    'start_at' => date('jS M Y \a\t G:i', $startTime),
                    'students' => $this->sortStudents($class->students->data),
                ];
            }
        }

        ksort($timetable);
        return $timetable;
    }

    /**
     * Sort an array of students by surname.
     *
     * @param array $students
     * @return array
     */
    public function sortStudents($students) {
        $studentList = [];
        foreach ($students as $student) {
            $studentList[$student->surname] = $student;
        }

        ksort($studentList);
        return $studentList;
    }

    /**
     * Get an employee timetable using and employee id.
     *
     * @param string $id
     * @return array
     *   An array of lessons keyed and ordered by lesson time.
     */
    public function getTimeTable($id)
    {
        $employee = $this->getEmployee($id);
        $classes = $this->getClasses($employee);
        $timetable = $this->buildTimeTable($classes);

        return $timetable;
    }
}
