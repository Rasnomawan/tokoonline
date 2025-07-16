@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
        <div class="card w-50 mx-auto">
            <div class="text-center mt-3">   
    <h1 class="mb-4">Edit Category</h1>
            </div>
               <form action="{{ route('categories.update', $category->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name_category" class="form-label">Category Name</label>
                    <input type="text" name="name_category" id="name_category" class="form-control" value="{{ old('name_category', $category->name_category) }}">
                    <div class="invalid-feedback">
                        insert name category
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class=" btn bg-primary">Save</button>
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