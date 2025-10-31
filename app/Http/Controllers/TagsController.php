<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Http\Requests\StoreTagsRequest;
use App\Http\Requests\UpdateTagsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

interface TagsIInterface{
    public function store(StoreTagsRequet $request) : JsonResponse;
    public function update(UpdateTagsRequest $request,Tags $tags,string $id) : JsonResponse;
    public function destroy(Tags $tags,string $id) : JsonResponse;
    public function show(Tags $tags,string $id) : JsonResponse;
    public function index() : JsonResponse;
}


class TagsController extends Controller
{
      public string $name,$slug;    


    public function index() : JsonResponse
    {
        $tags = Tags::paginate(10);
        if ($tags->count() === 0) {
            return response()->json([
                'status'=>false,
                'message'=>'Data Not Found',
                'data'=>null,
            ],404);
        }

        return response()->json([
            'status'=>true,
            'message'=>'Fetch data Succesfully',
            'data'=>$tags,
        ],200);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagsRequest $request) : JsonResponse
    {
       $validated  = $request->validated();
       $name = $this->name = $validated['name'];
       $slug = $this->slug = Str::slug($validated['name']);
       $tag = new Tags();
       $tag->name = $name;
       $tag->slug = $slug;
       $tag->save();

       return response()->json([
        'status'=>true,
        'message'=>'Successfully Created Tag',
        'data'=>$tag,
       ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $tags,string $id) : JsonResponse
    {
        $tags = Tags::findOrFail($id);
        if (!$tags) {
             return response()->json([
                'status'=>false,
                'message'=>'Data Not Found',
                'data'=>$tags,
             ],404);
        }

        return response()->json([
            'status'=>true,
            'message'=>'Successfully Found Data',
            'data'=>$tags
        ],200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagsRequest $request, Tags $tags,string $id) : JsonResponse
    {
        $validated = $request->validated();
        $name = $this->name = $validated['name'];
        $slug = $this->slug = Str::slug($validated['name']);
        $tags = Tags::findOrFail($id);
        $tags->name = $name?? $tags->name;
        $tags->slug = $slug?? $tags->slug;
        $tags->save();


        return response()->json([
            'status'=>true,
            'message'=>'Data Successfully Update',
            'data'=> $tags,
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tags $tags,string $id) :JsonResponse
    {
        $tags = Tags::findOrFail($id);
        if (!$tags) {
            return response()->json([
                'status'=>false,
                'message'=>'Data Not Found',
                'data'=>$tags,
            ],404);
        }

        $tags->delete();

        return response()->json([
            'status'=>true,
            'message'=>'Data Successfully Deleted',
            'data'=>$tags,
        ],200);
    }
}
