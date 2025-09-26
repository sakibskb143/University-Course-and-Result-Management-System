<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display all departments.
     */
    public function index()
    {
        $departments = Department::orderBy('created_at', 'asc')->get(); // oldest first
        return view('admin.features.departments', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        return view('admin.features.create_department');
    }

    /**
     * Store a new department.
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department added successfully!');
    }

    /**
     * Show the edit form for a department.
     */
    public function edit(Department $department)
    {
        return view('admin.features.edit_department', compact('department'));
    }

    /**
     * Update a department.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department_code' => 'required|string|max:10|unique:departments,department_code,' . $department->id,
            'department_name' => 'required|string|max:255',
        ]);

        $department->update($request->only(['department_code', 'department_name']));

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department updated successfully!');
    }

    /**
     * Delete a department.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department deleted successfully!');
    }
}
