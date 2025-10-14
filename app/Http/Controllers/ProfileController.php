<?php

namespace App\Http\Controllers;

use Auth;
use App\DTO\UpdateProfileDTO;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(): View
    {
        $user_info = ProfileService::getUserProfile(Auth::user());

        return view('profile.main', [
            'user_info' => $user_info
        ]);
    }

    public function editView(): View
    {
        $user_info = ProfileService::getUserProfile(Auth::user());

        return view('profile.edit', [
            'user_info' => $user_info
        ]);
    }

    public function edit(Request $request, ProfileService $service): RedirectResponse
    {
        $dto = UpdateProfileDTO::fromRequest($request, Auth::user());
        $response = $service->updateUserProfile($dto);

        $status = $response ? 'Профиль успешно обновлен' : 'Ошибка при обновлении профиля';
        
        return redirect()->route('profile')->with('status', $status);
    }
}