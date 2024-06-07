@extends('admin.dashboard')

@section('option')
    Add Categories.
@endsection

@section('pagename')
    Category
@endsection

@section('form')
    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
        <form action="{{ route('editcategories') }}" method="POST" enctype="multipart/form-data" class="custom-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $category->name ?? old('name') }}" name="name" id="name">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" class="form-control-file @error('img') is-invalid @enderror" name="img" id="img">
                @if($category->img)
                    <img src="{{ asset('storage/img/category/' . $category->img) }}" width="50px" height="50px">
                @endif
                @error('img')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" onchange="checkValidity()">
                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            
            <input type="hidden" name="categoryid" id="categoryid" value="{{ $category->id }}">
            <button type="submit" class="btn btn-primary mt-3 float-right">Submit</button>
        </form>
    </div>
@endsection
