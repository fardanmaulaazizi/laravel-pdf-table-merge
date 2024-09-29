<?php

use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuditController::class, 'index']);
Route::get('/{id}/generatePDF', [AuditController::class, 'generatePDF']);
