<template>
    <div>
        <button href="#addDevice" data-toggle="modal" type="button" class="btn btn-outline-secondary" @click="load_customer" :disabled="disabled == 1">
          <b-icon icon="phone"></b-icon> Device</button>
        <!--modal Customer-->
<div id="addDevice" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Add Device</h4>
					<button type="button" id="closedevice" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top:10px;">&times;</button>
				</div>

				<div class="modal-body">	
          <div class="form-group">		
            <label>Device Code</label>	
            <input type="text" id='Vcode' v-model="Customer">
          </div>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center" 
                v-for="(Device, k) in List_Customer" :key="k">
                <a @click="Selected_cus(k)">{{Device.DeciveName}}</a>
                <span class="badge badge-primary badge-pill">{{Device.Model}}</span>
              </li>
            </ul>
        </div>
        <br>
        <br>

        <div class="modal-footer">
          <a href="#addDeviceModal" type="button" data-toggle="modal" id="addDeviceLink" class="my_btn btn link tn-secondary">Add Device</a>
        </div>
				
				<!-- <div class="modal-footer">
          <button  type="button" class="btn btn-light" data-dismiss="modal" aria-hidden="true">Select Vendor</button>
				</div> -->
			
		</div>
	</div>
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

    </div>
    
</template>
<script>

import Swal from 'sweetalert2'



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

       //--------
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
                

    }
    }
export default {
    props:{
    selectedCus:String,
    disabled: 0,
    
    },

    data:function(){
      return int_data();
      }, 
mounted(){
this.load_customer();
},
methods:{

        SaveCusDevice(){
        var c=this.DeviceForm.Code.substr(0,2);
        if(c=="cp"){

        }
        else{
          this.DeviceForm.Code= "cp" + this.DeviceForm.Code;
        }

        try{
           axios.post('/api/SaveCusDevice',this.DeviceForm)
        .then(
         (res)=>{
          
           this.closeModal();
           //this.DeviceForm.splice(0, 1);
            this.Cus=[];
            this.Cus.Code=res.data[0]['Code'];
            this.Cus.Name=res.data[0]['DeciveName'];
            this.Cus.Unit=res.data[0]['Model'];
          this.$emit("SelectedDevice",this.Cus);
           

         } 
        )
        .catch(()=>{
          this.closeModal();
          Swal.fire({
                icon:'warning',
                title:'Oops!',
                text:'The device code had been used already, please provide a different code',
                showCancelButton: false,
                showConfirmButton: true
                }) 
        })
        }
        finally{
          
        }
      },

  Selected_cus(index){
      //console.log(this.List_Customer[index]['Ccode']);
      
                this.Cus=[];
                this.Cus.Code=this.List_Customer[index]['Code'];
                this.Cus.Name=this.List_Customer[index]['DeciveName'];
                this.Cus.Unit= this.List_Customer[index]['Model'];
        this.closeModal();
        this.$emit("SelectedDevice",this.Cus);
        
    },

    closeModal() {
      document.getElementById('closedevice').click();
      document.getElementById('close2').click();
              this.List_Customer=[];
              this.load_customer();
              
},

    load_customer(){
          this.DeviceForm.Ccode=this.selectedCus;
          axios.get('/api/getDevices',{params:{ccode:this.selectedCus}})
          .then(
              (response)=>{
                  this.List_Customer=response.data;
              }
          )
          .catch()
          this.DeviceForm.Ccode=this.selectedCus;
      },

      
},

}
</script>
<style scoped>
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
ul li:hover{
  background-color: #eee;
  cursor: pointer;
}
#addDeviceLink{
  text-align:right;
}
#addDeviceLink:hover{
  cursor: pointer;
  color:#5bc0de;
}
.close{
  text-align: right;
}
</style>