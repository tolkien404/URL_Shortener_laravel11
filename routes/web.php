<?php

use App\Http\Controllers\RedirectToOriginalUrl;
use App\Http\Middleware\CountVisits;
use App\Livewire\ShortenUrl;
use Illuminate\Support\Facades\Route;

Route::get('/', ShortenUrl::class);
Route::get('/{url:code}', RedirectToOriginalUrl::class)->middleware(CountVisits::class);
