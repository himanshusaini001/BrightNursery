<?php

namespace App\Http\Controllers\Auth;

use App\Models\product;
use App\Models\categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function product(){
        $data = categories::all();
        return view('admin.product.addproduct',['data' => $data]);
    }

    public function view(product $categories){
        $product = product::all();
        $categories = categories::all();
        return view('admin.product.view', ['product' => $product], ['categories' => $categories]);
    }
    
    public function update(Request $request, $id = null){
        $product = product::findorFail($id);
        $categories = categories::all();
        return view('admin.product.update')->with(compact('product','categories'));
    }

    public function destroy($id)
    {
        try {
            // Find the category by ID or fail
            $category = product::find($id);
           
            if($category){
                // Delete the category
                $category->delete();
                    
                // Optionally, return a success response
                return redirect()->route('showproduct');
            }
           
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['message' => 'Category not found or could not be deleted', 'error' => $e->getMessage()], 400);
        }
    }
    public function store(Request $request)
    {
       try{
        $validation = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required|string',
            'img' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required',
            'status' => 'required',
            'metadescription' => 'required',
            'metatitle' => 'required',
            
        ]);
       if ($validation->fails()) {
            return redirect()->route('product')
                            ->withInput()
                            ->withErrors($validation);
        }
        $combinedMetaFields = [
            'meta_description' => $request->input('metadescription'),
            'meta_title' => $request->input('metatitle'),
        ];

        // Convert the combined fields array to JSON
        $combinedFieldsJson = json_encode($combinedMetaFields);
    
        if($validation->passes()){
            
            $filename = ''; // Define filename variable
    
            if ($request->hasFile('img')) {
                $destination_path = 'public/img/product';
                $image = $request->file('img');
                $image_name = $image->getClientOriginalName();
                $path = $image->storeAs($destination_path, $image_name);
    
                $filename = $image_name; // Assign filename
            }

            $addCategries = product::create([
                'cid'=>$request->category,
                'name'=>$request->name,
               'img'=>$request->file('img')->getClientOriginalName(),
                'stock'=>$request->stock,
                'price'=>$request->price,
                'description'=>$request->description,
                'status'=>$request->status,
                'meta'=>$combinedFieldsJson,
            ]);
           
            return redirect()->route('showproduct');

        }
       }
        catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['message' => 'Category not found or could not be deleted', 'error' => $e->getMessage()], 400);
        }
    }

    public function putproduct(Request $request)
    {
        try{
            $id = $request->productid;

            $validation = Validator::make($request->all(), [
                'category' => 'required',
                'name' => 'required|string',
                'stock' => 'required|integer',
                'price' => 'required|integer',
                'description' => 'required',
                'status' => 'required',
                'metadescription' => 'required',
                'metatitle' => 'required',
                
            ]);

            if ($validation->fails()) {
                return redirect()->route('updateproduct',$id)
                                ->withInput()
                                ->withErrors($validation);
            }

            // Select img update
            if( $request->img == ''){
                $product = product::find($request->productid);
                $duplicateimg =  $product->img;
            }

            $filename = ''; // Define filename variable
    
            if ($request->hasFile('img')) {
                $destination_path = 'public/img/product';
                $image = $request->file('img');
                $image_name = $image->getClientOriginalName();
                $path = $image->storeAs($destination_path, $image_name);
    
                $filename = $image_name; // Assign filename
            }

            if($validation){
                $combinedMetaFields = [
                    'meta_description' => $request->input('metadescription'),
                    'meta_title' => $request->input('metatitle'),
                ];
    
                    // Convert the combined fields array to JSON
                    $combinedFieldsJson = json_encode($combinedMetaFields);
                    
                    if($request->img == ''){
                        $updateCategory = product::where('id', $id)->update([
                            'cid'=>$request->category,
                            'name'=>$request->name,
                            'img'=>$duplicateimg,
                            'stock'=>$request->stock,
                            'price'=>$request->price,
                            'description'=>$request->description,
                            'status'=>$request->status,
                            'meta'=>$combinedFieldsJson,
                    ]);
                    }else{
                        $updateCategory = product::where('id', $id)->update([
                            'cid'=>$request->category,
                            'name'=>$request->name,
                            'img'=>$request->file('img')->getClientOriginalName(),
                            'stock'=>$request->stock,
                            'price'=>$request->price,
                            'description'=>$request->description,
                            'status'=>$request->status,
                            'meta'=>$combinedFieldsJson,
                    ]);
                    }
               
                    if($updateCategory)
                    {
        
                        return redirect()->route('showproduct');
                    }
            }
           
        }
        catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['message' => 'Category not found or could not be deleted', 'error' => $e->getMessage()], 400);
        }
        
    }
}
