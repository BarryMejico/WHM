<template>
<div class="container">
    <b-card  title="Afiliated company" align="center">
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>Row</th>
            <th>Company Name</th>
            <th>Address</th>
            <th>Owner</th>
            <th>selected</th>
        </tr>
    </thead>
    <tbody>
        
        <tr v-for="(company,k) in companies" :key="k">
            <th>{{k}}</th>
            <td>{{company.CompanyName}}</td>
            <td><Address>{{company.CompanyAddress}}</Address></td>
            <td>{{company.name}}</td>
            <td><button @click="changeCompany(k)">login</button></td>
        </tr>
    </tbody>
</table>                
            
    </b-card>
</div>
</template>

<script>

export default {
    data(){
        return{
         companies:[],
         notifcount:0,
        }
    },

    mounted(){
        axios
        .get('api/affilatedCompanies')
        .then((res)=>{
            this.companies=res.data;
        })

    },

    methods:{
        changeCompany(i){
            axios
            .post('api/changePerma',{params:{permCode:this.companies[i]['permCode'],CoCode:this.companies[i]['CoCode']}})
            .then(()=>{
                alert("Done");
            })

        },
    }
 
}
</script>

<style scoped>


</style>