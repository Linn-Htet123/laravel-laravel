@extends('layouts.master')

@section('title') Show details  @endsection

@section('content')
    <h4>Detail Item</h4>
    <table class="table">
        <thead>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Price</td>
            <td>Stock</td>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td>1</td>
                <td>{{$item->name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->stock}}</td>
            </tr>
        </tbody>
    </table>
@endsection

