<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __invoke(Request $request): Factory|View
    {
        return view('panel.representative-panel.dashboard.dashboard');
    }
}
