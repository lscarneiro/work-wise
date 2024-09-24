<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve filter inputs
        $query = $request->input('query', '');
        $salaryMin = $request->input('salary_min', null);
        $salaryMax = $request->input('salary_max', null);
        $positionType = $request->input('position_type', '');

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
        $jobPosts = JobPost::search($query, function ($meilisearch, $query, $options) use ($filterString) {
            $options['filter'] = $filterString;
            $options['limit'] = 10;
            $options['offset'] = ($options['page'] - 1) * $options['limit'];
            return $meilisearch->search($query, $options);
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Retrieve necessary data for filters
        $positionTypes = JobPost::POSITION_TYPES;

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
