<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        $emp = Employee::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'address' => $request['address']
        ]);

        return response([
            'msg' => 'success',
            'employee' => $emp
        ]);
    }

    public function read()
    {
        $emp = Employee::all();

        return response([
            'msg' => 'success',
            'employee' => $emp
        ]);
    }

    public function delete($id)
    {
        $emp = Employee::find($id);
        $rd = $emp->delete();

        return response([
            'message' => 'deleted'
        ]);
    }

    public function edit(Request $request,$id)
    {   
        $emp = Employee::find($id);
        $emp->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'address' => $request['address']
        ]);

        return [
            "data" => $emp,
            "msg" => "Employee updated successfully"
        ];
    }
}
