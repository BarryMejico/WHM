<template>
<div>
  <div class="PO">
  <!-- <div class=""><router-link to="/PO">Purchase Order</router-link></div> -->
            <a>
              <keep-alive>
                <router-link class="nav-link" to='/PO_Create'><span class="btn btn-outline-secondary btn-lg"><b-icon icon="pencil-square" font-scale="1"></b-icon> <b>Create</b></span></router-link>
              </keep-alive>
            </a>
            <a>
               <router-link class="nav-link" to='/PO_list'><span class="btn btn-outline-secondary btn-lg"> <b-icon icon="list-ol" font-scale="1"></b-icon> <b>List</b></span></router-link>
            </a>
            <a>
               <keep-alive>
                <router-link class="nav-link" to='/Stocks'><span class="btn btn-outline-secondary btn-lg"> <b-icon icon="bar-chart-line" font-scale="1"></b-icon> <b>Stocks</b></span></router-link>
              </keep-alive>
            </a>

       
              
                <!-- <router-link class="nav-link" to='/PO_Create'><btn class="btn btn-secondary"> Create</btn></router-link>
           
        
               <router-link class="nav-link" to='/PO_list'><btn class="btn btn-secondary"> List</btn></router-link>
          
               
                <router-link class="nav-link" to='/Stocks'><btn class="btn btn-secondary"> Stocks</btn></router-link>
              -->
       
  </div>
</div>

</template>

<style scoped>
/* .nav-link{
  background-color: #3c415c;
  color: white;
  padding:0;
  border-radius: 100px;
  border: none;
  cursor: pointer;
  width:100%;


} */
a{
  display: inline-block;
  padding:5px;
  font-weight: 500;
}


/* .btn{
  width:100%;
}  */



</style>