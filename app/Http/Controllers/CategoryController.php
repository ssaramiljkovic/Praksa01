<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_cat' => 'required|unique:categories',
        ]);

        $category = new Category([
            'vehicle_cat' => $validatedData['vehicle_cat'],
        ]);
        $user = Auth::user();

        $category['created_by'] = $user->getAuthIdentifier();
        $category['updated_by'] = $user->getAuthIdentifier();

        $category->save();

        $request->session()->flash('success', 'Category created successfully!');

        return redirect('/categories/create');
    }

    public function manage()
    {
        $categories = Category::all();
//        dd($categories);
        return view('categories.manage', ['categories' => $categories]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Ažuriranje kategorije
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'vehicle_cat' => 'required|unique:categories',
        ]);

        $category->update($request->only('vehicle_cat'));

        return redirect()->route('categories.manage')->with('success', 'Category updated successfully!');
    }

}
