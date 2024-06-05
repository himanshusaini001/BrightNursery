@extends('admin.dashboard')

@section('form')

<div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
    <form action="{{route('putcategories')}}" method="POST" enctype="multipart/form-data" class="custom-form">
        @csrf
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
        <div class="form-check">
            <input type="checkbox" class="form-check-input " name="status" id="status" value="1">
            <label class="form-check-label" for="status">Status</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3 float-right">Submit</button>
    </form>
  </div>
@endsection