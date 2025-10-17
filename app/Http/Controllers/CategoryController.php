<?php

namespace App\Http\Controllers;

use Auth;
use App\DTO\CreateCategoryDTO;
use App\DTO\UpdateCategoryDTO;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $service
    ) {}

    public function index(): View
    {
        $categories = $this->service->getUserCategories(Auth::user());

        return view('categories.main', [
            'categories' => $categories
        ]);
    }

    public function addView(): View
    {
        $user = Auth::user();

        return view('categories.add', [
            'user' => $user
        ]);
    }

    public function add(CreateCategoryRequest $request): RedirectResponse
    {
        $dto = CreateCategoryDTO::fromRequest($request, Auth::user());
        $response = $this->service->createUserCategory($dto);

        $status = $response ? 'Категория успешно создана' : 'Ошибка при создании категории';
        
        return redirect()->route('categories')->with('status', $status);
    }

    public function editView($id): View
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessCategory($id, $user)) {
            return redirect('/categories')->with('error', 'Нет доступа к этой категории');
        }

        $category = $this->service->getUserCategoryById($id, $user);
        
        return view('categories.edit', [
            'category' => $category,
            'user'     => $user
        ]);
    }

    public function edit(UpdateCategoryRequest $request): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessCategory($request->category_id, $user)) {
            return redirect('/categories')->with('error', 'Нет доступа к этой категории');
        }

        $dto = UpdateCategoryDTO::fromRequest($request);
        $response = $this->service->updateUserCategory($dto);

        $status = $response ? 'Категория успешно обновлена' : 'Ошибка при обновлении категории';
        
        return redirect('/categories')->with('status', $status);
    }

    public function delete(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessCategory($request->category_id, $user)) {
            return response()->json([
                'success' => false,
                'message' => 'Нет доступа к этой категории'
            ], 403);
        }

        $result = $this->service->deleteUserCategory($request);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Категория успешно удалена' : 'Ошибка при удалении категории'
        ]);
    }
}