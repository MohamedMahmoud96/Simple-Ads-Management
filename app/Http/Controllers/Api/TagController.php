<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return $this->dataResponse(compact('tags'), 'Get all tags successfully');
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
    public function store(TagRequest $request)
    {
        $tag =  Tag::create($request->all());
        if($tag)
        {
            return $this->successResponse("Tag created successfuly", ['tag'=> $tag]);
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
        $tag = Tag::with('ads')->find($id);

       if(!$tag)
       {
        return $this->ErrorResponse(["tag" => "this category id dosen't exist"], "tag not exist", 404);

       }

        return $this->dataResponse(compact("tag"));

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
    public function update(TagRequest $request, $id)
    {
        $tag = Tag::find($id);

        if(!$tag)
        {
            return $this->errorResponse(["Tag" => "this category id dosen't exist"], "Tag not exist", 404);
        }

        $tag->update($request->all());
        return $this->successResponse("success edit", ["Tag" =>  $tag]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if(!$tag)
        {
            return $this->ErrorResponse(["tag" => "this tag id dosen't exist"], "tag not exist", 404);
        }
       $tag->delete($tag);
       return $this->successResponse("success Deleted", ["tag" =>   $tag ]);
    }
}
