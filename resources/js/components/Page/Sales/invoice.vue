<template>
    <div class="container-fluid">
    <div class="container">
      
        <!------------------------------------------------------------------------------------------------------->
         <div class="row" >
            <div class="col-md-12">
                  <div class="jumbotron" style="background-color:white; ">
                    <h1 class="text-muted">Sales Invoice: <b-icon icon="pencil-square" font-scale="1"></b-icon> <b>Create</b></h1>
                    <MenuList></MenuList>
                  </div>
            </div>
          </div>


      <b-row>

       
        <b-col>
          <label for="po">Invoice#: </label>                     
          <input class="form-control" v-model="po" id="po" type="text" required autocomplete="name" autofocus disabled>
          
          <CustomerModal id="CusModal" @SelectedCustomer="Selected_cus" :disabled="disabled"></CustomerModal>
          <div style="text-transform:capitalize;">
            <br>
            <div style="display:flex;">
            <h4>Name: <b class="text">{{Customer}}</b></h4><br>
            </div>
            <div style="display:flex;">
            <h4>Address:<b class="text">{{add_Cus}}</b></h4>
            </div>
          </div>                    
        </b-col> 
              
        <b-col cols="4">
          <br>
          <br>
            <button type="button" class="btn btn-info">Print</button>
            <items-modal @SelectedItems="Selected_Item" :disabled="disabled" style="margin:5px;"></items-modal>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                <span class="caret">{{status}}</span></button>
                <ul class="dropdown-menu">
                  <li><button @click="changeStatus('Open')" class="my_btn btn">Open</button></li>
                  <li><button @click="changeStatus('Approved')" class="success my_btn">Approved</button></li>
                  <li><button @click="changeStatus('Canceled')" class="my_btn btn-danger">Canceled</button></li>
                </ul>
            </div>
        </b-col>
     
      </b-row>

    </div>
      
        <br>
        <br>
        <br>
      

         <div class="row">
              <div class="col-lg-12">
                <table class="table" style="width:100%;">
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
                   <td>{{po_item.Icode}}</td>    <!-- Code -->
                    <td>{{po_item.description}}</td>   <!--Name-->
                    <td>{{po_item.Unit}}</td>
                    <td class="in"><div class="qty"><input class="boxes" v-model="po_item.Qty" min="1" type="number" @change="checkQty(po_item)" :disabled="disabled == 1"></div></td>
                    <td class="in"><div class="qty"><input class="boxes" v-model="po_item.UnitCost"  type="number" @change="calculateLineTotal(po_item)" :disabled="disabled == 1"></div></td>
                    <td>{{po_item.Tcost| numeral('0,0')}} Php</td>
                    <td :disabled="disabled == 1">
                    <span class="badge badge-info" @click="calculateLineTotal(po_item)">Recompute</span>
                    <span class="badge badge-danger" @click="deleteRow(k, po_item,po_item.Code)" :disabled="disabled == 1"><small>X</small></span></td>
                  </tr>
                </tbody>
              </table>
              </div>     
         </div>
         <br>
         <br>

         <b-row>
           <b-col></b-col>
           <b-col cols="3">
            <div class="total"> 
                <span><b>Total:</b> {{PO_total| numeral('0,0')}} Php</span><br>
                <hr>
                <button type="button" id="btnSave" class="btn btn-info" @click.prevent="saveform">Save</button>
                <button type="button" id="btnClear" class="btn danger btn-danger" @click.prevent="clearData">Clear ALL</button>
            </div>
          </b-col> 
         </b-row>
      

         

       <!------------------------------------------------------------------------------------------------------->
    
    
</div>

</template>

<script>
import ItemsModal from '../../Modals/ItemsModal';

import CustomerModal from '../../Modals/CustomerModal';
import Swal from 'sweetalert2'

import MenuList from '../../Page/Sales/MainInvoice';


function int_data(){
  return{
   //---for list of po
       datacollection: null,
       po:'',
       PO_total:0,

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
        Unit:'',
        Qty:'',
        UnitCost:'',
        Tcost:0,
        AvailableQty:0,
        Remarks:null,
        status:null,
        RepairedbyCode:null,
        Employee:'',
        RepairedbyCode:'',
        DeciveName:'',
        Code:'',
        DeviceStatus:"Open",
        invoiceLoad:'NEW',
        Model:'',
      }],
      //-----for loading items
        items:[],
        //--disable
        disabled:0,
       
        //remarks
        Remarks:null,
    }
    }


export default {
  //prop:['PO_Load'],

    components: {
    MenuList,
    ItemsModal,

    CustomerModal,
       
    }, 

    data:function(){
      return int_data();
      }, 

    beforeMount(){
      this.clearData();
    },

    mounted(){

      if(typeof this.$route.params.PO_Load === "undefined" ){
         this.invoiceLoad ="NEW";  
         this.status="Open"  
        //console.log("PO Undefied")
      }else{
        this.invoiceLoad = this.$route.params.PO_Load;   
        this.Load_Details();
        
      }
    },

    updated(){
      
    },

    methods:{

      approvedStatus(status){
         document.getElementById("po").disabled = true;
        if (status=="Approved")
        {
        CustomerModal.disabled
        ItemsModal.disabled//add item
       
        document.getElementById("btnSave").disabled = true;//save btn
        document.getElementById("btnClear").disabled = true;//clear btn 

        this.disabled=1}
      },

      changeStatus(stat){
            this.status=stat
      },

      passCus(){
        
      },


      Selected_Item(event){
  console.log(event);
         var code=event['Code'],Name=event['Name'],Unit=event['Unit'];
        var i;
        var meron = false;
         for (i=0;i < this.po_items.length; i++){
            if(this.po_items[i]['Icode']===code){
               meron = true;
               this.po_items[i]['Qty']=this.po_items[i]['Qty']+1;
               this.checkQty(this.po_items[i]);
            }
        }

        if (meron){
            
        }
        else{
          

          axios.get('/api/getitem',{params:{Code:code}})
          .then((res)=>{
            if(res.data.length>0){
            if (this.po_items[0]['Icode']=="")
        {this.po_items.splice(0, 1);}

            this.po_items.push({
                 Icode:code,
                 description:Name,
                 Unit:Unit,
                 Qty:1, 
                 AvailableQty:res.data[0]['Qty'],
                 Remarks:null,
                 status:null,
                 RepairedbyCode:null,
                  Employee:'',
                  RepairedbyCode:'',
                  DeciveName:'',
                  DeviceStatus:null,
                  Model:'',
        });

        }
        else{
          //alert('No available QTY');
           Swal.fire({
                icon:'warning',
                title:"Oops!",
                text:"No More Available Item",
                showCancelButton: false,
                showConfirmButton: true
                }) 
        }
          })
          .catch((error)=>{
                 Swal.fire({
                    icon:'danger',
                    title:"Oops!",
                    text:error.response.data.errors,
                    showCancelButton: false,
                    showConfirmButton: true
                    }) 
            }
            
          )
        
        }
        
        this.closeModal();
      },



       Selected_cus(event){        
                this.add_Cus=event['Address'];
                this.Customer=event['Customer'];
                this.Customer_code=event['id'];
                this.ccode=event['Ccode'];
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
      


        deleteRow(index,invoice_product,code) {
            var idx = this.po_items.indexOf(invoice_product);
            var sub=0-invoice_product.Tcost;
            console.log(idx, code);
            if (idx > -1) {

              Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure to remove this Item?',
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
              }).then((result) => {
                if (result.value) {

               
             this.po_items.splice(idx, 1)
             if(this.po_items.length==0){
              this.po_items.push({
                Code:"",
                idescription:'',
                Unit:'',
                Qty:0,
              });
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
                  console.log("Cancel remove")// inshort do nothing on the UI
          }
        })
      }
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
                  product.Qty=product.AvailableQty;
                   //alert("Qty is greater than available!")
                   Swal.fire({
                    icon:'warning',
                    title:"Oops!",
                    text:"Quantity is Greater than Available",
                    showCancelButton: false,
                    showConfirmButton: true
                    }) 
              }
        },


        saveform(){
            axios.post('/api/SaveInvoice', {
              po_items:this.po_items, 
              PO_total:this.PO_total,
              Invoice:this.invoiceLoad,
              //Created_by:this.userId['id'],       //'Created_by' => 'required',
              //Vendor:this.Vendor_code,         //'Vendor'=>'required',
              Ship_to:this.ccode,            //'Ship_to'=>'required',
              Remarks:this.Remarks,
              payment:0,
              Status:this.status,
              Balance:0,
              })
            .then(()=>{
               this.clearData();
            })
            .catch((error)=>{
                 Swal.fire({
                    icon:'danger',
                    title:"Oops!",
                    text:error.response.data.errors,
                    showCancelButton: false,
                    showConfirmButton: true
                    }) 
            })
        },




      Load_Details(){
      axios.get('/api/GetInvoice', {params:{invoice:this.$route.params.PO_Load}})
          .then(
              (response)=>{
                  this.po_details=response.data;
                  this.po = this.po_details[0]['invoice'];
                  //this.PO_total = this.po_details[0]['Total_Amount'];
                  this.Customer_code =this.po_details[0]['Ccode'];
                  this.Selected_cus2(this.po_details[0]['Ccode']);
                  this.approvedStatus(this.po_details[0]['Status']); 
              this.invoiceLoad=this.po_details[0]['invoice'];
              this.Remarks=this.po_details[0]['Remarks'];
              this.payment=this.po_details[0]['payment'];
              this.status=this.po_details[0]['Status'];
              this.Balance=0,//=this.po_details[0]['invoice'];

                  this.po_items=response.data;
          this.calculateTotalInArray()
                  
              });

              
        },

        calculateTotalInArray(){
          var i;
                  for (i=0; i < this.po_items.length; i++){
                      this.po_items[i]['Tcost']=this.po_items[i]['Qty']*this.po_items[i]['UnitCost'];
                      this.calculateTotal(this.po_items[i]['Tcost']);
                  }
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
<style scoped>

.PO{
  color:gray;
  max-height: 600px;
}

.table{
  border-top-left-radius:20px;
  border-top-right-radius:20px;
}
 
.qty{
width:100px;
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
  width:100%;
  box-shadow: 0px 0px 2px grey;
  border-radius:5px;
  padding:20px;
}
#btnSave,#btnClear{
  margin:3px;
}
.text{
  text-indent: 10%;
}

/**try for input table
.in { color: blue;}
.in input {display: block; padding: 0; margin: 0; border: 0; width: 100%;}
.in td {margin: 0; padding: 0;}*/
</style>