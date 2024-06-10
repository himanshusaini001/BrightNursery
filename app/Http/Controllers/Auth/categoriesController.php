<?php

namespace App\Http\Controllers\Auth;

use App\Models\categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class categoriesController extends Controller
{

    public function categories(){
        return view('admin.categories.addcategories');
    }

    public function view(){
        $data = categories::all();
        return view('admin.categories.view', ['data' => $data]);
    }
    
    public function update(Request $request, $id = null){
        $category = categories::findorFail($id);
        return view('admin.categories.update')->with(compact('category'));
    }

    // Delete Categories
    public function destroy($id)
    {
        try {
            // Find the category by ID or fail
            $category = categories::find($id);
           
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

    // Add Categories
    public function store(Request $request)
    {
        try {

            // Validation
            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'img' => 'required|image', // Assuming img is an image file
                'status' => 'required',
            ]);
    
            
            // sand Validation Error Categories  Page
            if ($validation->fails()) {
                return redirect()->route('categories')
                    ->withInput()
                    ->withErrors($validation->errors()->all());
            }
           
            // Uploade img storage Folder
            $filename = ''; // Define filename variable
    
            if ($request->hasFile('img')) {
                $destination_path = 'public/img/category';
                $image = $request->file('img');
                $image_name = $image->getClientOriginalName();
                $path = $image->storeAs($destination_path, $image_name);
    
                $filename = $image_name; // Assign filename
            }

            // Create Data in categories Table
            $addCategories = categories::create([
                'name' => $request->name,
                'img' => $filename, // Use filename here
                'status' => $request->status,
            ]);

            // Redirect  in View Categories Table
            return redirect()->route('showcategories');

        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json(['message' => 'Category not found or could not be created', 'error' => $e->getMessage()], 400);
        }
    }
    
    // Update Categories
    public function putcategories(Request $request)
    {   
       
        try{
            // Select id
            $id = $request->categoryid;
            $model = categories::findOrFail($id);

            // Validatoion 
            $validation = Validator::make($request->all(), [
                'name' => 'required|string',
                'status' => 'required',
            ]);

            // Sand Validation error in Add Categories Page
            if ($validation->fails()) {
                return redirect()->route('updatecategories',$id)
                                ->withInput()
                                ->withErrors($validation);
            }

            // Select img update
            if( $request->img == ''){
                $category = categories::find($request->categoryid);
                $duplicateimg =  $category->img;
            }



            // Upload img in Storage Folder
            $filename = ''; // Define filename variable
    
            if ($request->hasFile('img')) {
                $destination_path = 'public/img/category/';
                $image = $request->file('img');
                $image_name = $image->getClientOriginalName();
                $path = $image->storeAs($destination_path, $image_name);
    
                $filename = $image_name; // Assign filename
            }

            // check Condation img is no t null
            if($request->img == ''){
                // Snad Update Data in Category Table 
                $updateCategory = categories::where('id', $id)->update([
                    'name' => $request->name,
                    'img'=>$duplicateimg,
                    'status' => $request->status,
                ]);
            }else{
                if ($model->img) {
                    Storage::delete('public/img/category/' . $model->img);
                }

                // Snad Update Data in Category Table 
                $updateCategory = categories::where('id', $id)->update([
                    'name' => $request->name,
                    'img'=>$request->file('img')->getClientOriginalName(),
                    'status' => $request->status,
                ]);
            }

            // Redirect Categories page
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