@extends('admin.dashboard')

@section('data')

    <div class="container">
        <h1 class="my-4">Categories</h1>
        <table id="datatable" class="table table-striped">
            <thead>
                <tr>
                    <th>Sh:</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
               @php
                    $id = 0;
                    @endphp
                @foreach($data as $category)
                @php
                     $id++;
                @endphp
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->img }}</td>
                        @php
                            if($category->status == 1){
                                $status = '<span style="color: green;">Active</span>';
                            } else {
                                $status = '<span style="color: red;">Inactive</span>';
                            }
                        @endphp
                        <td> {!! $status !!}</td>
                        <td><a href="{{route('updatecategories',$category->id)}}">Edit</a></td>
                        <td><a href="{{route('deletecategories', ['id' => $category->id])}}">Delete</a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection