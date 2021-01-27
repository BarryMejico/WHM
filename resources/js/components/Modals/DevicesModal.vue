<template>
    <div>
        <button href="#addDevice" data-toggle="modal" type="button" class="btn btn-secondary btn-sm" @click="load_customer" >Device</button>
        <!--modal Customer-->
<div id="addDevice" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Add Device</h4>
					<button type="button" id="closeCus2" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group">		
                    <label>Device Code</label>	
                    <input type="text" id='Vcode' v-model="Customer">
          </div>

<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
    <span class="caret">{{status}}</span></button>
<ul class="dropdown-menu">
  <li class="list-group-item d-flex justify-content-between align-items-center" 
    v-for="(Device, k) in List_Customer" :key="k">
    <a @click="Selected_cus(k)">{{Device.DeciveName}}</a>
    <span class="badge badge-primary badge-pill">{{Device.Model}}</span>
  </li>
</ul> 
</div>



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
  status:'',
       //---for loading Ship to
       Ship:'',
       List_Customer:[],
       Customer:'',
       add_Cus:'',
       Cus:[{
                Code:'',
                Name:'',
                Unit:'',
                
       }],

    }
    }
export default {
    props:['selectedCus'],

    data:function(){
      return int_data();
      }, 
mounted(){
this.load_customer();
},
methods:{

  Selected_cus(index){
      //console.log(this.List_Customer[index]['Ccode']);
      
                this.Cus=[];
                this.Cus.Code=this.List_Customer[index]['Code'];
                this.Cus.Name=this.List_Customer[index]['DeciveName']  + "--" + this.Customer;
                this.Cus.Unit= this.List_Customer[index]['Model'];
        this.closeModal();
        this.$emit("SelectedDevice",this.Cus);
        
    },

    closeModal() {
      document.getElementById('closeCus2').click();
              this.List_Customer=[];
              this.load_customer();
},

    load_customer(){
        //this.cus=""
        console.log(this.selectedCus);
          axios.get('/api/getDevices',{params:{ccode:this.selectedCus}})
          .then(
              (response)=>{
                  this.List_Customer=response.data;
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