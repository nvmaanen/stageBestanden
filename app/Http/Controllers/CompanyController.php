<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\CompanyEmployee;
use App\Models\CompanyProject;
use App\Models\Project;



class CompanyController extends Controller
{

    public function view()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function viewCompany(Company $company, Employee $employees)
    {
        $employees = Employee::all();
        $projects = Project::all();
        return view('admin.companies.view', compact('company', 'employees', 'projects'));
    }

    public function viewCreateEmployee(Employee $employees, Company $company)
    {
        $employees = Employee::all();
        return view('admin.companies.createEmployee', compact('company', 'employees'));
    }

    public function viewEmployees(Company $company, Employee $employees)
    {
        $employees = Employee::all();
        return view('admin.companies.employees', compact('employees', 'company'));
    }
    public function viewProjects(Company $company)
    {
        $employees = Employee::all();
        $projects = Project::all();

        return view('admin.companies.projects', compact('company', 'employees', 'projects'));
    }
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }


    public function store(Request $request)
    {

        $company = new Company;
        $company->name = $request->name;
        $company->address = $request->address;
        $company->zipcode = $request->zipcode;
        $company->telephone = $request->telephone;
        $company->email = $request->email;

        $company->save();

        return redirect()->route('admin.companies.index');
    }

    public function update(Company $company, Request $request)
    {
        $company->name = $request->name;
        $company->address = $request->address;
        $company->zipcode = $request->zipcode;
        $company->telephone = $request->telephone;
        $company->email = $request->email;

        $company->save();
        return redirect()->route('admin.companies.view', $company);
    }


    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('admin.companies.index');;
    }




    public function storeEmployee(Request $request, Company $company)
    {
        $companyEmployee = new CompanyEmployee();
        $companyEmployee->company_id = $company->id;
        $companyEmployee->employee_id = $request->employee_id;
        $companyEmployee->save();

        return redirect()->route('admin.companies.view', $company);
    }


    public function createAndStoreEmployee(Request $request, Company $company)
    {
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->address = $request->address;
        $employee->zipcode = $request->zipcode;
        $employee->telephone = $request->telephone;
        $employee->email = $request->email;

        $employee->save();


        $companyEmployee = new CompanyEmployee;
        $companyEmployee->company_id = $company->id;
        $companyEmployee->employee_id = $employee->id;

        $companyEmployee->save();

        return redirect()->route('admin.companies.employees', $company);
    }



    public function storeProject(Request $request, Company $company)
    {
        $companyProject = new CompanyProject();
        $companyProject->company_id = $company->id;
        $companyProject->project_id = $request->project_id;



        $companyProject->save();

        return redirect()->route('admin.companies.view', $company);
    }
}
