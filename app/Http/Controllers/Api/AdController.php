<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Ad_tag;
use App\Models\Tag;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AdController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ads = Ad::with('Category', 'Tags', 'Advertiser')->paginate(10);
       return $this->dataResponse(compact('ads'), 'Get all Ads successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::with('category', 'tags', 'Advertiser')->find($id);
        if(!$ad)
        {
         return $this->ErrorResponse(["ad" => "this ad id dosen't exist"], "Ad not exist", 404);

        }

         return $this->dataResponse(compact("ad"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AdFilterByTag($name)
    {
       // $tag_Ad = Tag::with('ads')->where('name' , $name)->get();

        $tag = Tag::where('name' , $name)->first();
        if(!$tag)
        {
          return $this->ErrorResponse(["tag" => "this tag name dosen't exist"], "tag not exist", 404);
        }

        $ads_tags = Ad_tag::where('tags_id', $tag->id)->pluck('ads_id');

        $ads = Ad::findMany($ads_tags);

        if(!count($ads))
        {
            return $this->successResponse("No ads Found");
        }

         return $this->dataResponse(compact("ads"));

    }


}
