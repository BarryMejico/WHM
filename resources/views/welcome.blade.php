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

  <li class="navbar-toggler" type="li" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </li> 
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="li" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
  <a href="javascript:void(0)" class="closeli" onclick="closeNav()"><b-icon icon="x" font-scale="2"></b-icon></a>
 
    <ul>
        <li class="Menu2"><router-link to="/PO"> <b-icon icon="cart-x" font-scale="2"></b-icon> Purchase Order</router-link></li>  

        <!-- <button data-toggle="collapse" data-target="#Report" class="btnMenu">Report</button>
        <div id="Report" class="collapse">
            <ul>   
	            <li><router-link onclick="closeNav()" to="/DeviceHistory">Device Repair History</router-link></li>
                <li><router-link onclick="closeNav()" to="/SalesHistory">Sales History</router-link></li>
                <li><router-link onclick="closeNav()" to="/TransactionHistory">Job Order History</router-link></li>
            </ul>
        </div> -->
        <li data-toggle="collapse" data-target="#setup" class="Menu"> <b-icon icon="clipboard" font-scale="2"></b-icon> Data Setup</li>
            <div id="setup" class="collapse">
                <ul>   
                    <li class="subMenus"><router-link onclick="closeNav()" to="/Vendor_Create">Vendor</router-link></li>
                    <li class="subMenus"><router-link onclick="closeNav()" to="/Customer_Create">Customer</router-link></li>
                    <li class="subMenus"><router-link onclick="closeNav()" to="/Items_Create">Items</router-link></li>
                </ul>
                <br>
            </div>

        <li data-toggle="collapse" data-target="#Sales" class="Menu"><b-icon icon="tags" font-scale="2"></b-icon> Sales</li>
            <div id="Sales" class="collapse">
                <ul>  
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Products</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Service</router-link></li>
                    <li class="subMenus"><router-link onclick="closeNav()" to="/invoice">Sales Invoice</router-link></li>
                    <li class="subMenus"><router-link onclick="closeNav()" to="/JobOrder">Job Order</router-link></li>
                </ul>
            </div>

        <li data-toggle="collapse" data-target="#Inventory" class="Menu"><b-icon icon="clipboard-check" font-scale="2"></b-icon> Inventory</li>
            <div id="Inventory" class="collapse">
                <ul>   
                    <li class="subMenus"><router-link onclick="closeNav()" to="/PO_list">Receiving</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Dispatching</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Returns</router-link></li>
                </ul>
            </div>

        <li data-toggle="collapse" data-target="#Report" class="Menu"><b-icon icon="clipboard-data" font-scale="2"></b-icon> Report</li>
            <div id="Report" class="collapse">
                <ul>   
                    <li class="subMenus"><router-link onclick="closeNav()" to="/DeviceHistory">Device Repair History</router-link></li>
                    <li class="subMenus"><router-link onclick="closeNav()" to="/SalesHistory">Sales History</router-link></li>
                    <li class="subMenus"><router-link onclick="closeNav()" to="/TransactionHistory">Job Order History</router-link></li>
                </ul>
            </div>

        <li data-toggle="collapse" data-target="#Accounting" class="Menu" id="account"><b-icon icon="calculator" font-scale="2"></b-icon> Accounting</li>
            <div id="Accounting" class="collapse">
                <ul>   
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Journals</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Cash Flow</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Reports</router-link></li>
                </ul>
            </div>

        <li data-toggle="collapse" data-target="#WareHouse" class="Menu" id="WH"><b-icon icon="house-door" font-scale="2"></b-icon> WareHouse</li>
            <div id="WareHouse" class="collapse">
                <ul>   
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Receiving</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Placing/Put-Away</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Picking</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Added Value</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Dispatching</router-link></li>
                    <li class="notAvailable"><router-link onclick="closeNav()" to="/Upcoming">Returns</router-link></li>
                </ul>
            </div>

        <li data-toggle="collapse" class="Menu2" id="WHsetup"><router-link onclick="closeNav()" to="/Location"><b-icon icon="menu-button-wide" font-scale="2"></b-icon> WareHouse Setup</router-link></li>
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
        	<div class="col-md-4 footer-brand animated fadeInLeft">
            <!----------------- di binabasa ------------------------>
            <img src="../media/bs3.png" alt="logo" style="width:80%;">
            <!----------------- pero eto binabasa ---------------------
            <img src="../media/logo.png" alt="logo" style="width:40px;">--->
                <br>
         
                    <p id="bbb">Empowering enterprises to use technology innovations for growth and success,
                         offering products for businesses and operations, and deliver effective IT solutions
                        with quality service to enhance the competitive advantages.
                        </p>
                
                    <p>© 2020 BS, All rights reserved</p>
            </div>

        	<div class="col-md-3 footer-nav animated fadeInUp">
            	<h4>Company</h4>
                <br>
                <br>
            	<div class="col-md-6">
                    <ul class="pages">
                        <li><router-link to='/about'>About Us</router-link></li>
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
                	<li><a href="https://web.facebook.com/BarkSpider-108342387962280" target="_blank">BarkSpider Facebook</a></li>
                	<li><a href="https://mail.google.com" target="_blank">barkspidersoft@gmail.com</a></li>
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
<style scoped>
    .notAvailable{ /* empty link/components */
        text-decoration: line-through;
        background-color:grey;
        padding:5px;
        margin:3px;
        border-radius:5px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
        
    }
   
    .footer-bs{
        margin-top:500px;
    }
    .Menu{ /* menus */
        padding:15px;
        text-indent:10%;
        margin:10px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
       
    }
    .Menu2{ /* menus: PO & Warehouse Setup only*/
        padding:15px;
        margin:10px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
       
    }

    .subMenus{ /* submenus */
        padding:5px;
        margin:3px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
        color:#5bc0de;
       
    }
    .closeli{  /* close btn */
        text-align:right;
        margin-bottom:50px;
    }

    /* hover effects*/
    .Menu:hover{
        color:#5bc0de;
        cursor:pointer;
    }
    .Menu2:hover{
        color:#5bc0de;
        text-decoration:none;
        list-style:none;
    }
    /* active effects*/
    .Menu:active{
        color:#5bc0de;
       
        
    }
    .Menu2:active{
        color:#5bc0de;
        font-weight: 700;
       
    }
    #account,#WH,#WHsetup{
        text-decoration: line-through;
    }
    
</style>




