<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/produtos');
});
Route::resource('/produtos', ProdutoController::class)
    ->except(['show']);

