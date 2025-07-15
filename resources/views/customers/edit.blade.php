@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-50">
            <form action="{{ route('customers.update',$customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="text-center bg-primary">
                    <h2><i class="fas fa-plus"></i> Edit Data Customer</h2>
                </div>

                <div class="form-group">
                    <label for="name">Customer name</label>
                    <input type="text" name="name" id="" class="form-control" value="{{ old('name',$customer->name) }}">
                </div>
                <div class="text-center">
                    <button class="btn bg-success text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection