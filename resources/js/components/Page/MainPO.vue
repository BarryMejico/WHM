<template>
<div>
  <div class="PO">
  <!-- <div class=""><router-link to="/PO">Purchase Order</router-link></div> -->
  <div id="collapsibleNavbar2">
      <ul class="nav flex-column">

        <li class="nav-item">
          <keep-alive>
          <router-link class="nav-link" to='/PO_Create'><button class="menuList">Create</button></router-link>
          </keep-alive>
        </li>

        <li class="nav-item">
          <router-link class="nav-link" to='/PO_list'><button class="menuList">List</button></router-link>
        </li>

        <li class="nav-item">
          <keep-alive>
          <router-link class="nav-link" to='/Stocks'><button class="menuList">Stocks</button></router-link>
          </keep-alive>
        </li>
        
        </ul>
    </div>
  </div>
</div>

</template>

<script>

</script>
<style scoped>
.menuList{
  /* background-color: #4CAF50; */
  background-color: #5bc0de;
  color: white;
  padding: 10px;
  border-radius: 3px;
  border: none;
  cursor: pointer;
  width: 100%;
}



</style>