<template>
    <div>
            <div class="PO">
                <!-- <div class="nav-link"><router-link to="/PO"><button class="menuList">Item</button></router-link></div> -->
<div id="collapsibleNavbar2">
  <ul class="nav flex-column">
      <li class="nav-item">
      <router-link class="nav-link" to='/Items_Create'><button class="menuList">Create</button></router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" to='/Items_List'><button class="menuList">List</button></router-link>
    </li>
    
  </ul></div>
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