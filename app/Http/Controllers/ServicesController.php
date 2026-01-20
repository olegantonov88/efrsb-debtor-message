<?php

namespace App\Http\Controllers;

use App\Events\ParserServiceDeleted;
use App\Events\ParserServiceUpdated;
use App\Http\Resources\ParserServiceResource;
use App\Models\ParserService;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = ParserService::query()->orderBy('id')->get();

        return Inertia::render('Services/Index', [
            'services' => ParserServiceResource::collection($services),
            'pingIntervalMinutes' => (int) env('PARSER_PING_INTERVAL_MINUTES', 2),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'base_url' => ['required', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $service = ParserService::create([
            'name' => $data['name'],
            'base_url' => rtrim($data['base_url'], '/'),
            'is_active' => (bool) ($data['is_active'] ?? true),
            'is_available' => false,
            'current_state' => 'unknown',
        ]);

        event(new ParserServiceUpdated($service->fresh()));

        return back();
    }

    public function delete(ParserService $parserService)
    {
        $id = (int) $parserService->id;
        $parserService->delete();

        event(new ParserServiceDeleted($id));

        return back();
    }
}
