@extends('layouts.master')

@section('title') verify @endsection

@section('content')
    {{--    {{route('inventory.show',[4,'keyword'=>'or'])}}--}}
    <h4>verify</h4>
    <form action="{{route('auth.verifying')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">verify code</label>
            <input type="text" class="form-control @error('verify_code') is-invalid @enderror" name="verify_code" value="{{old('verify_code')}}">
            @error('verify_code') <div class="invalid-feedback">{{$message}}</div> @enderror
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <button class="btn btn-primary">Verify</button>
        </div>
    </form>
@endsection
