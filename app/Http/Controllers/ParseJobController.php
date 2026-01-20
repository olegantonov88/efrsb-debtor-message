<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParseJob\ParseJobResource;
use App\Models\ParseJob;
use Inertia\Inertia;

class ParseJobController extends Controller
{
    public function index()
    {
        $parseJobs = ParseJob::query()->latest()->paginate(20);

        return Inertia::render('ParseJob/Index', [
            'parseJobs' => ParseJobResource::collection($parseJobs),
        ]);
    }
}


