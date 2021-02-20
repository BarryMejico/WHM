<template>
    <div>
      
        <button id="cus" href="#addCustomerModal" data-toggle="modal" type="button" class="btn btn-secondary btn-sm" :disabled="disabled == 1">Customer</button>
        <!--modal Customer-->
<div id="addCustomerModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Add Customer</h4>
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
  <a class="link">New Customer</a>
</ul>

          </div>
				
				<div class="modal-footer">
          <button  type="button" class="btn btn-light" data-dismiss="modal" aria-hidden="true">Select Vendor</button>
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

  Selected_cus(index){
        this.$emit("SelectedCustomer",this.List_Customer[index]);
        this.closeModal();
    },

    closeModal() {
      document.getElementById('closeCus').click();
              this.List_Customer=[];
             
             this.load_customer();
             
},

    load_customer(){
          axios.get('/api/LoadCus')
          .then(
              (response)=>{
                  this.List_Customer=response.data;
              }
          )
          .catch()
      },

      liveSearch(){
        axios.get('/api/LiveSearchCus',{params:{Search:this.Search}})
          .then(
              (response)=>{
                //console.log(response.data);
              this.List_Customer=response.data;
              console.log(this.disabled);
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
#cus{
 width:290px;
}
</style>