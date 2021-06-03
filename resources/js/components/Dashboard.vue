<template>
    <div>
    <div class="container">
  
    <br>
    <br>
    
        <div class="row">
            <div class="col">
                <b-avatar size="150px"></b-avatar>
            </div>
            <div class="col-md-7">
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
                        <!-- <h6 class="text-muted">Company Name</h6> -->
                        <router-link class="temp" to="/company"><h6 class="text-muted">Company</h6></router-link>
                        <br>
                        <h6>{{company.CompanyName}}</h6>
                    </div>
                </div>
                <hr>

                    <!-- <i>additional features for employee modal</i> -->
                    <h6 class="text-muted">Search & Add Employee</h6>
                    <employee-modal/>
                    <!-- end company -->
                    <!-- list of employee -->
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center" 
                            v-for="(Employee, k) in employees" :key="k">
                            <b>{{Employee.Employee}}</b> :
                            <i>{{Employee.Position}}</i>
                            <span class="badge badge-primary badge-pill">{{Employee.id}}</span>
                        </li>
                    </ul>
            </div>
            <div class="col">
                 <companyInvite style="margin-top:-25px;"/>
            </div>
            
        </div>

        
    </div>

</div>
</template>
<script>
import EmployeeModal from './Modals/EmployeeModal.vue';
import companyInvite from './Page/companyInvite';

export default {
  components: { 
      EmployeeModal,
      companyInvite
  },
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
            employees:[],
        }
    },
    mounted(){
        axios.get('/api/user').then((res)=>{
            this.user=res.data;
            this.company.CompanyOwner=this.user['id'];

            axios.get('/api/getCompany',{params:{CoCode:this.user['CoCode']}})
            .then((res)=>{
                this.company.CompanyName=res.data[0]['CompanyName'];
                this.load_employee()
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

         load_employee(){
          axios.get('/api/LoadallEmployee')
          .then(
              (response)=>{
                  this.employees=response.data;
                  //this.pages=response.data;
              }
          )
          .catch()
      },
    },

      


}
</script>
<style scoped>
.temp{
    background-color:#eee ;
    width:20%;
    color:black;
}
</style>