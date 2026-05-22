<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerApiController extends Controller
{
    public function index(){
        return Owner::all();
    }
    public function show($id){
        return Owner::find($id);

    }
    public function store(Request $request){
        $owner = new Owner();
        $owner->name=$request->name;
        $owner->surname=$request->surname;
        $owner->phone=$request->phone;
        $owner->email=$request->email;
        $owner->address=$request->address;
        $owner->user_id=1;
        $owner->save();

        return $owner;
    }
    public function update(Request $request, $id)
    {
        $owner = Owner::find($id);
        $owner->name=$request->name;
        $owner->surname=$request->surname;
        $owner->phone=$request->phone;
        $owner->email=$request->email;
        $owner->address=$request->address;
        $owner->save();
        return $owner;
    }
    public function destroy($id){
       Owner::destroy($id);
    }
}
