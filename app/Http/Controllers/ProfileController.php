<?php

namespace App\Http\Controllers;

use Auth;
use App\DTO\UpdateProfileDTO;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileService $service
    )
    {
        $this->middleware('auth');
    }
    
    public function index(): View
    {
        $user_info = $this->service->getUserProfile(Auth::user());

        return view('profile.main', [
            'user_info' => $user_info
        ]);
    }

    public function editView(): View
    {
        $user_info = $this->service->getUserProfile(Auth::user());

        return view('profile.edit', [
            'user_info' => $user_info
        ]);
    }

    public function edit(UpdateProfileRequest $request): RedirectResponse
    {
        $dto = UpdateProfileDTO::fromRequest($request, Auth::user());
        $response = $this->service->updateUserProfile($dto);

        $status = $response ? 'Профиль успешно обновлен' : 'Ошибка при обновлении профиля';
        
        return redirect()->route('profile')->with('status', $status);
    }
}