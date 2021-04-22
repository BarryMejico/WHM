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
         }
        }
    },

    mounted(){
          this.getdata()
    },


    methods:{

        getdata(){
            axios.get('/api/user').then((res)=>{
            this.user=res.data;
            this.company.CompanyOwner=this.user['id'];
             axios.get('/api/getCompany',{params:{CoCode:this.user['CoCode']}})
            .then((res)=>{
                this.company.CompanyName=res.data[0]['CompanyName'];
                this.company.CompanyAddress=res.data[0]['CompanyAddress'];
            })
            .catch((res)=>{})
        })
        },

         SaveCompany(){
             console.log(this.company)
            axios.post('/api/SaveCompany',this.company)
            .then(
               
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