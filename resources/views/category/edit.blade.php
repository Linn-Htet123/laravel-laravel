@extends('layouts.master')

@section('title') Edit Category  @endsection

@section('content')
    <h4>Edit Category</h4>
    <form action="{{route('category.update',$category->id)}}" method="post">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Category title</label>
            <input type="text" class="form-control" name="title" value="{{$category->title}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea type="number" class="form-control" rows="7" name="description">{{$category->description}}</textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary">Edit Category</button>
        </div>
    </form>
@endsection
