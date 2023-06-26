<?php

namespace App\Repository;

use App\Models\Client;
use App\Models\Product;
use App\Models\category;
use Illuminate\Validation\Rule;
use App\RepositoryInterface\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function index()
    {
        $categories = category::query()
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('page.backend.categories.index', compact('categories'));
    }

    public function store($request)
    {
        try {
            //Validate
            validateCategory($request);
            //Insert category by request all
            category::create($request->all());
            successAlert();
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            //Validate
            validateCategory($request);
            //Update category by request all
            $category = Category::find($request->id);
            $category->update($request->all());
            updateAlert();
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $productId = Product::where('category_id', $request->id)->pluck('category_id');
        if ($productId->count() == 0) {
            Category::destroy($request->id);
            deleteAlert();
            return redirect()->route('categories.index');
        } else {
            toastr()->error('لم يتم الحذف يوجد بيانات متعلقة به ,العملية فاشلة.');
            return redirect()->route('categories.index');
        }
    }
}
