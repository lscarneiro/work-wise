<?php

namespace App\Http\Controllers;

use App\Models\JobPost;

class DashboardController extends Controller
{
    public function index()
    {
        $jobPosts = JobPost::where('is_published', true)->orderBy('id', 'desc')->paginate(10);
        $positionTypes = JobPost::POSITION_TYPES;
        return view('dashboard', compact('jobPosts', 'positionTypes'));
    }
}
