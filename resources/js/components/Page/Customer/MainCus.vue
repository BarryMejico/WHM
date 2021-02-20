<template>
    <div>
            <div class="PO">
                
<div id="collapsibleNavbar2">
   <div class="nav-link"><router-link to="/Customer_Create"><button class="menuList">Create</button></router-link></div>
  <ul class="nav flex-column">
    <li class="nav-item">
      <router-link class="nav-link" to='/Customer_List'><button class="menuList">List</button></router-link>
    </li>
    <!-- <li class="nav-item">
      <router-link class="nav-link" to='/Customer_Create'>Create</router-link>
    </li> -->
    
  </ul>
  <!-- <hr>
   <div class=""><router-link to="/Customer_Create">Device</router-link></div>
  <ul class="nav flex-column">
    <li class="nav-item">
      <router-link class="nav-link" to='/Customer_List'></router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" to='/Customer_Create'>Create</router-link>
    </li>
  </ul> -->
  </div>
            </div>
</div>

</template>

<script>

</script>
<style scoped>
.menuList{
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  border-radius: 3px;
  border: none;
  cursor: pointer;
  width: 100%;
}

</style>