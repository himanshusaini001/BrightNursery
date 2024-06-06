@extends('admin.dashboard')

@section('form')

<div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
    <form action="{{route('addproduct')}}" method="POST" enctype="multipart/form-data" class="custom-form">
        @csrf
        <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                <div class="form-group">
                    <label for="name">Category:</label>
                    <select class="form-control-file @error('category') is-invalid @enderror" id="category" name="category" onchange="checkValidity()">
                        <option value="">Select</option>
                        @foreach($data as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control-file  @error('name') is-invalid @enderror" name="name" id="name" >
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="img">Image:</label>
                    <input type="file" class="form-control-file @error('img') is-invalid @enderror" name="img" id="img" >
                    @error('img')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Stock:</label>
                    <input type="number" class="form-control-file  @error('stock') is-invalid @enderror" name="stock" id="stock" >
                    @error('stock')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                <div class="form-group">
                    <label for="name">Price:</label>
                    <input type="text" class="form-control-file  @error('price') is-invalid @enderror" name="price" id="price" >
                    @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">description:</label>
                    <input type="text" class="form-control-file  @error('description') is-invalid @enderror" name="description" id="description" >
                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Meta description:</label>
                    <input type="text" class="form-control-file  @error('metadescription') is-invalid @enderror" name="metadescription" id="metadescription" >
                    @error('metadescription')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Meta Title:</label>
                    <input type="text" class="form-control-file  @error('metatitle') is-invalid @enderror" name="metatitle" id="metatitle" >
                    @error('metatitle')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Status:</label>
            <select class="form-control-file @error('status') is-invalid @enderror" id="status" name="status" onchange="checkValidity()">
                <option value="">Select</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            @error('status')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3 float-right">Submit</button>
    </form>
  </div>
@endsection