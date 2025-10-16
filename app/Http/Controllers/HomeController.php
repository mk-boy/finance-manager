<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly HomeService $service
    )
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $user = Auth::user();
        $dashboardData = $this->service->getDashboardData($user);
        
        return view('home', $dashboardData);
    }
}
