<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wonde\Client;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client(env('WONDE_AUTH_KEY'));
        $school = $client->school(env('WONDE_SCHOOL_ID'));
        $id = $request->id;

        try {
            $employee = $school->employees->get($id, ['classes']);
        } catch (\Exception $e) {
            echo "Did you use a valid employee id?\n";
            echo $e->getMessage();
            exit();
        }

        $employeeName = $employee->forename . ' ' . $employee->surname;

        $timetable = [];

        foreach ($employee->classes->data as $class) {
            $classWithLessons = $school->classes->get($class->id, ['lessons', 'students']);

            foreach ($classWithLessons->lessons->data as $lesson) {
                $timetable[strtotime($lesson->start_at->date)] = [
                    'start_at' => $lesson->start_at,
                    'students' => $classWithLessons->students->data,
                ];
            }

        }

        ksort($timetable);

        return view('timetable', [
            'name' => $employeeName,
            'lessons' => $timetable,
        ]);
    }
}
