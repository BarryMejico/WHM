<template>
<div>
    <div class="container">

    <div class="row" >
      <div class="col-md-12">
            <div class="jumbotron" style="background-color:white; ">
              <h1 class="text-muted">Customer: <b-icon icon="list-ol" font-scale="1"></b-icon> <b>List</b></h1>
              <MenuList></MenuList>
            </div>
      </div>
    </div>


     <b-row>
          <b-col></b-col>
          <b-col cols="2">
            <toExcel :array1 = this.POs.data></toExcel>
          </b-col>
      </b-row>
        <br>
     
    <b-row>
        <b-col>
          <span class="alert alert-success" v-show="success">The data has been saved!!</span>	
          <b-row>
            <table class="table" style="width:100%;">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Contact Number</th>
                  <th scope="col">Address</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(po_item, k) in POs.data" :key="k">       
                  <th scope="row">{{k}}</th>
                  <td>{{po_item.Customer}}</td>
                  <td>{{po_item.Number}}</td>
                  <td>{{po_item.Address}}</td>
                  <td><button href="#addVendorModal"  data-toggle="modal" id="mod" class="btn btn-primary btn-sm" 
                  @click="SelectItem(po_item.Customer,po_item.Number,po_item.Address,po_item.Ccode)"><small>Modify</small></button>
                  
                  <button href="#addDeviceModal"  data-toggle="modal" id="dev" class="btn btn-primary btn-sm" 
                  @click="ccode(po_item.Ccode)"><small>Devices</small></button>
                  </td>
                </tr>
              </tbody>
            </table>

            <!--pagination vue-->
              <ul class="pagination justify-content-end">
                  <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="prepAGE()">Previous</a></li>
                  <ul class="pagination justify-content-end" v-for="(pages, page) in POs.last_page" :key=page>
                  <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="changepAGE(pages)">{{pages}}</a></li>
                  </ul>
                  <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="nextpAGE()">Next</a></li>
              </ul>
              <!--end pagination vue-->
          </b-row>
      </b-col>
    </b-row>
</div>
        <!--modal Mod/Del-->
        <div id="addDeviceModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">						
                  <h4 class="modal-title">Devices</h4>
                  <button type="button" id="close2" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">	
                    <div class="form-group">	
                      <input type="text" v-model="DeviceForm.Code" placeholder="Code">
                      <input type="text" v-model="DeviceForm.DeciveName" placeholder="Device Name">
                      <input type="text" v-model="DeviceForm.Model" placeholder="Model">	
                      <ul class="list-group">
                        <hr>
                        List of Devices
                        <li class="list-group-item d-flex justify-content-between align-items-center" 
                          v-for="(Device, k) in DevList" :key="k">
                          <a @click="Selected_cus(k)">{{Device.DeciveName}}</a>
                          <span class="badge badge-primary badge-pill">{{Device.Model}}</span>
                        </li>
                      </ul> 
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" @click.prevent="SaveCusDevice">Save</button>
                  <button  type="button" class="btn btn-light" @click.prevent="Delete">Delete</button>
                </div>
            </div>
          </div>
        </div>
        <!--modal Mod/Del-->
        <div id="addVendorModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">						
                  <h4 class="modal-title">Customer</h4>
                  <button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">	
                  <div class="form-group">		
                    <label>Name</label>		
                    <input type="text" id='name' @keyup.enter="addNewRow('code','po')" v-model="Name">
                    <label>Number</label>		
                    <input type="text" id='number' v-model="Cnum">
                    <label>Address</label>		
                    <textarea v-model="Add" class="form-control" rows="5" id="comment" name="text"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" @click.prevent="SaveVendor">Save</button>
                  <button  type="button" class="btn btn-light" @click.prevent="Delete">Delete</button>
                </div>
            </div>
          </div>
        </div>

</div>
</template>

<script>
import MenuList from '../Customer/MainCus'
import Swal from 'sweetalert2'

import toExcel from '../../component/toExcel.vue';

export default {
    components: {
     MenuList,
     toExcel
    },


    data() {
      return{
             POs:[],
             Name:'',
             Cnum:'',
             Add:'',
             id:'',
             success:false,
             //for Devices
             DeviceForm:{
               Code:'',
               DeciveName:'',
               Model:'',
               Ccode:'',
               
             },
             //list oh cus list
               DevList:[],
    }},
    mounted(){
        this.loadpos();
    },

    methods:{
       //pagination
      changepAGE(page){
        axios.get('/api/LoadCus2?page='+page)
        .then((res)=>{
          this.POs=res.data;
          })
          .catch((errors)=>{
          })
      },
     prepAGE(){
        axios.get(this.POs.first_page_url)
        .then((res)=>{
          this.POs=res.data;
          })
          .catch((errors)=>{
          })
      },
      nextpAGE(){
        axios.get(this.POs.next_page_url)
        .then((res)=>{
          this.POs=res.data;
          })
          .catch((errors)=>{
          })
      },
//end pagination
closeModal() {
      document.getElementById('closeCus').click();
              this.List_Customer=[];
             
             this.load_customer();
},


      ccode(ccode){
        this.DevList=[];
        this.DeviceForm.Ccode=ccode;

        axios.get('/api/getDevices',{params:{ccode:ccode}})
        .then(
          (response)=>{
           this.DevList=response.data;
           console.log(this.DevList);
          }
        )
      },

      SaveCusDevice(){
        var c=this.DeviceForm.Code.substr(0,2);
        if(c=="cp"){

        }
        else{
          this.DeviceForm.Code= "cp" + this.DeviceForm.Code;
        }
        
        axios.post('/api/SaveCusDevice',this.DeviceForm)
        .then(
         ()=>{
           this.closeModal();

            Swal.fire({
                  title: this.DeviceForm.DeciveName + ' is Added as Device',
                  icon: 'success',
                  timer:1500,
                  showCancelButton: false,
                  showConfirmButton: false 
                }) 

           console.log(this.DeviceForm);
            //this.DeviceForm.splice(0, 1)
            this.DeviceForm.Code = "";
            this.DeviceForm.DeciveName = "";
            this.DeviceForm.Model = "";

         }).catch((error)=>{
                
                Swal.fire({
                title: 'Oops!',
                text: error.response.data,
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton:true
            
              })

            })
      },

      loadpos:function(){
        
          axios.get('/api/LoadCus2')
          .then(
              (response)=>{
                  this.POs=response.data;
              }
          )
          .catch()},

      SelectItem(n,n2,n3,id){
            this.Name=n;
            this.Cnum=n2;
            this.Add=n3;
            this.id=id;
            
          },

          SaveVendor(){
          axios.post('/api/updateCus',{Name:this.Name,Number:this.Cnum,Address:this.Add,ids:this.id})
          .then(
              ()=>{
                this.Name="";
                this.Add="";
                this.CNum="";
                this.success=true;
                this.closeModal();
                this.loadpos();
                
              }
          )
          .catch(error => {
            if (error.response.status=422){
            this.errors = error.response.data.errors;
            console.log(this.errors);
             Swal.fire({
                title: 'Oops!',
                text: this.errors,
                icon: 'danger',
                showCancelButton: false,
                showConfirmButton: true,
              
              })
            
            }
            
            })
          
            },
            
            Delete(){
          this.closeModal();
             Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure to remove ' + this.Name + ' as a Customer?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
              }).then((result) => {
                if (result.value) {
                
              axios.post('/api/DeleteCustomer',{Ccode:this.id})
              .then(
                ()=>{this.loadpos();
                this.closeModal();

              Swal.fire({
              title: 'Customer Removed Successfully',
              icon: 'success',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
              })
              }).catch((error)=>{
                var error2;
                error2=error.response.data;

                Swal.fire({
                title: 'Oops!',
                text: error2.errors.Ccode,
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton:true
            
              })

            })
          }else if (result.dismiss === Swal.DismissReason.cancel) {
          console.log('Customer Info Stays');//inshort do nothing
          }
        })
            },

            closeModal() {
             document.getElementById('close').click();
             document.getElementById('close2').click();
},
       
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
#mod,#dev{
  margin:3px;
}
</style>