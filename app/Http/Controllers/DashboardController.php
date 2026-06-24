<?php

namespace RedSky\Api\Http\Controllers;

class DashboardController 
{
    public function index(): void
    {
        view('dashboard.index');
    }
}