<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobPostRequest;
use App\Http\Requests\UpdateJobPostRequest;
use App\Models\Company;
use App\Models\JobPost;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobPosts = JobPost::orderBy('id', 'desc')->paginate(10);
        $positionTypes = JobPost::POSITION_TYPES;
        $companies = Company::orderBy('id', 'desc')->pluck('name', 'id')->map(function ($name, $id) {
            return "{$name} (ID: {$id})";
        });
        return view('job-posts.admin-index', compact('jobPosts', 'positionTypes', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobPostRequest $request)
    {
        JobPost::create($request->only(['company_id', 'title', 'location', 'position_type', 'salary', 'description']));

        $redirectTo = $request->input('redirect_to');
        $toasMessage = [
            'message' => 'Job Posting created successfully!',
            'type' => 'success',
        ];

        if ($redirectTo) {
            return redirect($redirectTo)
                ->with('toast', $toasMessage);
        }

        return redirect()->route('admin.job-posts.index')
            ->with('toast', $toasMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        $jobPost->load(relations: ['company']);
        $positionTypes = JobPost::POSITION_TYPES;
        return view('job-posts.admin-show', compact('jobPost', 'positionTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobPostRequest $request, JobPost $jobPost)
    {
        $jobPost->update($request->only(['title', 'location', 'description', 'salary', 'position_type', 'is_published']));
        return redirect()->route('admin.job-posts.show', ['job_post' => $jobPost->id])
            ->with('toast', [
                'message' => 'Job Posting updated successfully!',
                'type' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('admin.job-posts.index')
                ->with('toast', [
                    'message' => 'You are not authorized to delete this job posting!',
                    'type' => 'danger',
                ]);
        }

        $jobPost->delete();
        return redirect()->route('admin.job-posts.index')
            ->with('toast', [
                'message' => 'Job Posting deleted successfully!',
                'type' => 'success',
            ]);
    }

    /**
     * Make the job posting visible to the public.
     */
    public function publish(JobPost $jobPost)
    {
        $jobPost->update(['is_published' => true]);
        return redirect()->route('admin.job-posts.show', ['job_post' => $jobPost->id])
            ->with('toast', [
                'message' => 'Job post published successfully!',
                'type' => 'success',
            ]);
    }

    /**
     * Make the job posting invisible to the public.
     */
    public function unpublish(JobPost $jobPost)
    {
        $jobPost->update(['is_published' => false]);
        return redirect()->route('admin.job-posts.show', ['job_post' => $jobPost->id])
            ->with('toast', [
                'message' => 'Job post unpublished successfully!',
                'type' => 'success',
            ]);
    }

    /**
     * Display the job posting details to the public.
     */
    public function details(JobPost $jobPost)
    {
        $positionTypes = JobPost::POSITION_TYPES;
        return view('job-posts.details', compact('jobPost', 'positionTypes'));
    }
}
