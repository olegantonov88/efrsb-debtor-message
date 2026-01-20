<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParserServiceStoreRequest;
use App\Http\Requests\Api\ParserServiceUpdateRequest;
use App\Http\Resources\ParserServiceResource;
use App\Models\ParserService;
use App\Events\ParserServiceDeleted;
use App\Events\ParserServiceUpdated;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ParserServiceApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $items = ParserService::query()
            ->orderByDesc('id')
            ->paginate(request()->integer('per_page', 50));

        return ParserServiceResource::collection($items);
    }

    public function store(ParserServiceStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $service = ParserService::query()->create([
            'name' => $data['name'],
            'base_url' => rtrim($data['base_url'], '/'),
            'is_active' => $data['is_active'] ?? true,
            'http_enabled' => $data['http_enabled'] ?? true,
            'ymq_enabled' => $data['ymq_enabled'] ?? true,
        ]);

        event(new ParserServiceUpdated($service));

        return response()->json([
            'success' => true,
            'service' => ParserServiceResource::make($service)->resolve(),
        ]);
    }

    public function update(ParserServiceUpdateRequest $request, ParserService $parserService): JsonResponse
    {
        $data = $request->validated();

        if (array_key_exists('base_url', $data)) {
            $data['base_url'] = rtrim((string) $data['base_url'], '/');
        }

        $parserService->fill($data);
        $parserService->save();

        event(new ParserServiceUpdated($parserService->fresh()));

        return response()->json([
            'success' => true,
            'service' => ParserServiceResource::make($parserService->fresh())->resolve(),
        ]);
    }

    public function destroy(ParserService $parserService): JsonResponse
    {
        $id = (int) $parserService->id;
        $parserService->delete();

        event(new ParserServiceDeleted($id));

        return response()->json([
            'success' => true,
            'deleted_id' => $id,
        ]);
    }
}
