@extends('layouts.master')

@section('title') Create Category  @endsection

@section('content')
    <h4>Create Category</h4>
    <form action="{{route('category.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Category title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea type="number" class="form-control" rows="7" name="description"></textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary">Save Category</button>
        </div>
    </form>
@endsection
