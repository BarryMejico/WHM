@extends('layouts.app')

@section('content') 
<div>
<nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-fixed-top">
@guest
    @if (Route::has('register'))
    @endif
@else
<span class="navbar-brand" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
@endguest


<img src="bird.jpg" alt="logo" style="width:40px;">
  <a class="navbar-brand" href="#">{{ config('app.name', 'Araneus') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button> 
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
      <router-link class="nav-link" to='/'>Home</router-link>
      </li>
      <li class="nav-item">
      <router-link class="nav-link" to='/about'>About Us</router-link>
      </li>
         
    </ul>

     <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <!--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                                <router-link class="nav-link" to='/login_'>Login</router-link>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <!--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                                    <router-link class="nav-link" to='/register_'>Register</router-link>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
  </div>  
</nav>
</div>
<!--side bar-->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   
<!--<ul onclick="closeNav()">-->
    <ul> 
    <li><router-link to="/PO">Purchase Order</router-link></li>
    <button data-toggle="collapse" data-target="#setup">Data Setup</button>
        <div id="setup" class="collapse">
            <ul>   
	            <li><router-link to="/Vendor_Create">Vendor</router-link></li>
                <li><router-link to="/Customer_Create">Customer</router-link></li>
                <li><router-link to="/Items_Create">Items</router-link></li>
            </ul>
        </div>
    <li><router-link to="/PO">Products</router-link></li>
    <li><router-link to="/PO">Service</router-link></li>
    <li><router-link to="/PO">Sales Invoice</router-link></li>
    <li><router-link to="/PO">Inventory</router-link></li>
</ul>
</div>
<!--side bar End-->
<div>
<br>
        <router-view></router-view>
<div>

<!----------- Footer ------------>
<footer class="footer-bs">
        <div class="row">
        	<div class="col-md-3 footer-brand animated fadeInLeft">
            	<h2>Logo</h2>
                <p>Suspendisse hendrerit tellus laoreet luctus pharetra. Aliquam porttitor vitae orci nec ultricies. Curabitur vehicula, libero eget faucibus faucibus, purus erat eleifend enim, porta pellentesque ex mi ut sem.</p>
                <p>© 2014 BS3 UI Kit, All rights reserved</p>
            </div>
        	<div class="col-md-4 footer-nav animated fadeInUp">
            	<h4>Menu —</h4>
            	<div class="col-md-6">
                    <ul class="pages">
                        <li><a href="#">Travel</a></li>
                        <li><a href="#">Nature</a></li>
                        <li><a href="#">Explores</a></li>
                        <li><a href="#">Science</a></li>
                        <li><a href="#">Advice</a></li>
                    </ul>
                </div>
            	<div class="col-md-6">
                    <ul class="list">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">Terms & Condition</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        	<div class="col-md-2 footer-social animated fadeInDown">
            	<h4>Follow Us</h4>
            	<ul>
                	<li><a href="#">Facebook</a></li>
                	<li><a href="#">Twitter</a></li>
                	<li><a href="#">Instagram</a></li>
                	<li><a href="#">RSS</a></li>
                </ul>
            </div>
        	<div class="col-md-3 footer-ns animated fadeInRight">
            	<h4>Newsletter</h4>
                <p>A rover wearing a fuzzy suit doesn’t alarm the real penguins</p>
                <p>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
                      </span>
                    </div><!-- /input-group -->
                 </p>
            </div>
        </div>
    </footer>

</div>
@endsection

<script>

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  }

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  }
  
  // Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>




