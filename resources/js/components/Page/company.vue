<template>
<div class="container">
   

     <h6>temporay buttons for quick navigation during development</h6>
        <router-link class="temp" to="/Dashboard" tag="button">dashboard</router-link>
        <br><br>
        <router-link class="temp" to="/company" tag="button">company</router-link>
        <br><br>
        <router-link class="temp" to="/companyInvite" tag="button">company Invite</router-link>
<hr>
    <!-- <i>new component that can create company</i> -->
    <h1>Company</h1>
    <br>
    <div class="row">
        <div class="col"></div>
        <div class="col-md-8">
            <b-card title="Create">
                <b-card-body>
                <input type="text" v-model="company.CompanyName" placeholder="Company Name"/>
                <input type="text"  v-model="company.CompanyAddress" placeholder="Address"/>
                <br>
                <br>
                <button @click="SaveCompany()">Save</button>
                </b-card-body>
            </b-card>
        </div>
        <div class="col"></div>
    </div>
   

</div>
</template>

<script>

export default {
    data(){
        return{
         company:{
                CompanyName:'camp1',
                CompanyAddress:'add camp 1',
                CompanyOwner:'',
                
            }
        }
    },

    methods:{
         SaveCompany(){
            axios.post('/api/SaveCompany',this.company)
            .then(
                this.company=[]
            )
            .catch()
        },
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