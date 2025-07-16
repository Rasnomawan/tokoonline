@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

   <div class="col-md-12">
    {{-- Error dari session --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error dari validasi (misal: $errors->any()) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option selected disabled>-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                        {{ $category->name_category }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Choose Category first
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            @if ($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" width="150">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Leave empty to keep current image.</small>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
            <div class="invalid-feedback">
                inout stock first
            </div>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (IDR)</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            <div class="invalid-feedback">
                insert price 
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
@section('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
@endsection