<header class="p-3 my-3 rounded border d-flex justify-content-between">
    <div class="text-primary">
        <a href="{{route('page.home')}}" class="text-decoration-none"><h4>My app</h4></a>
    </div>
   @auth
      <div class="">
          <a href="" class="text-decoration-none mx-3"> {{session('auth')['name']}}</a>

          <form action="{{route('auth.logout')}}" method="post" class="d-inline-block">
              @csrf
              <button class="btn btn-danger">logout</button>
          </form>
      </div>
    @endauth
</header>
