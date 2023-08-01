@extends('layouts.master')

@section('title') Show details  @endsection

@section('content')
    <h4>Detail Item</h4>
    <table class="table">
        <thead>
        <tr>
            <td>#</td>
            <td>Title</td>
            <td>Description</td>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td>1</td>
                <td>{{$category->title}}</td>
                <td>{{$category->description}}</td>
            </tr>
        </tbody>
    </table>
@endsection

