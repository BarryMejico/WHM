<template>
<div class="container">

    <h1>Company</h1>
    <br>
    <div class="row">
        <div class="col"></div>
        <div class="col-md-8">
            <b-card title="Details">
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
                CompanyName:'',
                CompanyAddress:'',
                CompanyOwner:'',
                
            }
        }
    },

    mounted(){
          axios.get('/api/user').then((res)=>{
            this.user=res.data;
            this.company.CompanyOwner=this.user['id'];
             axios.get('/api/getCompany',{params:{CoCode:this.user['CoCode']}})
            .then((res)=>{
                this.company=res.data[0];
            })
        })
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