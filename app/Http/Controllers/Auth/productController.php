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
        $category = product::findorFail($id);
        return view('admin.categories.update')->with(compact('category'));
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
                return redirect()->route('showcategories');
            }
           
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['message' => 'Category not found or could not be deleted', 'error' => $e->getMessage()], 400);
        }
    }
    public function store(Request $request)
    {
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
                'meta_description' => $request->input('meta_description'),
                'meta_title' => $request->input('meta_title'),
            ];

            // Convert the combined fields array to JSON
            $combinedFieldsJson = json_encode($combinedMetaFields);
           
            if($validation->passes()){
                
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

    public function putcategories(Request $request)
    {
        try{
            $id = $request->categoryid;

            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'img' => 'required',
                'status' => 'required',
            ]);

            if ($validation->fails()) {
                return redirect()->route('updatecategories',$id)
                                ->withInput()
                                ->withErrors($validation);
            }

        
        $updateCategory = product::where('id', $id)->update([
                'name' => $request->name,
                'img'=>$request->file('img')->getClientOriginalName(),
                'status' => $request->status,
            ]);
            if($updateCategory)
            {

                return redirect()->route('showcategories');
            }
        }
        catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['message' => 'Category not found or could not be deleted', 'error' => $e->getMessage()], 400);
        }
        
    }
}
