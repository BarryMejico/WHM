<template>
<div class="container">
    <!-- <i>new component or modal for notification of invite to join company</i> -->
                  <!-- <h4>Company Invite</h4>
                  <i>Name</i> Invites you to join <i>Company Name</i>.<br>
                  <button>Accept</button>
                  <button class="alert">Decline</button>
                  <hr> -->
             <h6>temporay buttons for quick navigation during development</h6>
        <router-link class="temp" to="/Dashboard" tag="button">dashboard</router-link>
        <br><br>
        <router-link class="temp" to="/company" tag="button">company</router-link>
        <br><br>
        <router-link class="temp" to="/companyInvite" tag="button">company Invite</router-link>
 
    <hr>
    <div class="row">
        <!-- <div class="col"></div> -->
        <div class="col-md-12" align='center'>
            <b-card title="Company Invite" style="width:30%;">
                <b-card-header style="background-color:white;">
                    <i>Name</i> Invites you to join <i>Company Name</i>.<br>
                </b-card-header>
                <b-card-body>
                    <button style="margin-bottom:10px;">Accept</button>
                    <button class="alert">Decline</button>
                </b-card-body>
            </b-card>
        </div>
        <!-- <div class="col"></div> -->
    </div>
   

</div>
</template>

<script>

export default {
    data(){
        return{
         
        }
    },

    methods:{
         
    }
 
}
</script>

<style scoped>
.temp{
    background-color:#eee ;
    width:20%;
    border-radius: 5px;
    color:black;
}


</style>