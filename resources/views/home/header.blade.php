<header class="header_section">
    <div class="container">
       <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ url('/redirect') }}"><img width="250" src="/images/logo.png" alt="#" /></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav">
                <li class="nav-item active">
                   <a class="nav-link" href="{{ url('/redirect') }}">Home <span class="sr-only">(current)</span></a>
                </li>
               <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                   <ul class="dropdown-menu">
                      <li><a href="{{ url('/redirect') }}">About</a></li>
                      <li><a href="{{ url('/redirect') }}">Testimonial</a></li>
                   </ul>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{ route('show_all_products') }}">Products</a>
                </li>
                
                <li class="nav-item">
                   <a class="nav-link" href="{{ url('/redirect') }}">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('show_cart') }}">Cart</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('show_my_orders') }}">My_Orders</a>
               </li>
               
               <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
               </form>
               @if (Route::has('login'))
                   @auth
                   <li class="nav-item" style="margin-left: 10px; size:50px">
                  <x-app-layout >

                  </x-app-layout>
                  </li>
                   @else   
                <li class="nav-item">
                  <a class="btn btn-primary" href="{{ route('login') }}" id="loginstyle">login</a>
               </li>
               @if (Route::has('register'))
               <li class="nav-item">
                  <a class="btn btn-success" href="{{ route('register') }}">rgister</a>
               </li>
               @endif
                   @endauth
               @endif
                  
             </ul>
          </div>
       </nav>
    </div>
 </header>