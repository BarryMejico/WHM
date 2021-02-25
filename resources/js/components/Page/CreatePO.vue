<template>
    <div class="container">
 
      <h1> Create Purchase </h1>
      <hr>
      <br>
      <br>
      <div class="row">
        <div class="col-lg-2">
           <MenuList></MenuList>
        </div>

        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-inline">
                  <label for="po">PO#: </label>                     
                  <input class="form-control" v-model="po" id="po" type="text" required autocomplete="name" autofocus>
                  <br>  
                    <VendorModal @SelectedVendor="Selected_ven" :disabled="disabled" ></VendorModal>    
              </div>     
            </div>
            <div class="col-lg-6">
              <div class="form-inline">
                <label for="mode">Mode:</label>                     
              <input id="mode" type="text" class="form-control" required autocomplete="name" autofocus>
              <br>
                  
                  <CustomerModal @SelectedCustomer="Selected_cus" :disabled="disabled" ></CustomerModal>
                  
              </div>     
            </div>
          </div>
          <br>
        
              <div class="row">
              <div class="col-lg-6">
                  <div class="form-inline"> 
                  <div>
                    <b>Name:</b><label class="text-muted"><i>{{Vendor}}</i></label><br>
                    <b>Address:</b><label class="text-muted"><i>{{add_Ven}}</i></label><br>
                  </div>
                </div>     
              </div>
              <div class="col-lg-6">
                <div class="form-inline">    
                  <div>
                    <b>Name: </b><label class="text-muted"><i>{{Customer}}</i></label><br>
                    <b>Address: </b><label class="text-muted"><i>{{add_Cus}}</i></label><br>
                  </div>
                </div>
              </div>
            </div>
          
        </div>
         <div class="col-lg-2">
             <button type="button" class="btn btn-info">Print</button>
            <items-modal @SelectedItems="Selected_Item" :disabled="disabled"></items-modal>
    <!--Status-->        
    <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
    <span class="caret">{{status}}</span>
    <p>{{last_update}}</p>
    </button>
    <ul class="dropdown-menu">
      <li><button @click="changeStatus('Open')" class="my_btn btn">Open</button></li>
      <li><button @click="changeStatus('Approved')" class="success my_btn">Approved</button></li>
      <li><button @click="changeStatus('Canceled')" class="my_btn btn-danger">Canceled</button></li>
    </ul>
    </div>
         </div>
      </div>
    
    
<!--End Status-->
    <br>
    <br>
    <br>

            
    <div class="sc">
      <div class="row">
        <div class="col-lg-10">
           <table class="table table-responsive">
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
                <td class="in"><div class="qty"><input v-model="po_item.Qty" min="1" type="number" @change="calculateLineTotal(po_item)" :disabled="disabled == 1"></div></td>
                <td class="in"><div class="qty"><input v-model="po_item.UnitCost"  @change="calculateLineTotal(po_item)" :disabled="disabled == 1"></div></td>
                <td>{{po_item.Tcost | numeral('0,0')}} Php</td>
                <td>
                  <button class="my_btn btn link" :disabled="disabled == 1" ><small>Recompute</small></button>
                  <button class="my_btn btn link" @click="deleteRow(k, po_item,po_item.Icode)" :disabled="disabled == 1"><small>X</small></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-2">
            <div class="total">
              <span><b>Total:</b> {{PO_total| numeral('0,0')}} Php</span><br>
              <hr>
              <button type="button" id="SaveBtn" class="btn btn-info" @click.prevent="saveform">Save</button>
              <button type="button" id="CanBtn" class="btn danger btn-danger" @click.prevent="clearData">Clear ALL</button>
            </div>

        </div>
      </div>
     
  
  
   
</div>


   
   
<!-- <button href="#Loading" id="btnLoad"  data-toggle="modal" type="button" class="btn btn-primary btn-sm" >Loading</button> -->

<!--modal Mod/Del-->
<!-- <div id="Loading" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Loading</h4>
					<button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
          loading img
        </div>
    </div>
  </div>
</div> -->

</div>

</template>

<script>
import ItemsModal from '../Modals/ItemsModal';
import MenuList from '../Page/MainPO';
import VendorModal from '../Modals/VendorModal';
import CustomerModal from '../Modals/CustomerModal';
import Swal from 'sweetalert2'

function int_data(){
  return{
   //---for list of po
       datacollection: null,
       po:'',
       PO_total:0,
       Vendor_code:'x',
       Customer_code:'x',
       Ship_to:'Ship',
       status:'Open',
       last_update:'',
       //---for loading Vendors
       // List_Vendor:[],
        Vendor:'x',
        add_Ven:'x',
  
      //---for loading Ship to
      // Ship:'',
      // List_Customer:[],
       Customer:'x',
       add_Cus:'x',
      
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
      }],
      //-----for loading items
        items:[],
        disabled:0,
    }
    }


export default {
  //prop:['PO_Load'],

    components: {
    MenuList,
    ItemsModal,
    VendorModal,
    CustomerModal,
    }, 

    data:function(){
      return int_data();
      }, 

    created(){
      this.clearData();
    },

    beforeMount(){
      //this.load();
      var $POL = this.$route.params.PO_Load;      
      if(typeof this.$route.params.PO_Load === "undefined" ){
        console.log("PO Undefied")
        console.log(".");
      }else{
        this.Load_PO();
        console.log(".");
        this.Load_Details();
        console.log(". unload next");
        //this.unload();
      }
     
    },

    mounted(){
      
    },
    afterupdated(){
                
    },
  

    methods:{
      load(){document.getElementById('btnLoad').click();},
      unload(){document.getElementById('close').click();},

      approvedStatus(status){
         document.getElementById("po").disabled = true;
         console.log(status);
        if (status=="Approved")
        {
          
        CustomerModal.disabled;
        ItemsModal.disabled;
        VendorModal.disabled;

        document.getElementById("SaveBtn").disabled = true;//save btn
        document.getElementById("CanBtn").disabled = true;//clear btn 
        this.disabled=1}
      },

      Selected_Item(event){
        var code=event['Code'],Name=event['Name'],Unit=event['Unit'];
        var i;
        var meron = false;
         
         if (this.po_items[0]['Icode']=="")
        {this.po_items.splice(0, 1);}
         
         for (i=0;i < this.po_items.length; i++){
            if(this.po_items[i]['Icode']===code){
               meron = true;
               this.po_items[i]['Qty']=this.po_items[i]['Qty']+1;
            }
        }

        if (meron){
            console.log("Item already Exist!!!")
        }
        else{
          
        this.po_items.push({
                Icode:code,
                idescription:Name,
                iunit:Unit,
                Qty:1,
                                  });
        }
            this.closeModal();
      },


      Selected_ven(event){  
                this.add_Ven=event['Address'];
                this.Vendor=event['Vendor'];
                this.Vendor_code=event['Vcode'];
  
      },

       Selected_cus(event){        
                this.add_Cus=event['Address'];
                this.Customer=event['Customer'];
                this.Customer_code=event['Ccode'];
      },
//------------------------------------------------------------------------------------------------------ 
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

      load_Selected_customer(cus){
        var i;

        

        for(i=0;i<=this.List_Customer.length-1;i++){
          

            if(this.List_Customer[i]['Ccode']==cus){ 
                this.add_Cus=this.List_Customer[i]['Address'];
                this.Customer=this.List_Customer[i]['Customer'];
                this.Customer_code=this.List_Customer[i]['Ccode'];
            }
        }
      },

      load_Selected_vendor(ven){
        var i;
        
        for(i=0;i<=this.List_Vendor.length-1;i++){
          
          if(this.List_Vendor[i]['Vcode']==ven){
                this.add_Ven=this.List_Vendor[i]['Address'];
                this.Vendor=this.List_Vendor[i]['Vendor'];
                this.Vendor_code=this.List_Vendor[i]['Vcode'];
            }
        }
      },
//------------------------------------------------------------------------------------------------------    
        addNewRow(code) {
          var codes=$('#code').val()
          //console.log(codes);
            this.po_items.push({
                Icode:codes,
                idescription:'New Added Descriptopn',
                iunit:'ea',
            });
            this.closeModal()
        },

        deleteRow(index,invoice_product,code) {

             Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure to remove this Item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
              }).then((result) => {
                if (result.value) {

                  var idx = this.po_items.indexOf(invoice_product);
                  var sub=0-invoice_product.Tcost;
                  console.log(idx, code);
                  if (idx > -1) {
                      this.po_items.splice(idx, 1);
                  }
                  this.calculateTotal(sub);

  
            Swal.fire({
              title: 'Item Removed Successfully',
              icon: 'success',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
            })

          }else if (result.dismiss === Swal.DismissReason.cancel) {
          console.log('Item Stays');
          }
        })
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

        saveform(){

             Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure with the following details of your purchase?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
              }).then((result) => {
                if (result.value) {

              axios.post('/api/SavePo', {
              po_items:this.po_items, 
              PO_total:this.PO_total,
              PO:this.po,
              //Created_by:this.userId['id'],       //'Created_by' => 'required',
              Vendor:this.Vendor_code,         //'Vendor'=>'required',
              Ship_to:this.Customer_code,            //'Ship_to'=>'required',
              status:this.status,
              })
            .then(()=>{
               this.clearData();
            })
            .catch((error)=>{
                this.errors=error.response.data.errors;
            Swal.fire({
              title: 'Error',
              icon: error.response.data.errors,
              showCancelButton: false,
              showConfirmButton: false 
            })
            })
  
            Swal.fire({
              title: 'Order is placed Successfully',
              icon: 'success',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
            })

          }else if (result.dismiss === Swal.DismissReason.cancel) {
          console.log('Back to Create PO');
          }
        })


        },

        Load_PO(){
          axios.get('/api/GetPo', {params:{PO:this.$route.params.PO_Load}})
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
          axios.get('/api/GetPoHead', {params:{PO:this.$route.params.PO_Load}})
          .then(
            (response)=>{
                  this.po_details = response.data;
                  this.po = this.po_details[0]['PO'];
                  this.PO_total = this.po_details[0]['Total_Amount'];
                  
                  this.Vendor_code = this.po_details[0]['Vendor'];
                  

                  this.Customer_code = this.po_details[0]['Ship_to'];
                  
                  this.load_Selected_customer(this.Customer_code);
                  this.load_Selected_vendor(this.Vendor_code);


                  this.status=this.po_details[0]['Status'];

                  var D=this.po_details[0]['updated_at'];
                  var myDate = D.split(" ");
                  this.last_update=myDate[0];

                  this.approvedStatus(this.po_details[0]['Status']);
              }
          )
          .catch((error)=>{
                this.errors=error.response.data.errors;
            })
        },

        clearData(){
          Object.assign(this.$data, this.$options.data.apply(this));
               this.load_vendor();
               this.load_customer();
               this.load_item();
        },

        deleteItem(code){
          axios.post('/api/DeletePOItem',{params:{PO:this.po,code:code}})
        },

        changeStatus(NewStatus){
          if (this.status=="Open"){
          this.status=NewStatus;
          this.last_update= new Date().toISOString().slice(0, 10);
          axios.post('/api/ChangeStatus',{PO:this.po,Status:NewStatus})
          .then(
           //disable form
          )
          .catch()
          }
          else{
            console.log("PO already reviewed");
          }
        },
    }
}
</script>
<style scoped>
.total{
  float:right;
  box-shadow: 0px 0px 2px grey;
  border-radius:5px;
  padding:20px;
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
.my_btn{
  padding: 0% !important;
  margin:0% !important;
}
#po,#mode{
  margin:10px;
}
table{
  text-align:center;
}
th{
  width:150px
}
tr:hover{
  cursor: pointer;
}

/**

try for input table
.in { color: blue;}
.in input {display: block; padding: 0; margin: 0; border: 0; width: 100%;}
.in td {margin: 0; padding: 0;}*/
</style>