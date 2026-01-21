<?php

use App\Http\Controllers\Api\DebtorApiController;
use App\Http\Controllers\Api\EfrsbMessageApiController;
use App\Http\Controllers\Api\FedresursApiController;
use App\Http\Controllers\Api\FedresursTaskApiController;
use App\Http\Controllers\Api\FedresursTaskStatusApiController;
use App\Http\Controllers\Api\ParserServiceApiController;
use App\Http\Controllers\Api\ParserServiceStateApiController;
use App\Http\Controllers\Api\TaskStatusApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['verify.fedresurs.api.key'])->group(function () {
    Route::post('/debtors/update-data', [DebtorApiController::class, 'updateData'])->name('api.debtors.update-data');
    Route::post('/debtors/latest-task-debtor-messages', [DebtorApiController::class, 'latestTaskDebtorMessages'])->name('api.debtors.latest-task-debtor-messages');

    Route::prefix('efrsb-message')->group(function () {
        Route::post('/task-status', [FedresursTaskStatusApiController::class, 'store'])->name('api.fedresurs.task-status');
        Route::post('/service-state', [ParserServiceStateApiController::class, 'store'])->name('api.efrsb-message.service-state');
        Route::post('/debtor-uuid', [FedresursApiController::class, 'updateDebtorUuid'])->name('api.fedresurs.debtor-uuid');
        Route::post('/messages', [EfrsbMessageApiController::class, 'storeMessages'])->name('api.efrsb-message.messages');
        Route::post('/message-body', [EfrsbMessageApiController::class, 'storeMessageBody'])->name('api.efrsb-message.message-body');
    });
});

// Роуты для debtor_updater
Route::middleware(['verify.debtor.updater.api.key'])->group(function () {
    // Управление сервисами парсера по API (без домена/админки)
    Route::prefix('parser-services')->group(function () {
        Route::get('/', [ParserServiceApiController::class, 'index'])->name('api.parser-services.index');
        Route::post('/', [ParserServiceApiController::class, 'store'])->name('api.parser-services.store');
        Route::patch('/{parserService}', [ParserServiceApiController::class, 'update'])->name('api.parser-services.update');
        Route::delete('/{parserService}', [ParserServiceApiController::class, 'destroy'])->name('api.parser-services.destroy');
    });

    // Просмотр состояния задач (parse_jobs + fedresurs_tasks) с пагинацией
    Route::get('/tasks', [TaskStatusApiController::class, 'index'])->name('api.tasks.index');
});

// Роуты для внешних сервисов (debtor_updater и meeting_application)
Route::middleware(['verify.external.service.api.key'])->group(function () {
    Route::prefix('fedresurs')->group(function () {
        Route::post('/enqueue/debtor-messages', [FedresursTaskApiController::class, 'enqueueDebtorMessages'])->name('api.fedresurs.enqueue.debtor-messages');
        Route::post('/enqueue/message-tables', [FedresursTaskApiController::class, 'enqueueMessageTables'])->name('api.fedresurs.enqueue.message-tables');
    });
});

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});


