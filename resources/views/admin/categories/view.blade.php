@extends('admin.dashboard')

@section('data')

    <div class="container">
        <h1 class="my-4">Categories</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Updated At</th>
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
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection