<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a href="{{route('show.cart')}}" class="nav-link"> 
              <span class="fas fa-shopping-cart">
                ({{session()->has('cart')?session()->get('cart')->totalQty:'0'}})
              </span>
            </a>
          </li>
          
        <li class="nav-item dropdown no-arrow mx-1"  >
            <a href="{{route('login')}}" class="nav-link ">Login</a>
        </li>
        <li class="nav-item dropdown no-arrow mx-1"  >
          <a href="{{route('register')}}" class="nav-link ">Register</a>
      </li>
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" href="{{ route('login') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             <i class="icon-inbox"></i>{{ __('Logout') }}
         </a>
  
         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
          </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a href="{{route('order')}}" class="nav-link">Order</a>
      </li>
      <li class="nav-item dropdown no-arrow mx-1 ">
        <a href="{{route('page')}}" class="nav-link">Home</a>
      </li>
    

     

    
    </ul>


  </nav>