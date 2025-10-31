<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

interface CategoriesInterface{
    public function store(StoreCategoriesRequest $request) : JsonResponse;
    public function update(UpdateCategoriesRequest $request, Categories $categories, string $id) : JsonResponse;
    public function destroy(Categories $categories, string $id) : JsonResponse;
    public function index() : JsonResponse;
    public function show(string $id) : JsonResponse;
}

class CategoriesController extends Controller
{

    public string $name,$slug,$description;
    public ?int $parent_id = null;
    

    public function index() : JsonResponse
    {
          $categories = Categories::with('children')->wherenull('parent_id')->paginate(10);
          if ($categories->count() === 0) {
              return response()->json([
                  'status' => false,
                  'message' => 'No categories found',
                  'data' => null
              ], 404);
          }

          return response()->json([
              'status' => true,
              'message' => 'Categories found',
              'data' => $categories
          ], 200);
    }

   

    public function store(StoreCategoriesRequest $request) : JsonResponse
    {
        $validated =  $request->validated();
        $name = $this->name = $validated['name'];
        $slug = $this->slug = Str::slug($validated['name']);
        $description = $this->description = $validated['description'];
        $parent_id = $this->parent_id = $validated['parent_id']??null;
        $category = new Categories();
        $category->name = $name;
        $category->slug = $slug;
        $category->description = $description;
        $category->parent_id = $parent_id;
        $category->save();

        return response()->json([
            'status'=>true,
            'message'=>'Category created successfully',
            'data'=>$category
        ],201);
    }



    public function show(string $id) : JsonResponse
    {
        $category = Categories::with('children')->wherenull('parent_id')->find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Category found',
            'data' => $category,
        ], 200);
    }

  

    public function update(UpdateCategoriesRequest $request, Categories $categories,string $id) : JsonResponse
    {
        $validated =  $request->validated();
        $name = $this->name = $validated['name'];
        $slug = $this->slug = Str::slug($validated['name']);
        $description = $this->description = $validated['description'];
        $parent_id = $this->parent_id = $validated['parent_id']??null;
        $category = Categories::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
                'data' => null,
            ], 404);
        }
        $category->name = $name??$category->name;
        $category->slug = $slug??$category->slug;
        $category->description = $description??$category->description;
        $category->parent_id = $parent_id??$category->parent_id;
        $category->save();
        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => $category,
        ], 200);
    }

  

    public function destroy(string $id) : JsonResponse
    {
        $category = Categories::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
                'data'=>null,
            ], 404);
        }
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully',
            'data'=>$category,
        ], 200);
    }
}
