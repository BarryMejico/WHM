<template>
  <div>
    <div class="container">
     
    <div class="row" >
      <div class="col-md-12">
            <div class="jumbotron" style="background-color:white; ">
              <h1 class="text-muted"> Job Order: <b-icon icon="pencil-square" font-scale="1"></b-icon> <b>Create</b></h1>
              <MenuList></MenuList>
            </div>
      </div>
    </div>


     
       <div class="row" style="margin-bottom:50px;">
          <div class="col-md-6">
          
             <CustomerModal id="CusModal" @SelectedCustomer="Selected_cus" :disabled="disabled"></CustomerModal>
             <br>
              <small class="text-muted">Name</small>
              <input class="form-control input-lg" type="text" :value="Customer" required autofocus disabled>
            
              <small class="text-muted">Contact Number</small>
            <input class="form-control input-lg" v-model="Num" type="text" required disabled> 
          </div>
           <div class="col-md-6"> 
             <br>
             <br>
             

              <small class="text-muted">Address</small>
              <input class="form-control input-lg" type="text" :value="add_Cus" style="height:50px;" required disabled>
              <br>
              <br>
            
              <devices-modal @SelectedDevice="Selected_Item" v-bind:selectedCus="ccode" :disabled="disabled"></devices-modal> 

            </div>
       </div>

    </div>


    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <table class="table" style="width:100%;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Model</th>
                <th scope="col">Description</th>
                <th scope="col">Cost</th>
                <th scope="col">Repaired By</th>  
                <th scope="col"></th>  
                <th scope="col">Remarks</th>
                <th scope="col">Status</th>
                <th scope="col">Options</th>            
              </tr>
            </thead>
            <tbody v-if="po_items">
              <tr  v-for="(po_item, k) in po_items" :key="k"> 
                <th>{{k}}</th>
                <td>{{po_item.DeciveName}}-{{po_item.Model}}</td>
                <td><textarea class="mahaba" v-model="po_item.description" :disabled="disabled == 1"></textarea></td>
                <td>
                    <input style="width:100%;" v-model="po_item.UnitCost"  type="number" @change="calculateLineTotal(po_item)" :disabled="disabled == 1"> 
                </td>
                <td>{{po_item.Employee}}</td>
                <td><employee-modal @loadindex="indext" @SelectedEmployee="Selected_employee" v-bind:index="k" :disabled="disabled"/></td>
                <td><textarea class="mahaba" v-model="po_item.Remarks"  @change="calculateLineTotal(po_item)" :disabled="disabled == 1"></textarea></td>
                <td>
                <select @change="StatCheck(k)" v-model="po_item.DeviceStatus">
                    <option>Claimed</option>
                    <option>RTO</option>
                    <option>Open</option>
                  </select>
                </td>
                <td :disabled="disabled == 1">
                  <b-badge variant="info" @click="calculateTotalInArray()">Recompute</b-badge>
                  <b-badge variant="danger" @click="deleteRow(k, po_item,po_item.Icode)" :disabled="disabled == 1">X</b-badge>
                </td>
              </tr>
            </tbody>
          </table>
          <br>
          <br>
        </div>
      
      </div>

        <div class="row">
          <div class="col"></div>
          <div class="col-md-4">
              <div class="total"> 
                <Label><b>Total:</b> {{PO_total| numeral('0,0')}} Php</Label><br>
                <Label for="Deposit"><b>Deposit/Payment:</b></Label>
                <input type="number" id="Deposit" v-model="Deposit"/><hr>
                <Label><b>Balance:</b> {{PO_Balance| numeral('0,0')}} Php</Label><br>
                <Label><b>Change:</b> {{PO_Change| numeral('0,0')}} Php</Label><br>
                <Label for="status"><b> Status: </b></Label>
                <Label>{{status}}</Label>
                <br>
                <br>
                <button class="btn btn-info" @click="saveform()">Save</button>
              </div>
            </div>
        </div>
      
    </div>


</div>
</template>

<script>
import ItemsModal from '../../Modals/ItemsModal';
//import VendorModal from '../../Modals/VendorModal';
import CustomerModal from '../../Modals/CustomerModal';
import Swal from 'sweetalert2'

import MenuList from '../../Page/Sales/MainInvoice2';
import DevicesModal from '../../Modals/DevicesModal.vue';
import EmployeeModal from '../../Modals/EmployeeModal.vue';


function int_data(){
  return{
   //---for list of po
       datacollection: null,
       po:'',
       PO_total:0,
       PO_Balance:0,
        PO_Change:0,
       Vendor_code:'',
       Customer_code:'',
       Ship_to:'Ship',
       status:'Open',
       ccode:'',
  
       Customer:'',
       add_Cus:'',
       Num:'',
      
      //---for details of po
      po_items2:[],
      po_details:[],
      po_items:[{
        Employee:'',
        RepairedbyCode:'',
        Icode:'',
        DeciveName:'',
        description:'',
        Code:'',
        Qty:'',
        UnitCost:'',
        Tcost:0,
        AvailableQty:0,
        Remarks:"",
        DeviceStatus:"Open",
        invoiceLoad:'NEW',
        Model:'',
      }],
      
     
      //-----for loading items
        items:[],
        //--disable
        disabled:0,
        //selected index
        ins:0,
        //Deposit
        //----and payment
        Deposit:null,
        
    }
    }


export default {
  //prop:['PO_Load'],

    components: {
    MenuList,
    ItemsModal,
    //VendorModal,
    CustomerModal,
        DevicesModal,
        EmployeeModal,
    }, 

    data:function(){
      return int_data();
      }, 

    beforeMount(){
      this.clearData();
    },



    mounted(){
      if(typeof this.$route.params.PO_Load === "undefined" ){
        console.log("PO Undefied")
        this.invoiceLoad ="NEW";    
      }else{
        this.Load_PO();
         this.invoiceLoad = this.$route.params.PO_Load;    
      }
    },

    watch:{
        Deposit: function(val){
            this.PO_Balance=this.PO_total-val;
            if( this.PO_Balance<=0 && this.Deposit>0){
                this.PO_Change=this.PO_Balance;
                this.PO_Balance=0;
                this.status="Fully Paid"
            }
            else{
              this.PO_Change=0;
              this.status="Open"
            }
        }
    },

    updated(){
     
    },

    methods:{

      StatCheck(i){
          if(this.po_items[i]['DeviceStatus']=="RTO"){
            this.po_items[i]['UnitCost']=0;
            this.calculateTotalInArray()
          }
      },

      indext(event){
        this.ins=event
      },

      approvedStatus(status){
         document.getElementById("po").disabled = true;
        if (status=="Approved")
        {
        CustomerModal.disabled
        ItemsModal.disabled//add item
        DevicesModal.disabled//device
        document.getElementById("btnSave").disabled = true;//save btn
        document.getElementById("btnClear").disabled = true;//clear btn 
        VendorModal.disabled
        this.disabled=1}
      },



      Selected_Item(event){
         var code=event['Code'],Name=event['Name'],Unit=event['Unit'];
        var i;
        var meron = false;
         for (i=0;i < this.po_items.length; i++){
            if(this.po_items[i]['Icode']===code){
               meron = true;
            }
        }

        if (meron){
        }
        else{
            if (this.po_items[0]['Icode']=="")
         {this.po_items.splice(0, 1);}

             this.po_items.push({
                Employee:'',
                Icode:code,
                DeciveName:Name,
                Model:Unit,
                Qty:1, 
                DeviceStatus:"Open",
                Remarks:"",
         });
        }
        this.closeModal();
      },


      Selected_ven(event){  
                this.add_Ven=event['Address'];
                this.Vendor=event['Vendor'];
                this.Vendor_code=event['id'];
                
  
      },

       Selected_cus(event){        
                this.add_Cus=event['Address'];
                this.Customer=event['Customer'];
                this.Customer_code=event['id'];
                this.ccode=event['Ccode'];
                this.Num=event['Number'];
                  // this.po_items="";
      },

       Selected_employee(event){  
        this.po_items[this.ins].Employee=event['Employee'];
        this.po_items[this.ins].RepairedbyCode=event['Ecode'];
        
      },

      load_item(){
        axios.get('/api/LoadItems')
        .then(
          (response)=>{
            this.items=response.data;
          }
        )
      },


      load_customer(){
          axios.get('/api/LoadlistCus')
          .then(
              (response)=>{
                
                  this.List_Customer=response.data;
              }
          )
          .catch()
      },
      
        addNewRow(code) {
          var codes=$('#code').val()

            this.po_items.push({
                Icode:codes,
                DeciveName:'New Added Descriptopn',
                Code:'ea',
            });
            this.closeModal()
        },

        deleteRow(index,invoice_product,code) {
            var idx = this.po_items.indexOf(invoice_product);
            var sub=0-invoice_product.Tcost;
            console.log(idx, code);
            if (idx > -1) {
                this.po_items.splice(idx, 1);
           
            }
               if(this.po_items.length==0){
                    this.po_items.push({
                Icode:"",
                DeciveName:'',
                Code:'',
                Qty:0,
                                  });
                  }
            this.calculateTotal(sub);
        },
        
        
        calculateLineTotal(invoice_product) {
            var total = parseFloat(invoice_product.Qty) * parseFloat(invoice_product.UnitCost);
            var sub=0-invoice_product.Tcost;
            this.calculateTotal(sub);
            //console.log(invoice_product.Qty,invoice_product.UnitCost);
            
            if (!isNaN(total)) {
                invoice_product.Tcost = total.toFixed(2);
            }
            //console.log(total);
            this.calculateTotal(total);
        },

        closeModal() {
            // document.getElementById('close').click();
},

  calculateTotalInArray(){

          var i;
          this.PO_total =0;
                  for (i=0; i < this.po_items.length; i++){

                      this.po_items[i]['Tcost']=this.po_items[i]['Qty']*this.po_items[i]['UnitCost'];
                      this.calculateTotal(this.po_items[i]['Tcost']);
                  }
},
        calculateTotal(Sub) {
            var total =parseFloat(this.PO_total) + parseFloat(Sub);
            if (!isNaN(total)) {
                this.PO_total = total.toFixed(2);
            }
        },

checkQty(product){

              if(parseFloat(product.AvailableQty)>=parseFloat(product.Qty)){
                this.calculateLineTotal(product)
              }
              else{
                  alert("Qty is greater than available!")
                  product.Qty=product.AvailableQty;
              }
        },


        saveform(){
          // console.log(this.invoiceLoad)
          //   axios.post('/api/SaveInvoice', {
          //     po_items:this.po_items, 
          //     PO_total:this.PO_total,
          //     Ship_to:this.ccode,
          //     Invoice:this.invoiceLoad,
          //     payment:this.Deposit,
          //     Status:this.status,
          //     Balance:this.PO_Balance,
          //     })
          //   .then(()=>{
              
          //      this.clearData();
               
          //   })
          //   .catch((error)=>{
          //       this.errors=error.response.data.errors;
          //   })


            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure with the following details of your Job Order?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
              }).then((result) => {
                if (result.value) {

              axios.post('/api/SaveInvoice', {
              po_items:this.po_items, 
              PO_total:this.PO_total,
              Ship_to:this.ccode,
              Invoice:this.invoiceLoad,
              payment:this.Deposit,
              Status:this.status,
              Balance:this.PO_Balance,
              })
            
            .then(()=>{
               this.clearData();

               Swal.fire({
              title: 'Job Order placed Successfully',
              icon: 'success',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
            })
            }).catch(()=>{
                //this.errors=error.response.data.errors;
                Swal.fire({
                  title: 'Error',
                  text:'Invalid JO Details',
                  icon: 'danger',
                  showCancelButton: false,
                  showConfirmButton: false 
                })
            })

          }else if (result.dismiss === Swal.DismissReason.cancel) {
           console.log("back to create JO.")
          }
        })




        },

        Load_PO(){
          
          axios.get('/api/GetInvoiceWithDetails', {params:{invoice:this.$route.params.PO_Load}})
          .then(
              (response)=>{
                  this.po_items2=response.data;
                  this.Selected_cus2(this.po_items2[0]['Ccode']);
                  this.Deposit=this.po_items2[0]['payment'];
                  this.PO_total=this.po_items2[0]['Total_Amount'];
                  this.po_items=response.data
                  
                  }
          )
         .catch((error)=>{
                this.errors=error.response.data.errors;
            })
        },

        Selected_cus2(Ccode){
          var i; 
          console.log(this.List_Customer);
            for(i=0;i<=this.List_Customer.length-1;i++){
              if (this.List_Customer[i]['Ccode']==Ccode){
                this.add_Cus=this.List_Customer[i]['Address'];
                this.Customer=this.List_Customer[i]['Customer'];
                this.Customer_code=this.List_Customer[i]['id'];
                this.ccode=this.List_Customer[i]['Ccode'];
                this.Num=this.List_Customer[i]['Number'];
              }
            }
        },

        clearData(){
          Object.assign(this.$data, this.$options.data.apply(this));
               this.load_customer();
               this.load_item();
        },

        deleteItem(code){
          axios.post('/api/DeletePOItem',{params:{PO:this.po,code:code}})
        },
    }
}
</script>
<style>

.PO{
  color:gray;
  max-height: 600px;
}


 
/* .qty{
width:50px;
overflow: hidden;
padding:0;
margin: 0%;

}

.qty>input{
width: 100%;
text-align: center;
} */
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
th{
  width:150px
}
tr:hover{
  cursor: pointer;
}

.table{
  width: 100% !important;
}

.total{
  
  box-shadow: 0px 0px 2px grey;
  border-radius:5px;
  padding:30px;
}

#repairedByDropDown,#receivedByDropDown{
  width:100%;
  padding:10px;
}
tr:hover{
  background-color: #eee;
}
.mahaba{
  width:100%;
}
textarea{
  height: 40px;
}


/**try for input table
.in { color: blue;}
.in input {display: block; padding: 0; margin: 0; border: 0; width: 100%;}
.in td {margin: 0; padding: 0;}*/
</style>