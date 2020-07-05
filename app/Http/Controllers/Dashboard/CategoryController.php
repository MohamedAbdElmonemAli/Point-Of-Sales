<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        }
        $request->validate($rules);
        Category::create($request->all());
        flash()->success(trans('admin.addedsuccessfully'));
        return redirect(url(route('categories.index')));
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));

    }


    public function update(Request $request, Category $category)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
        }
        $request->validate($rules);
        $category->update($request->all());
        flash()->success(trans('admin.updatedsuccessfully'));
        return redirect(url(route('categories.index')));
    }


    public function destroy(Category $category)
    {
        $category->delete();
        flash()->success(trans('admin.deletedsuccessfully'));
        return redirect(url(route('categories.index')));
    }
}
