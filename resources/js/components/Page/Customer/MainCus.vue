<template>
<div>
  <!-- <div class="PO">     
    <div id="collapsibleNavbar2">
        <div class="nav-link"><router-link to="/Customer_Create"><button class="menuList">Create</button></router-link></div>
        <ul class="nav flex-column">
          <li class="nav-item">
            <router-link class="nav-link" to='/Customer_List'><button class="menuList">List</button></router-link>
          </li>
        </ul>
    </div>
  </div> -->
    <a>
      <keep-alive>
        <router-link to="/Customer_Create"><span class="btn btn-outline-secondary btn-lg"><b-icon icon="pencil-square" font-scale="1"></b-icon> <b>Create</b></span></router-link>
      </keep-alive>
    </a>
    <a>
        <router-link to='/Customer_List'><span class="btn btn-outline-secondary btn-lg"> <b-icon icon="list-ol" font-scale="1"></b-icon> <b>List</b></span></router-link>
    </a>

</div>
</template>

<script>

</script>
<style scoped>
/* .menuList{
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  border-radius: 3px;
  border: none;
  cursor: pointer;
  width: 100%;
} */
a{
  display: inline-block;
  padding:5px;
  font-weight: 500;
}
.btn{
  border-radius:50px;
} 


</style>