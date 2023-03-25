<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Timetable;

class EmployeeController extends Controller
{
    protected $timetable;

    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    public function index(Request $request)
    {
        $employeeId = $request->employeeid;

        return view('timetable', [
            'name' => $this->timetable->getEmployeeName($employeeId),
            'lessons' => $this->timetable->getTimeTable($employeeId),
        ]);
    }
}
