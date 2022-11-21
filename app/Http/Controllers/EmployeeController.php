<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Employee;



class EmployeeController extends Controller
{

    public function view()
    {
        $company = Company::all();
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees', 'company'));
    }


    public function create()
    {
        return view('admin.employees.create');
    }
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }
    public function viewEmployee(Employee $employee)
    {


        return view('admin.employees.view', compact('employee'));
    }

    public function store(Request $request)
    {

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->address = $request->address;
        $employee->zipcode = $request->zipcode;
        $employee->telephone = $request->telephone;
        $employee->email = $request->email;

        $employee->save();

        return redirect()->route('admin.employees.index');
    }

    public function update(Employee $employee, Request $request)
    {
        $employee->name = $request->name;
        $employee->address = $request->address;
        $employee->zipcode = $request->zipcode;
        $employee->telephone = $request->telephone;
        $employee->email = $request->email;

        $employee->save();

        return redirect()->route('admin.employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employees.index');
    }
}
