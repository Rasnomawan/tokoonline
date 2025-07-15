@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-50 mx-auto">
            <form action="{{ route('customers.store') }}" method="post">
                @csrf
                <div class="text-center bg-primary">
                    <h2><i class="fas fa-plus"></i> Create new Data Customer</h2>
                </div>

                <div class="form-group">
                    <label for="name">Customer name</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                    <input type="hidden" name="entry" id="" value="{{ now()->format('Y-m-d') }}">
                <div class="d-flex justify-content-between mb-2">
                    <a href="{{ route('customers.index') }}" class="btn bg-secondary text-white">Kembali</a>
                    <button class="btn bg-success text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection