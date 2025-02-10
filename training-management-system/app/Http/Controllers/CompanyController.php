<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_code' => 'required|unique:companies',
            'alamat' => 'required',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')->with('success', 'Company added successfully.');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required',
            'company_code' => 'required|unique:companies,company_code,' . $company->id,
            'alamat' => 'required',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
