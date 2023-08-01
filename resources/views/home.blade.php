@extends('layouts.master')

@section('title') Home page @endsection

@section('content')
    {{route('inventory.show',[4,'keyword'=>'or'])}}
    <h4>I am home</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque dolore ex fuga fugiat harum id illum ipsam ipsum iusto nemo non numquam possimus quaerat, qui quisquam tempora ullam velit?</p>
@endsection
