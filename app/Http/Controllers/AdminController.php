<?php

namespace App\Http\Controllers;

use App\Models\Department;

class AdminController extends Controller
{
    public function index()
    {
        $departments = Department::all(); // pass departments to dashboard if needed
        return view('admin.admin_dashboard', compact('departments'));
    }
}
