<?php

namespace App\Http\Controllers\Auth;

use App\Models\categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class categoriesController extends Controller
{
    public function categories(){
        return view('admin.categories.addcategories');
    }
    public function view(categories $categories){
        $data = categories::all();
        return view('admin.categories.view', ['data' => $data]);
    }

    public function store(Request $request)
    {
       $validation = Validator::make($request->all(), [
            'name'=> 'required | string',
            'img'=> 'required',
       ]);
       if ($validation->fails()) {
            return redirect()->route('categories')
                            ->withInput()
                            ->withErrors($validation);
        }

        if($validation->passes()){
            $addCategries = categories::create([
                'name'=>$request->name,
                'img'=>$request->file('img')->getClientOriginalName(),
                'status'=>$request->status??0,
            ]);

            return redirect()->route('showcategories');
        }
       
    }
}