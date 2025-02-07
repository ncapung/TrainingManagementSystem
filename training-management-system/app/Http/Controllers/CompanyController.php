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
            'company_code' => 'required|unique:companies,company_code',
            'alamat' => 'required',
        ]);

        $company = Company::create($request->all());

        return response()->json([
            'success' => true,
            'company' => $company
        ]);
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return response()->json($company);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required',
            'company_code' => 'required|unique:companies,company_code,' . $id,
            'address' => 'required',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
