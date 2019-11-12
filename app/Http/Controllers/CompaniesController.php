<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Illuminate\Support\Facades\Storage;


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
            'email' => 'unique:companies,email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website' => 'url',
        ]);
        
        if ($image = $request->file('logo')) {
            $imageName = time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('img'), $imageName);
        }
    
        
        $company = Company::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'logo' => $imageName,
            'website' => $request->get('website'),
        ]);
        
        return redirect('/admin/companies/' . $company->id)->withFail('Error message');;
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
       

        if ($image = $request->file('logo')) {
            $imageName = time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('img'), $imageName);
        }
    
        $company = Company::findOrFail($id)->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'logo' => $imageName,
            'website' => $request->get('website'),
        ]);

        return redirect('/admin/companies/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $company = Company::findOrFail($id);

        $imageRemoved = $this->removeImage($company->logo);

        $company->delete();
        
        return redirect("/admin/companies");
    }

    public function removeImage(string $logo) :bool
    {  
        return File::delete(public_path('/img/' . $logo));
    }
}
