<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::paginate(10);
       return $this->dataResponse(compact('users'), 'Get all users successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('ads')->find($id);

        if(!$user)
        {
         return $this->ErrorResponse(["user" => "this user id dosen't exist"], "user not exist", 404);

        }
         return $this->dataResponse(compact("user"));


    }

}
