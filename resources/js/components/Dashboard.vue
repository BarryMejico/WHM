<template>
    <div>
    <div class="container">
        <h6>temporay buttons for quick navigation during development</h6>
        <router-link class="temp" to="/Dashboard" tag="button">dashboard</router-link>
        <br><br>
        <router-link class="temp" to="/company" tag="button">company</router-link>
        <br><br>
        <router-link class="temp" to="/companyInvite" tag="button">company Invite</router-link>
   


    <hr>
    <br>
    <br>
    
        <div class="row">
            <div class="col-md-4" align="center">
                <b-avatar size="200px"></b-avatar>
            </div>
            <div class="col" >
                <div class="row">
                    <div class="col">
                        <h6 class="text-muted">Username</h6>
                        <br>
                        <h6>{{user.name}}</h6>
                    </div>
                    <div class="col">
                        <h6 class="text-muted">Email</h6>
                        <br>
                        <h6>{{user.email}}</h6>
                    </div>
                    <div class="col">
                        <h6 class="text-muted">Company Name</h6>
                        <br>
                        <h6>{{company.CompanyName}}</h6>
                    </div>
                </div>
                <hr>

                    <!-- <i>additional features for employee modal</i> -->
                    <h6 class="text-muted">Search & Add Employee</h6>
                    <employee-modal/>
                    <!-- end company -->
                   

                
            </div>
            
        </div>

        
    </div>

</div>
</template>
<script>
import EmployeeModal from './Modals/EmployeeModal.vue';
export default {
  components: { EmployeeModal },
    data(){
        return{
            user:[],
            // for company
            company:{
                CompanyName:'',
                CompanyAddress:'',
                CompanyOwner:'',
                
            },
            // end company
        }
    },
    mounted(){
        axios.get('/api/user').then((res)=>{
            this.user=res.data;
            this.company.CompanyOwner=this.user['id'];

            axios.get('/api/getCompany',{params:{CoCode:this.user['CoCode']}})
            .then((res)=>{
                this.company.CompanyName=res.data[0]['CompanyName'];
            })
        })
    },

    methods:{
        // for company
        SaveCompany(){
            axios.post('/api/SaveCompany',this.company)
            .then(
                this.company=[]
            )
            .catch()
        },
        // end company
    }
}
</script>
<style scoped>
.temp{
    background-color:#eee ;
    width:20%;
    color:black;
}
</style>