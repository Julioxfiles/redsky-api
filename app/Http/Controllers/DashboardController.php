<?php

namespace App\Http\Controllers;

class DashboardController 
{
    public function index(): void
    {
        view('dashboard.index');
    }
}