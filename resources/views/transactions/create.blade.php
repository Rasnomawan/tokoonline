@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
    <div class="card">
        <div class="text-center mt-2">
            <h2>Create Transaction</h2>
        </div>
    <form action="{{ route('transactions.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
        @csrf

        {{-- Product Info --}}
        <div class="mb-3">
            <label for="product" class="form-label">Product</label>
            <input type="text" id="product" class="form-control" value="{{ $product->product_name }}" readonly>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </div>
         <div class="mb-3">
            <label for="customer_id" class="form-label">Customer name</label>
            <select name="customer_id" id="customer_id" class="form-control">
                <option selected disabled>-- Choose Customer --</option>
                @foreach($customers as $c)
                <option value="{{ $c->id }}">
                {{ $c->name }}
                </option>
                @endforeach
            </select>
             <div class="invalid-feedback">
                Choose Costumer first 
            </div>
        </div>

        {{-- Quantity --}}
        <div class="mb-3">
            <label for="quantity_id" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" min="1" max="{{ $maxstock }}" class="form-control" required>
            <div class="invalid-feedback">
                min 1 -{{ $maxstock }}
            </div>
        </div>

        {{-- Total Price --}}
        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="text" id="total_price" name="total_price" class="form-control" value="{{ $product->price }}" readonly>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('products.index') }}" class="btn bg-secondary text-white">Back</a>
           <button type="submit" class="btn btn-success">Confirm Purchase</button> 
        </div>
        
    </form>
    </div>
  </div>
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