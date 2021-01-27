<template>
    <div>
            <div class="PO">
                <div class=""><router-link to="/PO">Purchase Order</router-link></div>
<div id="collapsibleNavbar2">
  <ul class="nav flex-column">
    <li class="nav-item">
      <router-link class="nav-link" to='/PO_list'>List</router-link>
    </li>

    <li class="nav-item">
      <keep-alive>
      <router-link class="nav-link" to='/PO_Create'>Create</router-link>
      </keep-alive>
    </li>

    <li class="nav-item">
      <keep-alive>
      <router-link class="nav-link" to='/Stocks'>Stocks</router-link>
      </keep-alive>
    </li>
    
  </ul></div>
            </div>
</div>

</template>

<script>

</script>
<style>

</style>