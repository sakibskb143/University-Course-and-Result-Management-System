<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('department')->orderBy('created_at', 'asc')->get();
        return view('admin.features.teachers', compact('teachers'));
    }

    public function create()
    {
        $departments = Department::orderBy('department_name', 'asc')->get();
        return view('admin.features.create_teacher', compact('departments'));
    }

    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        // Ensure contact_no is 11 digits
        if(isset($data['contact_no'])){
            $data['contact_no'] = str_pad($data['contact_no'], 11, '0', STR_PAD_LEFT);
        }

        // Ensure credit has 2 decimal places
        if(isset($data['credit_to_be_taken'])){
            $data['credit_to_be_taken'] = number_format($data['credit_to_be_taken'], 2, '.', '');
        }

        // Generate teacher username like TCHYYYYNNNN
        $year = date('Y');
        $sequence = str_pad((string)(User::where('role', 'teacher')->count() + 1), 4, '0', STR_PAD_LEFT);
        $username = 'TCH' . $year . $sequence;

        // Create user by username; email may be null or duplicate in other tables
        $user = User::where('username', $username)->first();
        if (!$user) {
            $user = new User();
            $user->username = $username;
            $user->name = $data['teacher_name'];
            $user->email = $data['email'] ?? null;
            $user->role = 'teacher';
            $user->password = 'password123';
            $user->save();
        }

        $data['user_id'] = $user->id;
        Teacher::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully and login created!');
    }

    public function edit(Teacher $teacher)
    {
        $departments = Department::orderBy('department_name', 'asc')->get();
        return view('admin.features.edit_teacher', compact('teacher', 'departments'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();

        if(isset($data['contact_no'])){
            $data['contact_no'] = str_pad($data['contact_no'], 11, '0', STR_PAD_LEFT);
        }

        if(isset($data['credit_to_be_taken'])){
            $data['credit_to_be_taken'] = number_format($data['credit_to_be_taken'], 2, '.', '');
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
