@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Product Page</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Selling Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td class="text-wrap text-center">{{ $item->id }}</td>
                                <td class="text-wrap w-25">{{ $item->category->name }}</td>
                                <td class="text-wrap w-25">{{ $item->name }}</td>
                                <td class="text-wrap">{{ $item->selling_price }}</td>
                                <td class="w-25">
                                    <img src="{{ asset('assets/upload/products/' . $item->image) }}" alt="Image Here"
                                        name="cate-image" class="img-fluid w-60">
                                </td>
                                <td>
                                    <a href="{{ url('edit-product/' . $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ url('delete-product/' . $item->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
