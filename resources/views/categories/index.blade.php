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
            <div class="text-center">
                <h1>List Category</h1>
            </div>
            <div class="d-flex justify-content-between mb-3 mt-2">
                <a href="{{ route('products.index') }}" class="btn bg-secondary text-white">Back</a>
                <a href="{{ route('categories.create') }}" class="btn bg-primary text-white">Add Category</a>
            </div>
            <div class="card-body"></div>
               <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($category as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->name_category }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('categories.destroy', $c->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"><a href="{{ route('categories.create') }}">add first </a> if no data appears</td>
                </tr>
            @endforelse
        </tbody>
    </table>
        </div>
    </div>
</div>

@endsection