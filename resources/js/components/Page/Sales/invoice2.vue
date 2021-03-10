<template>
    <div>
    <div class="container">
      
     <br>
      <br>
      <br>
      
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-3">
          <b class="text-muted">Date</b> 
          <input class="form-control" type="date" required autofocus>
        </div>

        <div class="col-md-4">
          <b class="text-muted">Received by</b>
              <!-- <select name="employee" id="receivedByDropDown">
                <option value="abi tolentino">abi tolentino</option>
                <option value="barry mejico">barry mejico</option>
                <option value="james reid">james reid</option>
                <option value="john doe">john doe</option>
              </select> -->
              <select v-model="selected" style="width:100%;height:40px;">
                <option v-for="option in options" :key="option" v-bind:value="option.value">
                  {{ option.text }}
                </option>
              </select>
          </div>
      </div>
    <br>
    <br>
    <br>
    <h3 class="text-muted">Customer Details</h3>
      <br>
       <div class="row" style="margin-bottom:50px;">
          <div class="col-md-5">
            <br>
             <CustomerModal id="CusModal" @SelectedCustomer="Selected_cus" :disabled="disabled"></CustomerModal>
              <b class="text-muted">Name</b><br>
              <input class="form-control" type="text" :value="Customer" required autofocus>
            
              <b class="text-muted">Contact Number</b>
            <input class="form-control" type="text" required autofocus> 
          </div>
        
           <div class="col-md-7"> 
              <b class="text-muted">Address</b>
              <textarea class="form-control" type="text" :value="add_Cus" style="height:210px;" required autofocus></textarea>
              <br>
            </div>
       </div>
     
      <h3 class="text-muted"> Device details</h3>
      <br>
       <div class="row">
          <div class="col-md-8"><b>Description</b><textarea class="form-control" type="text" style="height:210px;" required autofocus></textarea></div>
          <div class="col-md-4">
            <b class="text-muted">Amount/Cost of repair</b><input class="form-control" type="number" required autofocus>
            <br>
            <b class="text-muted">Deposit</b><input class="form-control" type="number" required autofocus>
            <br>
            <b class="text-muted">Balance</b><input class="form-control" type="number" required autofocus>
          </div>
      </div>
       <button class="btn btn-outline-info" style="margin-bottom:110px;">Save Job Order</button>
     
      <h3 class="text-muted"> End Report</h3>
      <br>
       <div class="row">
          <div class="col-md-5"> 
            <b class="text-muted">Repaired by</b><br>
          <!-- <select name="employee" id="repairedByDropDown">
              <option value="abi tolentino">abi tolentino</option>
              <option value="barry mejico">barry mejico</option>
              <option value="james reid">james reid</option>
              <option value="john doe">john doe</option>
            </select> -->
             <select v-model="selected" style="width:100%;height:40px;">
                <option v-for="option in options" :key="option" v-bind:value="option.value">
                  {{ option.text }}
                </option>
              </select>
            <br>
            <br>
            <b class="text-muted">Date claimed</b>
            <input class="form-control" type="date" required autofocus>
          </div>
          <div class="col-md-7">
            <b class="text-muted">Note</b>
          <textarea class="form-control" type="text" required autofocus style="height:125px;"></textarea>
          </div>
      </div>
      <button class="btn btn-outline-success">Sumbit Report</button>


     
      
       <!-- <div class="row">
          <div class="col-md-3"><b>Received by</b>
            <select name="employee" id="receivedByDropDown">
              <option value="abi tolentino">abi tolentino</option>
              <option value="barry mejico">barry mejico</option>
              <option value="james reid">james reid</option>
              <option value="john doe">john doe</option>
            </select>
        </div>
          <div class="col-md-3"><b>Repaired by</b><br>
          <select name="employee" id="repairedByDropDown">
              <option value="abi tolentino">abi tolentino</option>
              <option value="barry mejico">barry mejico</option>
              <option value="james reid">james reid</option>
              <option value="john doe">john doe</option>
            </select>
          </div>
          <div class="col-md-3"><b>Date claimed</b><input class="form-control" type="date" required autofocus></div>
          <div class="col-md-3"><b>Note</b><textarea class="form-control" type="text" required autofocus></textarea></div>
      </div> -->
  

        <!------------------------------------------------------------------------------------------------------->
      <!-- <div class="row">
          <div class="col-lg-2">
            <MenuList></MenuList>
          </div>
          <div class="col-lg-1"></div>

            <div class="col-lg-6">

              <label for="po">Invoice#: </label>                     
              <input class="form-control" v-model="po" id="po" type="text" required autocomplete="name" autofocus>
             
                <CustomerModal id="CusModal" @SelectedCustomer="Selected_cus" :disabled="disabled"></CustomerModal>
                <div>
                  <br>
                  <b>Name: </b><br><label class="text-muted"><i>{{Customer}}</i></label><br>
                  <b>Address:</b><br><label class="text-muted"><i>{{add_Cus}}</i></label><br>
                </div>             
          
              </div> 
               <div class="col-lg-1"></div>

            <div class="col-lg-2">
               <button type="button" class="btn btn-info">Print</button>
                <items-modal @SelectedItems="Selected_Item" :disabled="disabled"></items-modal>

                <div>
                    <devices-modal @SelectedDevice="Selected_Item" v-bind:selectedCus="ccode" :disabled="disabled"></devices-modal> 
                </div> 

                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                    <span class="caret">{{status}}</span></button>
                    <ul class="dropdown-menu">
                      <li><button @click="changeStatus('Open')" class="my_btn btn">Open</button></li>
                      <li><button @click="changeStatus('Approved')" class="success my_btn">Approved</button></li>
                      <li><button @click="changeStatus('Canceled')" class="my_btn btn-danger">Canceled</button></li>
                    </ul>
                </div>
            </div>
     
        </div>
      
        <br>
        <br>
        <br>
      

         <div class="row">
              <div class="col-lg-10">
                <table id="tbl" class="table table-responsive">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item Code</th>
                    <th scope="col">Description</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Cost</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Action</th>    
                  </tr>
                </thead>
                <tbody v-if="po_items">
                  <tr  v-for="(po_item, k) in po_items" :key="k">      
                    <th scope="row" class="in">{{k}}</th>
                    <td>{{po_item.Icode}}</td>
                    <td>{{po_item.idescription}}</td>
                    <td>{{po_item.iunit}}</td>
                    <td class="in"><div class="qty"><input  v-model="po_item.Qty" min="1" type="number" @change="checkQty(po_item)" :disabled="disabled == 1"></div></td>
                    <td class="in"><div class="qty"><input  v-model="po_item.UnitCost"  @change="calculateLineTotal(po_item)" :disabled="disabled == 1"></div></td>
                    <td>{{po_item.Tcost}} Php</td>
                    <td :disabled="disabled == 1">
                    <badge class="my_btn btn link" @click="calculateLineTotal(po_item)"><small>Recompute</small></badge>
                    <badge class="my_btn btn link" @click="deleteRow(k, po_item,po_item.Icode)" :disabled="disabled == 1"><small>X</small></badge></td>
                  </tr>
                </tbody>
              </table>
              </div>

              <div class="col-lg-2">
                <div class="total"> 
                    <span><b>Total:</b> {{PO_total}} Php</span><br>
                    <hr>
                    <button type="button" id="btnSave" class="btn btn-info" @click.prevent="saveform">Save</button>
                    <button type="button" id="btnClear" class="btn danger btn-danger" @click.prevent="clearData">Clear ALL</button>
                </div>
              </div>
             
         </div> -->
 
    
    </div>
</div>

</template>

<script>
import ItemsModal from '../../Modals/ItemsModal';
//import VendorModal from '../../Modals/VendorModal';
import CustomerModal from '../../Modals/CustomerModal';

import MenuList from '../../Page/Sales/MainInvoice';
import DevicesModal from '../../Modals/DevicesModal.vue';

function int_data(){
  return{
   //---for list of po
       datacollection: null,
       po:'',
       PO_total:0,
       Vendor_code:'',
       Customer_code:'',
       Ship_to:'Ship',
       status:'',
       ccode:'',
       //---for loading Vendors
       // List_Vendor:[],
       // Vendor:'',
       // add_Ven:'',
  
      //---for loading Ship to
      // Ship:'',
      // List_Customer:[],
       Customer:'',
       add_Cus:'',
      
      //---for details of po
      po_items2:[],
      po_details:[],
      po_items:[{
        Icode:'',
        idescription:'',
        iunit:'',
        Qty:'',
        UnitCost:'',
        Tcost:0,
        AvailableQty:0,
      }],
      //-----for loading items
        items:[],
        //--disable
        disabled:0,

        ///////////////////////for select box
        selected: 'A',
        options: [
          { text: 'Repair Man 1', value: 'Repair Man 1' },
          { text: 'Repair Man 2', value: 'Repair Man 2' },
          { text: 'Repair Man 3', value: 'Repair Man 3' }
        ]

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
    }, 

    data:function(){
      return int_data();
      }, 

    beforeMount(){
      this.clearData();

      var $POL = this.$route.params.PO_Load;      
      if(typeof this.$route.params.PO_Load === "undefined" ){
        //console.log("PO Undefied")
      }else{
        this.Load_PO();
         
      }
    },

    mounted(){
      
    },

    updated(){
      if(typeof this.$route.params.PO_Load === "undefined" ){
        
        //console.log("PO Undefied")
      }else{
        this.Load_Details();
        
        
      
        
      }
    },

    methods:{

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

      changeStatus(){

      },

      passCus(){
        
      },

      addService(){
        this.po_items.push({
                Icode:'service-001',
                idescription:'asd',
                iunit:'asd',
                Qty:'1',
                UnitCost:'5',});
        
      },

      Selected_Item(event){
  
         var code=event['Code'],Name=event['Name'],Unit=event['Unit'];
        var i;
        var meron = false;

         

         for (i=0;i < this.po_items.length; i++){
            if(this.po_items[i]['Icode']===code){
               meron = true;
               this.po_items[i]['Qty']=this.po_items[i]['Qty']+1;
            }
        }

        if (meron){
            //console.log("Item already Exist!!!")
            
        }
        else{
          

          axios.get('/api/getitem',{params:{Code:code}})
          .then((res)=>{
            if(res.data.length>0){
            if (this.po_items[0]['Icode']=="")
        {this.po_items.splice(0, 1);}

            this.po_items.push({
                 Icode:code,
                idescription:Name,
                iunit:Unit,
                Qty:1, 
                AvailableQty:res.data[0]['Qty'],
                
        });

        }
        else{
          alert('No available QTY');
        }
          })
          .catch(
            
          )
        
        }
        this.checkQty(this.po_items[this.po_items.length-1]);
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
      },

      load_vendor(){
          axios.get('/api/LoadVen')
          .then(
              (response)=>{
                  this.List_Vendor=response.data;
                  
              }
          )
          .catch()
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
          axios.get('/api/LoadCus')
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
                idescription:'New Added Descriptopn',
                iunit:'ea',
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
                idescription:'',
                iunit:'',
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
             document.getElementById('close').click();
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
            axios.post('/api/SaveInvoice', {
              po_items:this.po_items, 
              PO_total:this.PO_total,
              PO:this.po,
              //Created_by:this.userId['id'],       //'Created_by' => 'required',
              //Vendor:this.Vendor_code,         //'Vendor'=>'required',
              Ship_to:this.ccode,            //'Ship_to'=>'required',
              })
            .then(()=>{
               this.clearData();
            })
            .catch((error)=>{
                this.errors=error.response.data.errors;
            })
        },

        Load_PO(){
          
          axios.get('/api/GetInvoice', {params:{PO:this.$route.params.PO_Load}})
          .then(
              (response)=>{

                  this.po_items2=response.data;
                  
                  var i;
                  for (i=0; i < this.po_items2.length; i++){
                      this.po_items2[i]['Tcost']=this.po_items2[i]['Qty']*this.po_items2[i]['UnitCost'];
                      this.calculateTotal(this.po_items2[i]['Tcost']);
                  }

                  this.po_items=this.po_items2;
                  
                  this.Load_idescription();
                  }
          )
         .catch((error)=>{
                this.errors=error.response.data.errors;
            })
        },

        Load_idescription(){
         
          var i,j;
                  for (i=0; i < this.po_items.length; i++){   
                      
                    for (j=0; j < this.items.length; j++){
                      
                      if (this.po_items[i]['Icode']===this.items[j]['Code']){
                      this.po_items[i]['idescription']=this.items[j]['Name'];  
                      this.po_items[i]['iunit']=this.items[j]['Unit']; 
                  }}}
        
        },

      Load_Details(){
                  axios.get('/api/GetInvoiceHead', {params:{PO:this.$route.params.PO_Load}})
          .then(
              (response)=>{
                  this.po_details=response.data;
                  this.po = this.po_details[0]['invoice'];
                  this.PO_total = this.po_details[0]['Total_Amount'];
                  this.Customer_code =this.po_details[0]['Ccode'];
                  this.Selected_cus2(this.po_details[0]['Ccode']);
                  this.approvedStatus(this.po_details[0]['Status']);
              });
        },

        Selected_cus2(Ccode){
          var i;
          
            for(i=0;i<=this.List_Customer.length-1;i++){
              
              if (this.List_Customer[i]['Ccode']==Ccode){
                this.add_Cus=this.List_Customer[i]['Address'];
                this.Customer=this.List_Customer[i]['Customer'];
                this.Customer_code=this.List_Customer[i]['id'];
                this.ccode=this.List_Customer[i]['Ccode'];
              }
            }
        },

        clearData(){
          Object.assign(this.$data, this.$options.data.apply(this));
               //this.load_vendor();
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
   float:right;
  box-shadow: 0px 0px 2px grey;
  border-radius:5px;
  padding:20px;
}
label{
    padding:10px;
}
#repairedByDropDown,#receivedByDropDown{
  width:100%;
  padding:10px;
}


/**try for input table
.in { color: blue;}
.in input {display: block; padding: 0; margin: 0; border: 0; width: 100%;}
.in td {margin: 0; padding: 0;}*/
</style>