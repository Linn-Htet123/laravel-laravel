@extends('layouts.master')

@section('title') Create Item  @endsection

@section('content')
    <h4>Create Item</h4>
    <form action="{{route('inventory.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Item name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
            @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Item Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}">
            @error('price') <div class="invalid-feedback">{{$message}}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Item Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{old('stock')}}">
            @error('stock') <div class="invalid-feedback">{{$message}}</div> @enderror
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary">Save Item</button>
        </div>
    </form>
@endsection
