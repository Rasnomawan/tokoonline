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

        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Product List</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Check Category</a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
                </div>
            </div>

            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="text-center py-5 bg-light text-muted">No image</div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="card-text mb-1"><strong>Category:</strong> {{ $product->category->name_category ?? '-' }}</p>
                                <p class="card-text mb-1"><strong>Stock:</strong> {{ $product->stock }}</p>
                                <p class="card-text mb-1"><strong>Price:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="card-text"><strong>Description:</strong> {{ Str::limit($product->description, 60) }}</p>
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn bg-info mb-3 text-white">Show</a>
                                    <a href="{{ route('transactions.create',$product->id) }}" class="btn bg-success text-white mb-3">Buy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">No products found.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
