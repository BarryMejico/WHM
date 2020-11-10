<!--side bar-->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   
  <ul> 
    <li><a href="/home">Home</a></li>
	  <li><a href="/user1">Users</a></li>
    <li><a href="/SQL">SQL Sample</a></li>
    <li><a href="/Employee">Employee</a></li>
    <li><a href=#4>Option 4</a></li>
    <li><a href=#5>Option 5</a></li>
	  </ul>
</div>
<div class="col-xs-10 col-sm-10 col-lg-10">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
</div>
<!--side bar End-->
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


