@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <form action="{{  }}" method="post">
                @csrf

                <div>
                    <label for="">Costumer name</label>
                    <input type="text" name="" id="">
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <label for=""></label>
                <select name="" id="">
                    <option value=""></option>
                </select>
                <div>
                    <button class="btn bg-success text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection