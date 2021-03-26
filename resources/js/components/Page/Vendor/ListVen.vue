<template>
  <div>
    <div class="container">
       <div class="row" >
        <div class="col-md-12">
          <div class="jumbotron" style="background-color:white; ">
            <h1 class="display-4 text-muted">Vendor: <b>List</b></h1>
            <MenuList></MenuList>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-10">
            <span class="alert alert-success" v-show="success"> The data has been saved!!</span>	
            <div class="row">
              <table class="table table-responsive">
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
                    <td>{{po_item.Vendor}}</td>
                    <td>{{po_item.Number}}</td>
                    <td>{{po_item.Address}}</td>
                    <td>
                      <button href="#addVendorModal"  data-toggle="modal" type="button" class="btn btn-primary btn-sm" 
                        @click="SelectItem(po_item.Vendor,po_item.Number,po_item.Address,po_item.Vcode)">Modify
                      </button>
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
            </div>
          </div>
          
        </div>
    </div>
<!--modal Mod/Del-->
    <div id="addVendorModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">						
              <h4 class="modal-title">Vendor</h4>
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
import MenuList from '../Vendor/MainVen'
import Swal from 'sweetalert2'

export default {
    components: {
     MenuList
    },


    data() {
      return{
             POs:[],
             Name:'',
             Cnum:'',
             Add:'',
             id:'',
             success:false
    }},
    mounted(){
        this.loadpos();
    },

    methods:{
      //pagination
      changepAGE(page){
        axios.get('/api/LoadVen2?page='+page)
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

      loadpos:function(){
          axios.get('/api/LoadVen2')
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
          axios.post('/api/updateVendor',{Name:this.Name,Number:this.Cnum,Address:this.Add,ids:this.id})
          .then(
              ()=>{
                this.Name="";
                this.Add="";
                this.CNum="";
                this.errors =[];
                this.success=true;
                this.loadpos();
                this.closeModal();
              }
          )
          .catch(error => {
            if (error.response.status=422){
            this.errors = error.response.data.errors;
            //console.log(this.errors);
             Swal.fire({
                title: 'Oops!',
                text: this.errors,
                icon: 'danger',
                showCancelButton: false,
                showConfirmButton: true
              })
            }
            
            })
          
            },

            Delete(){

               this.closeModal();
               Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure to remove ' + this.Name + ' as a Vendor?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
              }).then((result) => {
                if (result.value) {

                  axios.post('/api/DeleteVendor',{Vcode:this.id})
                    .then(
                      ()=>{    
                      this.loadpos();

                     Swal.fire({
                      title: 'Vendor Removed',
                      icon: 'success',
                      timer:1500,
                      showCancelButton: false,
                      showConfirmButton: false 
            })

                      }
                    )
                    .catch();

          }else if (result.dismiss === Swal.DismissReason.cancel) {
          console.log('Vendor Stays');//inshort do nothing
          }
        })

            },

            closeModal() {
             document.getElementById('close').click();
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



</style>