{{-- Extand Main Html Page --}}
@extends('admin.dashboard')

{{-- Add Text header --}}
@section('pagename')
    Product
@endsection

{{-- Add Text Form --}}
@section('form')
@php
    $meta = json_decode($product->meta);
  
@endphp
<div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
    <form action="{{route('editproduct')}}" method="POST" enctype="multipart/form-data" class="custom-form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                <div class="form-group">
                    <label for="name">Category :</label>
                    <select class="form-control-file @error('category') is-invalid @enderror" id="category" name="category" onchange="checkValidity()">
                            @foreach($categories as $selectcategory)
                        @php    
                            if($selectcategory->id == $product->cid ){
                                $categoryselectname = $selectcategory->name;
                                $categoryselectid= $selectcategory->id;
                            }
                        @endphp
                        @endforeach
        
                        <option value="{{$categoryselectid}}">{{$categoryselectname}}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input type="text" class="form-control-file  @error('name') is-invalid @enderror" value="{{$product->name}}" name="name" id="name" >
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="img">Image :</label>
                    <input type="file" class="form-control-file @error('img') is-invalid @enderror" value="{{$product->img}}" name="img" id="img"  >
                    @if($category->img)
                     <img src="{{ asset('storage/img/product/' . $product->img) }}" width="100px" height="100px" class="mt-3"></td>
                    @endif
                    @error('img')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Stock :</label>
                    <input type="number" class="form-control-file  @error('stock') is-invalid @enderror" value="{{$product->stock}}" name="stock" id="stock" >
                    @error('stock')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                <div class="form-group">
                    <label for="name">Price :</label>
                    <input type="number" class="form-control-file  @error('price') is-invalid @enderror" value="{{$product->price}}" name="price" id="price" >
                    @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Description :</label>
                    <input type="text" class="form-control-file  @error('description') is-invalid @enderror" value="{{$product->description}}" name="description" id="description" >
                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Meta Description :</label>
                    <input type="text" class="form-control-file  @error('metadescription') is-invalid @enderror" value="{{$meta->meta_description}}" name="metadescription" id="metadescription" >
                    @error('metadescription')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Meta Title :</label>
                    <input type="text" class="form-control-file  @error('metadescription') is-invalid @enderror" value="{{$meta->meta_title}}" name="metatitle" id="metatitle" >
                    @error('metadescription')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Status :</label>
            <select class="form-control-file @error('status') is-invalid @enderror" id="status" name="status" onchange="checkValidity()">
                @php
                    if ($product->status == 1) {
                        @endphp
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        @php
                    }
                    else{
                        @endphp
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        @php
                    }
                @endphp
            </select>
            @error('status')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <input type="hidden" class="form-control-file " name="productid" id="productid" value="{{$product->id}}">
        <button type="submit" class="btn btn-primary mt-3 float-right">Submit</button>
    </form>
  </div>
@endsection