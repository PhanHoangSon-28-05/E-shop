@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Registered users</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td class="text-wrap">{{ $item->id }}</td>
                                <td class="text-wrap">{{ $item->name . ' ' . $item->lname }}</td>
                                <td class="text-wrap">{{ $item->email }}</td>
                                <td class="text-wrap">{{ $item->phone }}</td>
                                <td>
                                    <a href="{{ url('view-user/' . $item->id) }}" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
