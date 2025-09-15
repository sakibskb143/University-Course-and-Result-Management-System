<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\Department;


class TeacherDashboardController extends Controller
{
     /**
     * Show the Teacher Dashboard (Search & Cards).
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('teacher.dashboard', [
            'section' => 'overview',
        ]);
    }

    /**
     * Display the Assigned Courses section.
     *
     * @return \Illuminate\View\View
     */
    public function courses()
    {
        return view('teacher.dashboard', [
            'section' => 'courses',
        ]);
    }

    /**
     * Display the Class Schedule section.
     *
     * @return \Illuminate\View\View
     */
    public function schedule()
    {
        return view('teacher.dashboard', [
            'section' => 'schedule',
        ]);
    }

    /**
     * Display the Save Student Result section.
     *
     * @return \Illuminate\View\View
     */
    public function saveResult()
    {
        return view('teacher.dashboard', [
            'section' => 'save_result',
        ]);
    }
}
