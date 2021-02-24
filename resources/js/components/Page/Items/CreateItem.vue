<template>
    <div>
    <div class="container">
      <h1> Create Item </h1>
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
      
      <label for="name" class="text-muted"><small>Item Code</small></label>
      <span class="alert-danger" v-if="errors && errors.Code">{{errors.Code[0]}}</span>
      <input   class="form-control" id="name" placeholder="Enter Code" v-model="ItemCode">
    </div>

    <div class="form-group">
      <label for="pwd" class="text-muted"><small>Item Name</small></label>
       <span class="alert-danger" v-if="errors && errors.Name">{{errors.Name[0]}}</span>
      <input v-model="Name" type="text" class="form-control" id="pwd" placeholder="Enter Name">
    </div>

    <div class="form-group">
      <label for="comment" class="text-muted"><small>Unit</small></label>
      <input v-model="Unit" type="text" class="form-control" id="pwd" placeholder="Enter Unit" name="Unit">
      <span class="alert-danger" v-if="errors.Unit">{{errors.Unit[0]}}</span>
    </div>

    <button type="button" class="btn btn-dark" @click.prevent="SaveVendor">Submit</button>
  </div>
</div>
</div>
</div>

</div>

</template>

<script>
import MenuList from '../Items/MainItem'
import Swal from 'sweetalert2'

export default {
    components: {
     MenuList
    },

    data() {
      return{
                Name:'',
                Unit:'',
                ItemCode:'',
                errors:[],
                success:false
    }},
    methods:{
         SaveVendor(){
           
          axios.post('/api/SaveItem',{Name:this.Name, Unit:this.Unit,Code:this.ItemCode})
          .then(
              ()=>{
                   
                  Swal.fire({
                  icon:'success',
                  title:this.Name + ' Added',
                  text:'As New Item',
                  timer:2000,
                  showCancelButton: false,
                  showConfirmButton: false
                
                }) 

                this.Name="";
                this.Unit="";
                this.ItemCode="";
                this.success=true;
                this.errors=[];
              }
          )
          .catch(error => {
            if (error.response.status=422){
            this.errors = error.response.data.errors;
            console.log(this.errors);

              Swal.fire({
              title: 'Error',
              icon: error.response.data.errors,
              showCancelButton: false,
              showConfirmButton: false 
            })
            
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