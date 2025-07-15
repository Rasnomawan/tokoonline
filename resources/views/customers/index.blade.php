@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
         <div class="col-md-12">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
             @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="card">
            <div class="text-center mt-2">
                <h2>Customer List</h2>
            </div>
            <div class="card-body">
                <div class="text-end">
                <a href="{{ route('customers.create') }}" class="btn bg-success text-white"><i class="fas fa-plus"></i> Add Customers</a>
                </div>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Entry Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->entry }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('customers.edit', $c->id) }}" class="btn bg-warning text-white">Edit</a>
                                <form action="{{ route('customers.destroy',$c->id) }}" method="post">
                                    @csrf   
                                    @method('delete')
                                    <button class="btn bg-danger text-white">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection