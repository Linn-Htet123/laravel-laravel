@extends('layouts.master')
@php use Illuminate\Support\Str; @endphp
@section('title') Category list  @endsection

@section('content')
    <h4>Category Item</h4>
    <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Description</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $key=>$category)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{Str::limit($category->description,40,'(...)')}}</td>
                    <td>
                        <a href="{{route('category.show',$category->id)}}" class="btn btn-primary">Details</a>
                        <form class="d-inline-block" action="{{route('category.destroy',$category->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger">del</button>
                        </form>
                        <a class="btn btn-success" href="{{route('category.edit',$category->id)}}">update</a>
                    </td>
                </tr>
            @empty
                <td class="text-center bg-light p4 text-center" colspan="4">
                    <p>There is no item</p>
                    <a href="{{route('category.create')}}" class="btn btn-primary">create item</a>
                </td>
            @endforelse
        </tbody>
    </table>
@endsection

