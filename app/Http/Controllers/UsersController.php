<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    //
    public function index()
    {

        $user = Auth::user()->role;
        if ($user != 0) {
            return abort(404);
        }

        $users = User::whereNotIn('role', [0])->get();

        $users->transform(function ($user) {
            $user->role_name = User::ROLES[$user->role];
            $user->active = User::STATUSES[$user->active];
            return $user;
        });

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        try {
            $currentYear = date('Y');
            $userCount = User::where('student_no', 'like', $currentYear . '%')->count();
            $userCount = $userCount + User::where('emp_no', 'like', $currentYear . '%')->count();
            $digits = strlen(strval($userCount + 1));
            $userNo = $currentYear . str_pad(($userCount + 1), $digits, '0', STR_PAD_LEFT);

            while (User::where('student_no', $userNo)->exists()) {
                $userCount++;
                $digits = strlen(strval($userCount + 1));
                $userNo = $currentYear . str_pad(($userCount + 1), $digits, '0', STR_PAD_LEFT);
            }
            while (User::where('emp_no', $userNo)->exists()) {
                $userCount++;
                $digits = strlen(strval($userCount + 1));
                $userNo = $currentYear . str_pad(($userCount + 1), $digits, '0', STR_PAD_LEFT);
            }

            $user = new User();
            $user->user_id = (string) Str::uuid();
            $request->role == 1 ? $user->student_no = $userNo : $user->emp_no = $userNo;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('123'); 
            $user->role = $request->role;
            $user->active = 1;

            $user->save();

            if ($request->role == 1) {
                $student = new Student();
                $student->user_id = $user->user_id;
                $student->student_no = $userNo;
                $student->department = $request->department;
                $student->year = $request->year;
                $student->contact = $request->contact;
                $student->name = $request->name;
                $student->email = $request->email;
                $student->save();
            } else {
                $employee = new Employee();
                $employee->user_id = $user->user_id;
                $employee->emp_no = $userNo;
                $employee->contact = $request->contact;
                $employee->department = $request->department;
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->save();
            }

            return response()->json(['message' => 'User created successfully!']);
        } catch (\Exception $e) {
            // Handle any exceptions
            Log::info('Failed to create user: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to create user.'], 500);
        }
    }

    public function edit(Request $request, $id)
    {
        $user = User::where('user_id', $id)->first();

        $user->email = $request->email;
        $user->name = $request->name;

        if ($user->role == 1 && $request->role == 2 || $user->role == 1 && $request->role == 3) {
            $user->role = $request->role;
            $user->student_no = null;
            $user->emp_no = $request->user_no;
        } elseif ($user->role == 2 && $request->role == 1 || $user->role == 3 && $request->role == 1) {
            $user->role = $request->role;
            $user->student_no = $request->user_no;
            $user->emp_no = null;
        } else {
            $user->role = $request->role;
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully!']);
    }

    public function destroy($id)
    {
        $user = User::where('user_id', $id)->first();
        if ($user) {
            $user->delete();
        }
        return response()->json(['message' => 'User deleted successfully!']);
    }
}
