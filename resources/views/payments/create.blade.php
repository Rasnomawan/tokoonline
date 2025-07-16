@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
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
        <div class="card w-50 mx-auto">
               <div class="text-center">
                 <h1>Payment</h1>
               </div>
           <form action="{{ route('payments.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

            <div class="mb-3">
                <label class="form-label">Nominal Bayar:</label>
                <input type="number" name="amount" class="form-control" required>
            </div>

            <div class="d-flex mb-3 gap-2">
                <a href="{{ route('transactions.index') }}" class="btn bg-secondary text-white">Back</a>
                <button type="submit" class="btn bg-success text-white">Pay</button>  
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