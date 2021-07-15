<template>
<div>
     <a>
      <keep-alive>
        <router-link class="nav-link" to='/JobOrder'><span class="btn btn-outline-secondary btn-lg"><b-icon icon="pencil-square" font-scale="1"></b-icon> <b>Create</b></span></router-link>
      </keep-alive>
    </a>
    <a>
        <router-link class="nav-link" to='/TransactionHistory'><span class="btn btn-outline-secondary btn-lg"> <b-icon icon="clock-history" font-scale="1"></b-icon> <b>Transaction History</b></span></router-link>
    </a>

</div>
</template>

<script>

</script>
<style scoped>
a{
  display: inline-block;
  padding:5px;
  font-weight: 500;
}
.btn{
  border-radius:50px;
} 


</style>