@extends('layouts.master')

@section('title') Reset password @endsection

@section('content')
    {{--    {{route('inventory.show',[4,'keyword'=>'or'])}}--}}
    <h4>Reset password</h4>
    <form action="{{route('auth.resetPassword')}}" method="post">
        @csrf
        <input type="hidden" name="user_token" value="{{$user_token}}">
        <div class="mb-3">
            <label for="" class="form-label">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
            @error('password') <div class="invalid-feedback">{{$message}}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Confirm password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{old('password_confirmation')}}">
            @error('password_confirmation') <div class="invalid-feedback">{{$message}}</div> @enderror
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <button class="btn btn-primary">Reset password</button>
        </div>
    </form>
@endsection
