<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Timetable;

class EmployeeController extends Controller
{
    /**
     * The injected timetable service.
     */
    protected $timetable;

    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Show a timetable associated with an employee.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $employeeId = $request->employeeid;

        return view('timetable', [
            'name' => $this->timetable->getEmployeeName($employeeId),
            'lessons' => $this->timetable->getTimeTable($employeeId),
        ]);
    }
}
