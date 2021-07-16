

<?php $__env->startSection('content'); ?> 
<div>
<nav class="navbar navbar-expand-md bg-dark navbar-dark navbar-fixed-top">
    <?php if(auth()->guard()->guest()): ?>
    <?php if(Route::has('register')): ?>
    <?php endif; ?>
<?php else: ?>
    <mySidemenu></mySidemenu>
<?php endif; ?>

<router-link class="nav-link" to='/Dashboard'>
<img src="media/logo.png" alt="logo" style="width:40px;">
  <label class="navbar-brand" id="appname"><?php echo e(config('app.name', 'Araneus')); ?></label>
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
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <!--<a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a> -->
                                <router-link class="nav-link" to='/login_'>Login</router-link>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <!--<a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a> -->
                                    <router-link class="nav-link" to='/register_'>Register</router-link>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="li" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
  </div>  
</nav>



</div>
<div>
<br>
        <router-view></router-view> 
<div>

<!----------- Footer ------------>

<footer class="footer-bs">
        <div class="row">
        	<div class="col footer-brand animated fadeInLeft">
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

        	<div class="col footer-nav animated fadeInUp">
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

        	<div class="col footer-social animated fadeInDown">
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
<?php $__env->stopSection(); ?>

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
    #appname:hover{
        cursor:pointer;
        color:#5bc0de;
    }
    
</style>





<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Abi\WHM\resources\views/welcome.blade.php ENDPATH**/ ?>