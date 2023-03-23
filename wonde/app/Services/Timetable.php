<?php

namespace App\Services;

use Wonde\Client;

class Timetable {

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
        try {
            $employee = $this->school->employees->get($id, ['classes']);
        } catch (\Exception $e) {
            echo "Did you use a valid employee id?\n";
            echo $e->getMessage();
            exit();
        }

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
        foreach ($employee->classes->data as $class) {
            $classesWithLessons[] = $this->school->classes->get($class->id, ['lessons', 'students']);
        }

        return $classesWithLessons;
    }


    /**
     * Sort a list of classes by their start time.
     *
     * @param array $classes
     * @return array
     *   An array of lessons keyed and ordered by lesson time.
     */
    public function sortByLesson($classes)
    {
        foreach ($classes as $class) {
            foreach ($class->lessons->data as $lesson) {
                $timetable[strtotime($lesson->start_at->date)] = [
                    'start_at' => $lesson->start_at,
                    'students' => $class->students->data,
                ];
            }
        }

        ksort($timetable);

        return $timetable;
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
        $timetable = $this->sortByLesson($classes);

        return $timetable;
    }
}
