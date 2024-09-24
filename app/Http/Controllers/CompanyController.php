<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\JobPost;
use Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(10);
        return view('companies.admin-index', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->only(['name', 'location', 'description']));
        return redirect()->route('admin.companies.index')
            ->with('toast', [
                'message' => 'Company created successfully!',
                'type' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->load([
            'jobPosts' => function ($query) {
                $query->orderBy('id', 'desc');
            }
        ]);
        $positionTypes = JobPost::POSITION_TYPES;
        return view('companies.admin-show', compact('company', 'positionTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->only(['name', 'location', 'description']));
        return redirect()->route('admin.companies.show', ['company' => $company->id])
            ->with('toast', [
                'message' => 'Company updated successfully!',
                'type' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('admin.companies.index')
                ->with('toast', [
                    'message' => 'You are not authorized to delete a company!',
                    'type' => 'danger',
                ]);
        }

        $company->delete();
        return redirect()->route('admin.companies.index')
            ->with('toast', [
                'message' => 'Company deleted successfully!',
                'type' => 'success',
            ]);
    }
}
