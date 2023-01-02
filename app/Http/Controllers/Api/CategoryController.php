<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Ad;
use App\Models\Category;
use App\Traits\ApiTrait;


class CategoryController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return $this->dataResponse(compact('categories'), 'Get all Categories successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category =  Category::create($request->all());

        if ($category) {
            return $this->successResponse("category created successfuly", ['category' => $category]);
        }

        return $this->ErrorResponse(["Please try again"], "Some Thing Wrong", 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with('ads')->find($id);

        if (!$category) {
            return $this->ErrorResponse(["category" => "this category id dosen't exist"], "category not exist", 404);
        }

        return $this->dataResponse(compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse(["category" => "this category id dosen't exist"], "category not exist", 404);
        }

        $category->update($request->all());
        return $this->successResponse("success edit", ["category" =>  $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyWithAds($id)
    {
        if($id == 1)
        {
            return $this->ErrorResponse(["Can't Deleted default Category"], "Can't Deleted");
        }
        $category = Category::find($id);
        if (!$category) {
            return $this->ErrorResponse(["category" => "this category id dosen't exist"], "category not exist", 404);
        }
        $category->delete();
        return $this->successResponse("success Deleted", ["category" =>   $category]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMoveAds($id)
    {
        if($id == 1)
        {
        return $this->ErrorResponse(["Can't Deleted default Category"], "Can't Deleted");
        }

        $category = Category::find($id);
        if (!$category) {
            return $this->ErrorResponse(["category" => "this category id dosen't exist"], "category not exist", 404);
        }
         Ad::where('category_id', $id)->update(['category_id' => 1]);
        $category->delete();
        return $this->successResponse("success Deleted", ["category" =>   $category]);
    }
}
