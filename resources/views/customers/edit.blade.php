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
        <div class="card w-50">
            <form action="{{ route('customers.update',$customer->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="text-center bg-primary">
                    <h2><i class="fas fa-plus"></i> Edit Data Customer</h2>
                </div>

                <div class="form-group">
                    <label for="name">Customer name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$customer->name) }}">
                    <div class="invalid-feedback">
                        insert name customer
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <a href="{{ route('customers.index') }}" class="btn bg-secondary text-white">Back</a>
                    <button class="btn bg-success text-white">Submit</button>
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