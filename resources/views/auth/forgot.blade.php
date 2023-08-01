@extends('layouts.master')

@section('title') Forgot Password @endsection

@section('content')
    {{--    {{route('inventory.show',[4,'keyword'=>'or'])}}--}}
    <h4>Enter your Email to reset password</h4>
    <form action="{{route('auth.checkEmail')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Enter your email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
            @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <button class="btn btn-primary">Reset</button>
        </div>
    </form>
@endsection
