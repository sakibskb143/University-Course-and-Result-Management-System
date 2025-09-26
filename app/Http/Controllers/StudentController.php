<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('department')->paginate(10);
        return view('admin.features.students', compact('students'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.features.create_student', compact('departments'));
    }

    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        // Create or fetch a user for this student
        // Generate reg no if not provided: STUYYYYNNNN
        if (empty($data['student_reg_no'])) {
            $year = date('Y');
            $sequence = str_pad((string)(Student::count() + 1), 4, '0', STR_PAD_LEFT);
            $data['student_reg_no'] = 'STU' . $year . $sequence;
        }

        $username = $data['student_reg_no']; // e.g., STU20250001
        $email = $data['email'] ?? null;

        $user = User::where('username', $username)->first();
        if (!$user) {
            $user = new User();
            $user->username = $username;
            $user->name = $data['student_name'];
            $user->email = $email; // may be null
            $user->role = 'student';
            $user->password = 'password123';
            $user->save();
        }

        $data['user_id'] = $user->id;
        Student::create($data);

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully and login created!');
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        return view('admin.features.edit_student', compact('student', 'departments'));
    }

    public function update(StoreStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        // Keep user name/email in sync when key fields change
        if ($student->user_id) {
            $user = User::find($student->user_id);
            if ($user) {
                $user->name = $data['student_name'];
                if (isset($data['email'])) {
                    $user->email = $data['email'];
                }
                $user->save();
            }
        }

        $student->update($data);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
    }
}
