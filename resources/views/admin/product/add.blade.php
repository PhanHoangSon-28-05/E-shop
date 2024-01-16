@extends('layouts.admin')

@section('content')
    <div class="card p-3">
        <div class="card-headeer">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="cate_id">
                            <option value="">Select a Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" name="slug" id="">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Small Description</label>
                        <textarea rows="3" class="form-control" name="small_description" id=""></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea rows="3" class="form-control" name="description" id=""></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Original Price</label>
                        <input type="number"class="form-control" name="original_price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Selling Price</label>
                        <input type="number"class="form-control" name="selling_price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Tax</label>
                        <input type="number"class="form-control" name="tax">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Quantity</label>
                        <input type="number"class="form-control" name="qty">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox" name="trending">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea rows="3" class="form-control" name="meta_keywords" id=""></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea rows="3" class="form-control" name="meta_description" id=""></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <input type="file" class="form-control" name="image" id="">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
