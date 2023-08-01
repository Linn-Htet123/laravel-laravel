<aside>
    <div class="list-group">
        <a href="{{route('page.home')}}" class="list-group-item list-group-item-action">Home</a>
    </div>

    @auth
        <p class="mt-3 my-2">Dashboard</p>
        <div class="list-group">
            <a href="{{route('dashboard.home')}}" class="list-group-item list-group-item-action">Dashboard</a>
        </div>
        <p class="mt-3 my-2">Manage Category</p>
        <div class="list-group">
            <a href="{{route('category.index')}}" class="list-group-item list-group-item-action">Category list</a>
            <a href="{{route('category.create')}}" class="list-group-item list-group-item-action">Category create</a>
        </div>
        <p class="mt-3 my-2">Manage Inventory</p>
        <div class="list-group">
            <a href="{{route('inventory.index')}}" class="list-group-item list-group-item-action">Item list</a>
            <a href="{{route('inventory.create')}}" class="list-group-item list-group-item-action">Item create</a>
        </div>
        <p class="mt-3 my-2">Manage Password</p>
        <div class="list-group">
            <a href="{{route('auth.passwordChange')}}" class="list-group-item list-group-item-action">Change password</a>
        </div>
    @endauth
    @notauth
        <div class="list-group">
            <a href="{{route('auth.register')}}" class=" btn btn-info mb-2 ">Register</a>
            <a href="{{route('auth.login')}}" class="btn btn-outline-success ">Login</a>
        </div>
    @endnotauth
</aside>
