<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\Category\IndexResource;
use App\Http\Resources\Category\ShowResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return IndexResource::collection(Category::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->input('title');
        if($request->has('description')) {
            $category->description = $request->input('description');
        }
        $category->save();

        return new ShowResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new ShowResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if($request->has('title')) {
            $category->title = $request->input('title');
        }

        if($request->has('description')) {
            $category->description = $request->input('description');
        }

        $category->save();

        return new ShowResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
