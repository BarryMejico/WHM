<template>
    <div>
    <div class="container">
      <h1> Create Customer </h1>
      <hr>
      <br>
      <br>
    <div class="row">
        <div class="col-lg-2">
        <MenuList></MenuList>
        </div>
<div class="col-lg-6">
<div>
  

  
    <div class="form-group">
      <div class="alert alert-success" v-show="success">
          The data has been saved!!
      </div>
      <label for="name" class="text-muted"><small>Name</small></label>
      <span class="alert-danger" v-if="errors && errors.Name">{{errors.Name[0]}}</span>
      <input   class="form-control" id="name" placeholder="Enter name" v-model="Name">
    </div>

    <div class="form-group">
      <label for="pwd" class="text-muted"><small>Contact Number</small></label>
       <span class="alert-danger" v-if="errors && errors.Number">{{errors.Number[0]}}</span>
      <input v-model="CNumber" type="text" class="form-control" id="pwd" placeholder="Enter Number" name="pswd">
    </div>
  
    <div class="form-group">
      <label for="comment" class="text-muted"><small>Address</small></label>
      <textarea v-model="Address" class="form-control" rows="5" id="comment" name="text" placeholder="Enter Address"></textarea>
       <span class="alert-danger" v-if="errors.Address">{{errors.Address[0]}}</span>
    </div>
    <button type="button" class="btn btn-dark" @click.prevent="SaveVendor">Submit</button>
  </div>
</div>
</div>
</div>


</div>

</template>

<script>
import MenuList from '../Customer/MainCus'
import Swal from 'sweetalert2'

export default {
    components: {
     MenuList
    },

    data() {
      return{
                Name:'',
                CNumber:'',
                Address:'',
                errors:[],
                success:false
    }},
    methods:{
         SaveVendor(){
          axios.post('/api/SaveCus',{Name:this.Name,Number:this.CNumber,Address:this.Address,ids:null})
          .then(
              ()=>{

              Swal.fire({
                icon:'success',
                title:this.Name + ' added',
                text:'As New Customer',
                timer:2000,
                showCancelButton: false,
                showConfirmButton: false
                }) 

                this.Name="";
                this.Address="";
                this.CNumber="";
                this.success=true;
                
              }
          )
          .catch(error => {
            if (error.response.status=422){
            this.errors = error.response.data.errors;
            console.log(this.errors);
            }
            
            })
          
            }
         
    }
      
}
</script>
<style>
.total{
  float:right;
}
.PO{
  color:gray;
  max-height: 600px;
}

.table{
  width: 100% !important;
}

.qty{
width:50px;
overflow: hidden;
padding:0;
margin: 0%;

}

.qty>input{
width: 100%;
text-align: center;
}
/* Modal styles */
/* this is class for dialog itself*/
.modal {
   
   z-index: 9999
}
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
</style>