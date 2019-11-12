<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        
        return view('admin/employees/index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        
        return view('admin/employees/create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'integer||nullable',
            'email' => 'unique:employees,email',
            'phone' => 'string',
        ]);
        
        $employee = Employee::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'company_id' => $request->get('company_id'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone')
        ]);
        
        return redirect('/admin/employees/' . $employee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('/admin/employees/show', ['employee' => Employee::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $employee = Employee::findOrFail($id);

        return view("admin/employees/edit", compact('companies', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'integer||nullable',
            'email' => 'email',
            'phone' => 'string',
        ]);
        
        Employee::findOrFail($id)->update($validatedData);
        
        return redirect('/admin/employees/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        Employee::findOrFail($id)->delete();

        return redirect("/admin/employees");
    }
}
