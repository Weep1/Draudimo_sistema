<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerApiController extends Controller
{
    public function index(){
        return Owner::all();
    }
    public function show($id){
        return Owner::find($id)

    }
}
