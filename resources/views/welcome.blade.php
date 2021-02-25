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

<router-link class="nav-link" to='/Dashboard'>
<img src="media/logo.png" alt="logo" style="width:40px;">
  <label class="navbar-brand">{{ config('app.name', 'Araneus') }}</label>
</router-link>
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

    <button><router-link to="/PO">Purchase Order</router-link></button>

    <button data-toggle="collapse" data-target="#setup" class="btnMenu">Data Setup</button>
        <div id="setup" class="collapse">
            <ul>   
	            <li><router-link to="/Vendor_Create">Vendor</router-link></li>
                <li><router-link to="/Customer_Create">Customer</router-link></li>
                <li><router-link to="/Items_Create">Items</router-link></li>
            </ul>
        </div>

    <button data-toggle="collapse" data-target="#Sales" class="btnMenu">Sales</button>
        <div id="Sales" class="collapse">
            <ul>  
                <li><router-link to="/Upcoming" class="notAvailable">Products</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Service</router-link></li>
                <li><router-link to="/invoice">Sales Invoice</router-link></li>
            </ul>
        </div>

    <button data-toggle="collapse" data-target="#Inventory" class="btnMenu">Inventory</button>
        <div id="Inventory" class="collapse">
            <ul>   
	            <li><router-link to="/PO_list">Receiving</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Dispatching</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Returns</router-link></li>
            </ul>
        </div>

        <button data-toggle="collapse" data-target="#Report" class="btnMenu">Report</button>
        <div id="Report" class="collapse">
            <ul>   
	            <li><router-link to="/DeviceHistory">Device Repair History</router-link></li>
                <li><router-link to="/SalesHistory">Sales History</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">???</router-link></li>
            </ul>
        </div>

        <button data-toggle="collapse" data-target="#Accounting" class="btnMenu">Accounting</button>
        <div id="Accounting" class="collapse">
            <ul>   
	            <li><router-link to="/Upcoming" class="notAvailable">Journals</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Cash Flow</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Reports</router-link></li>
            </ul>
        </div>


<button data-toggle="collapse" data-target="#WareHouse" class="btnMenu">WareHouse</button>
        <div id="WareHouse" class="collapse">
            <ul>   
	            <li><router-link to="/Upcoming" class="notAvailable">Receiving</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Placing/Put-Away</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Picking</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Added Value</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Dispatching</router-link></li>
                <li><router-link to="/Upcoming" class="notAvailable">Returns</router-link></li>
            </ul>
        </div>

<button data-toggle="collapse"><router-link  to="/Location">WareHouse Setup</router-link></button>
</div>
<!--side bar End-->
<div>
<br>
        <router-view></router-view> 
<div>

<!----------- Footer ------------>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<footer class="footer-bs">
        <div class="row">
        	<div class="col-md-4 footer-brand animated fadeInLeft">
            <!----------------- di binabasa ------------------------>
            <img src="../media/barkspider2 copy.png" alt="logo" style="width:40px;">
            <!----------------- pero eto binabasa ------------------------>
            <img src="../media/logo.png" alt="logo" style="width:40px;">
                <br>
         
                    <p id="bbb">The website footer is not to be neglected. According to research and different studies, it is a favourable place to capitalize on to increase conversions. Depending on the website type and the objectives of each page, the footer might include different elements of use for the visitors. The only thing you have to do is choose the RIGHT elements to put in the website footer, and organize them according to a clean structure, easy to browse and take benefit from.</p>
                
                    <p>© 2014 BS3 UI Kit, All rights reserved</p>
            </div>

        	<div class="col-md-3 footer-nav animated fadeInUp">
            	<h4>Company</h4>
                <br>
                <br>
            	<div class="col-md-6">
                    <ul class="pages">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Terms & Condition</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

        	<div class="col-md-5 footer-social animated fadeInDown">
            	<h4>Contact Us</h4>
                <br>
                <br>
            	<ul>
                	<li><a href="#">Facebook</a></li>
                	<li><a href="#">Twitter</a></li>
                	<li><a href="#">Instagram</a></li>
                	<li><a href="#">RSS</a></li>
                </ul>
            </div>
        
        </div>
      
    </footer>

</div>
@endsection

<script type="text/javascript">

function openNav() {
  document.getElementById("mySidenav").style.width = "350px";
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
<style>
    .notAvailable{
        background-color:grey;
    }
    #bbb{
        padding:15px;
    }
    .btnMenu{
        font-size:18px;
    }
</style>




