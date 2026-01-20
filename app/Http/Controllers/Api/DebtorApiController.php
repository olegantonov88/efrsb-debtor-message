<?php

namespace App\Http\Controllers\Api;

use App\Enums\ParseJob\ParseJobType;
use App\Enums\ParseJob\StatusParseJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DebtorLatestTaskDebtorMessagesRequest;
use App\Http\Requests\Api\DebtorUpdateDataRequest;
use App\Http\Resources\ParseJob\ParseJobResource;
use App\Jobs\Debtors\SendDebtorUpdateRequestJob;
use App\Models\ParseJob;

class DebtorApiController extends Controller
{
    public function updateData(DebtorUpdateDataRequest $request)
    {
        $data = $request->validated();

        $job = ParseJob::create([
            'debtor_id' => (int) $data['debtor_id'],
            'type' => ParseJobType::UpdateDebtorData,
            'payload' => $data,
            'user_id' => (int) $data['user_id'] ?? null,
        ]);

        $job->updateStatus(StatusParseJob::CREATED);

        dispatch((new SendDebtorUpdateRequestJob($job->id))->onQueue('default'));

        return response()->json([
            'success' => true,
            'message' => 'Запрос получен',
            'parse_job_id' => $job->id,
            'parse_job' => $job ? ParseJobResource::make($job) : null,
        ]);
    }


    public function latestTaskDebtorMessages(DebtorLatestTaskDebtorMessagesRequest $request)
    {
        $data = $request->validated();

        $job = ParseJob::where('debtor_id', (int) $data['debtor_id'])->orderBy('created_at', 'desc')->first();

        return response()->json([
            'success' => true,
            'message' => 'Запрос получен',
            'parse_job' => $job ? ParseJobResource::make($job) : null,
        ]);
    }
}


