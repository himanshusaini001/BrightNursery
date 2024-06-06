@extends('admin.dashboard')


@section('data')
    <div class="container">
        <h1 class="my-4">Categories</h1>
        <table id="datatable" class="table table-striped">
            <thead>
                <tr>
                    <th>Sh:</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Stcok</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
               @php
                    $id = 0;
                    @endphp
                @foreach($product as $products)
                @php
                     $id++;
                @endphp
                    <tr>
                        <td>{{ $id }}</td>
                        @foreach($categories as $categoriesname)
                           @php 
                            if($products->cid ==  $categoriesname->id){
                                $category = $categoriesname->name;
                            }
                           @endphp
                        @endforeach
                        <td>{{ $category }}</td>
                        <td>{{ $products->name }}</td>
                        <td>{{ $products->img }}</td>
                        <td>{{ $products->stock }}</td>
                        <td>{{ $products->price }}</td>
                        <td>{{ $products->description }}</td>

                        @php
                            if($products->status == 1){
                                $status = '<span style="color: green;">Active</span>';
                            } else {
                                $status = '<span style="color: red;">Inactive</span>';
                            }
                        @endphp
                        <td> {!! $status !!}</td>
                        <td><a href="{{route('updateproduct',$products->id)}}">Edit</a></td>
                        <td><a href="{{route('deletecategories', ['id' => $products->id])}}">Delete</a></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection