<template>
    <div>
      
        <button id="cus" href="#addCustomerModal" data-toggle="modal" type="button" class="btn btn-outline-secondary" :disabled="disabled == 1">
          <b-icon icon="cursor"></b-icon> Select Customer</button>
        <!--modal Customer-->
<div id="addCustomerModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Search Customer</h4>
					<button type="button" id="closeCus" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group">		
                    <label>Item Code</label>	
                    <input type="text" v-on:input="liveSearch" v-model="Search">
          </div>
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" 
    v-for="(Customer, k) in List_Customer" :key="k">
    <a @click="Selected_cus(k)">{{Customer.Customer}}</a>
    <span class="badge badge-primary badge-pill">{{Customer.id}}</span>
  </li>
 
</ul>

<ul class="pagination justify-content-end">
    <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="prepAGE()">Previous</a></li>
    <!-- <ul class="pagination justify-content-end" v-for="(pages, page) in pages.last_page" :key=page>
    <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="changepAGE(pages)">{{pages}}</a></li>
    </ul> -->
    <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="nextpAGE()">Next</a></li>
</ul>

          </div>
				
				<div class="modal-footer">
           <a  href="#NewCustomer" data-toggle="modal" type="button" class="my_btn btn link tn-secondary">New Customer</a>
          <button  type="button" class="btn btn-light" data-dismiss="modal" aria-hidden="true">Select Customer</button>
				</div>
			
		</div>
	</div>
</div>
<!--modal Add-->
<div id="NewCustomer" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">New Customer</h4>
					<button type="button" id="closeCus2" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
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
   

          </div>			
				<div class="modal-footer">
           <button type="button" class="btn btn-dark" @click.prevent="SaveVendor">Submit</button>
				</div>
			
		</div>
	</div>
</div>
    </div>
    
</template>
<script>

function int_data(){
  return{
  
       //---for loading Ship to
       Ship:'',
       List_Customer:[],
       Customer:'',
       add_Cus:'',
       //Live Search
        Search:'',
        pages:'',

        //-----
         Name:'',
                CNumber:'',
                Address:'',
                errors:[],
                success:false
    }
    }
export default {

  props:{
    disabled: 0
  },

    data:function(){
      return int_data();
      }, 
mounted(){
this.load_customer();

},
methods:{

   SaveVendor(){
          axios.post('/api/SaveCus',{Name:this.Name,Number:this.CNumber,Address:this.Address,ids:null})
          .then(
              (res)=>{
                this.Name="";
                this.Address="";
                this.CNumber="";
                this.success=true;
                 this.closeModal();
              this.$emit("SelectedCustomer",res.data[0]);
              
                
              }
          )

          
          .catch(error => {
            
            this.errors = error.response.data.errors;
            
            })
          
            },

   //pagination

      changepAGE(page){
        axios.get('/api/LoadCus?page='+page)
        .then((res)=>{
          this.List_Customer=res.data.data;
          this.pages=res.data
          })
          .catch((errors)=>{
          })
      },

     prepAGE(){
        axios.get(this.pages.first_page_url)
        .then((res)=>{
          this.List_Customer=res.data.data;
          this.pages=res.data
          })
          .catch((errors)=>{
          })
      },

      nextpAGE(){
        axios.get(this.pages.next_page_url)
        .then((res)=>{
          this.List_Customer=res.data.data;
          this.pages=res.data
          })
          .catch((errors)=>{
          })
      },
//end pagination

  Selected_cus(index){
    console.log(this.List_Customer[index])
        this.$emit("SelectedCustomer",this.List_Customer[index]);
        this.closeModal();
    },

    closeModal() {
      document.getElementById('closeCus').click();
      document.getElementById('closeCus2').click();
              this.List_Customer=[];
             this.load_customer();
             
},

    load_customer(){
          axios.get('/api/LoadCus')
          .then(
              (response)=>{
                  this.List_Customer=response.data.data;
                  this.pages=response.data;
              }
          )
          .catch()
      },

      liveSearch(){
        axios.get('/api/LiveSearchCus',{params:{Search:this.Search}})
          .then(
              (response)=>{
                //console.log(response.data);
              this.List_Customer=response.data.data;
              this.pages=response.data;
              }
          )
          .catch()
      },
},

}
</script>
<style>
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