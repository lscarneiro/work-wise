<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'query' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'position_type' => 'nullable|in:remote,hybrid,in-person',
            'page' => 'nullable|integer|min:1',
        ]);

        // Retrieve filter inputs
        $query = $validated['query'] ?? '';
        $salaryMin = $validated['salary_min'] ?? null;
        $salaryMax = $validated['salary_max'] ?? null;
        $positionType = $validated['position_type'] ?? '';
        $page = $validated['page'] ?? 1;

        // Build filter string for Meilisearch
        $filters = ['is_published = true'];

        if (!is_null($salaryMin)) {
            $filters[] = 'salary >= ' . $salaryMin;
        }

        if (!is_null($salaryMax)) {
            $filters[] = 'salary <= ' . $salaryMax;
        }

        if ($positionType) {
            $filters[] = 'position_type = "' . $positionType . '"';
        }

        $filterString = implode(' AND ', $filters);

        // Perform search with Scout and Meilisearch
        $jobPosts = JobPost::search($query, function ($meilisearch, $query, $options) use ($filterString, $page) {
            $options['filter'] = $filterString;
            $options['limit'] = 4;
            $options['offset'] = ($page - 1) * $options['limit'];
            return $meilisearch->search($query, $options);
        })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Retrieve necessary data for filters
        $positionTypes = JobPost::POSITION_TYPES;

        if ($request->ajax()) {
            // Return a partial view with job posts
            if ($jobPosts->count() > 0) {
                return view('partials.job-posts-list', compact('jobPosts', 'positionTypes'))->render();
            } else {
                return ''; // No more data to load
            }
        }

        return view('dashboard', compact(
            'jobPosts',
            'positionTypes',
            'query',
            'salaryMin',
            'salaryMax',
            'positionType'
        ));
    }
}
