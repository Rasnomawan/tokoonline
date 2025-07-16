@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Product Detail</h2>

    <div class="card">
        <div class="card-body">
             <div class="d-flex justify-content-between mt-auto mb-2 mx-auto">
             <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Back to List</a>
             <div class="d-flex justify-content-end gap-2">
             <a href="{{ route('products.edit', $product->id) }}" class="btn bg-warning text-white mb-3">Edit</a>
               <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                 @csrf
                  @method('DELETE')
                    <button type="submit" class="btn bg-danger text-white">Delete</button>
               </form>  
             </div>                                                                
        </div>  

            <div class="row">
                <div class="col-md-4">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid rounded">
                    @else
                        <div class="text-muted">No image available</div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h4>{{ $product->product_name }}</h4>

                    <p><strong>Category:</strong> {{ $product->category->name_category ?? '-' }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p><strong>Price:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
                         
    </div>
</div>
@endsection
