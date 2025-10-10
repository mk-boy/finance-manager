<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $categories = Category::where('user_id', $user->id)->get();

        return view('categories.main', [
            'categories' => $categories
        ]);
    }

    public function addView()
    {
        $user = Auth::user();

        return view('categories.add', [
            'user' => $user
        ]);
    }

    public function add(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'tag_color' => $request->tag_color
        ]);

        return redirect('/categories');
    }

    public function editView($id)
    {
        $user = Auth::user();
        $category = Category::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$category) {
            return redirect('/categories')->with('error', 'Категория не найдена');
        }

        return view('categories.edit', [
            'category' => $category,
            'user' => $user
        ]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $category = Category::where('id', $request->category_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$category) {
            return redirect('/categories')->with('error', 'Категория не найдена');
        }

        $category->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'tag_color' => $request->tag_color
        ]);

        return redirect('/categories')->with('success', 'Категория успешно обновлена');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $category = Category::where('id', $request->category_id)
            ->where('user_id', $user->id)
            ->first();

        if ($category) {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Категория успешно удалена'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Категория не найдена'
        ], 404);
    }
}