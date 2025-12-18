<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Filament\Resources\ProdukResource\Api\Handlers\{
    PaginationHandler, DetailHandler, CreateHandler, UpdateHandler, DeleteHandler
};

Route::prefix('produk')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [PaginationHandler::class, 'handler']);
    Route::post('/', [CreateHandler::class, 'handler']);
    Route::get('{record}', [DetailHandler::class, 'handler']);
    Route::put('{record}', [UpdateHandler::class, 'handler']);
    Route::delete('{record}', [DeleteHandler::class, 'handler']);
});
