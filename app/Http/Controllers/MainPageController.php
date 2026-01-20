<?php

namespace App\Http\Controllers;

use App\Enums\ParseJob\StatusParseJob;
use App\Models\ParseJob;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class MainPageController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        return Inertia::render('MainPage/Index', [
            'stats' => [
                'overall' => [
                    'jobs_total' => ParseJob::query()->count(),
                    'jobs_completed' => ParseJob::query()->where('latest_status', StatusParseJob::SUCCESS)->count(),
                    'jobs_processing' => ParseJob::query()->where('latest_status', StatusParseJob::PROCESSING)->count(),
                    'jobs_error' => ParseJob::query()->where('latest_status', StatusParseJob::ERROR)->count(),
                ],
                'today' => [
                    'jobs_created' => ParseJob::query()->whereDate('created_at', $today)->count(),
                    'jobs_completed' => ParseJob::query()
                        ->where('latest_status', StatusParseJob::SUCCESS)
                        ->whereDate('updated_at', $today)
                        ->count(),
                ],
            ],
        ]);
    }
}


