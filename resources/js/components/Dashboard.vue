<template>
    <div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Starting up</div>

                <div class="card-body">
                    
                  <b>User Name:</b><i>{{user.name}}</i><br>
                  <b>Email:</b><i>{{user.email}}</i><br>
                  <b>Company Name:</b><i>{{user.CoCode}}</i><br>
                  <hr>
                  <!-- company -->
                  <i>new component that can create company</i>
                  <h1>Company</h1>
                  <h4>Create</h4>
                  <input type="text" v-model="company.CompanyName" placeholder="Company Name"/>
                  <input type="text"  v-model="company.CompanyAddress" placeholder="Address"/>
                  <button @click="SaveCompany()">Save</button><br>
                  <i>new component or modal for notification of invite to join company</i>
                  <h4>Company Invite</h4>
                  <i>Name</i> Invites you to join <i>Company Name</i>.<br>
                  <button>Accept</button>
                  <button class="alert">Decline</button>
                  <hr>
                  <i>additional features for employee modal</i>
                  <h1>Employee</h1>
                  <employee-modal/>
                  <!-- end company -->
                </div>
            </div>
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
                CompanyName:'camp1',
                CompanyAddress:'add camp 1',
                CompanyOwner:'',
                
            },
            // end company
        }
    },
    mounted(){
        axios.get('/api/user').then((res)=>{
            this.user=res.data;
            this.company.CompanyOwner=this.user['id'];
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