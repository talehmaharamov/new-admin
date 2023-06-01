<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return redirect()->route('login');
});
