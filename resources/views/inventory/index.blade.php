@extends('layouts.master')

@section('title') Item list  @endsection

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <div class="row d-flex justify-content-between mb-3 py-3">
        <div class="col-3">
            <a href="{{route('inventory.create')}}" class="btn btn-outline-primary">create</a>
        </div>
      <div class="col-5">
          <form action="{{route('inventory.index')}}">
              <div class="input-group">
                  <input type="text" name="keyword" value="{{request()->keyword ?? ''}}" placeholder="search item..." class="form-control">
                  @if(request()->has('keyword'))
                      <a href="{{route('inventory.index')}}" class="btn btn-sm btn-danger text-white"><span class="mt-2">X</span></a>
                  @endif
                  <button class="btn btn-primary">Search</button>
              </div>
          </form>
      </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>
                    Name
                    <a href="{{route('inventory.index',['name'=>'desc'])}}" class="btn btn-sm btn-outline-info text-black ms-4"> < </a>
                    <a href="{{route('inventory.index',['name'=>'asc'])}}" class="btn btn-sm btn-outline-info text-black"> > </a>
                    <a href="{{route('inventory.index')}}" class="btn btn-sm btn-outline-info text-black"> clear </a>
                </td>
                <td>Price</td>
                <td>Stock</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $key=>$item)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->stock}}</td>
                    <td>
                        <a href="{{route('inventory.show',$item->id)}}" class="btn btn-primary">Details</a>
                        <form class="d-inline-block" action="{{route('inventory.destroy',$item->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger">del</button>
                        </form>
                        <a class="btn btn-success" href="{{route('inventory.edit',$item->id)}}">update</a>
                    </td>
                </tr>
            @empty
                <td class="text-center bg-light p4 text-center" colspan="4">
                    <p>There is no item</p>
                    <a href="{{route('inventory.create')}}" class="btn btn-primary">create item</a>
                </td>
            @endforelse
        </tbody>
    </table>
    <div>
        {{$items->onEachSide(1)->links()}}
    </div>
@endsection

