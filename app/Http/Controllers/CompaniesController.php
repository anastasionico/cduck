<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);

        return view('admin/companies/index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/companies/create');
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
            'name' => 'required|string',
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website' => 'url',
        ]);

        if ($image = $request->file('logo')) {
            $imageName = time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('logo'), $imageName);
        }
    
        
        
        $company = Company::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'logo' => $imageName,
            'website' => $request->get('website'),
        ]);
        
        return redirect('/admin/companies/'.$company->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    // public function show(Company $company)
    // {
    //     dd($company->id);
    //     return view('/admin/companies/show', compact('company'));
    // }
    public function show($id)
    {
        return view('/admin/companies/show', ['company' => Company::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin/companies/edit", ['company' => Company::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website' => 'url',
        ]);
        

        Company::findOrFail($id)->update($validatedData);


        return redirect('/admin/companies/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::findOrFail($id)->delete();

        return redirect("/admin/companies");
    }
}
