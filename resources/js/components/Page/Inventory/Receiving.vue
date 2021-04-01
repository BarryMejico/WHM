<template>
    <div>
    <div class="container">
    <div class="row" >
      <div class="col-md-12">
            <div class="jumbotron" style="background-color:white; ">
              <h1 class="display-4 text-muted"><b-icon icon="cart-x-fill" font-scale="1"></b-icon>Purchase Order: <b>Receiving</b></h1>
              <MenuList></MenuList>
            </div>
      </div>
    </div>

      <div class="row">
          <div class="col-lg-10">

            <div class="row">
              <div class="col-lg-6">
                <div>
                  <label for="po" class="text-muted">PO#: </label>                     
                  <input class="form-control" v-model="po" id="po" type="text" required autocomplete="name" disabled>
                </div>     
              </div>
              <div class="col-lg-6">
                <div>
                    <label for="mode" class="text-muted">Mode: </label>                     
                    <input id="mode" type="text" class="form-control" required autocomplete="name" autofocus>
                </div>     
              </div>
            </div>
          <br>
            <div class="row" style="text-align:center">
              <div class="col-md-6 text-muted"><h6>Vendor</h6></div>
              <div class="col-md-6 text-muted"><h6>Customer</h6></div>
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
                        <b>Address:</b><label class="text-muted"><i>{{add_Cus}}</i></label><br>
                      </div>
                  </div>
                </div>
            </div>
          
        </div>
        
              <div class="col-lg-2">
                <br>
                <br>
                  <button type="button" class="btn btn-info" style="margin-bottom:10px;">Print</button>
                  <items-modal @SelectedItems="Selected_Item" :disabled="disabled == 1"></items-modal>
              
                 <!--Status-->        
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            <!--<span class="caret">{{status}}</span>
                            <p>{{last_update}}</p>-->
                            </button>
                            <ul class="dropdown-menu">
                              <li><button @click="changeStatus('Open')" class="my_btn btn">Open</button></li>
                              <li><button @click="changeStatus('Approved')" class="success my_btn">Approved</button></li>
                              <li><button @click="changeStatus('Canceled')" class="my_btn btn-danger">Canceled</button></li>
                            </ul>
                          </div>   
                <!--End Status-->
              </div>
      </div>
      <br>
      <br>
      <br>
       <div class="sc">
         <div class="row">
           <div class="col-md-12">
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
                    <td class="in"><div class="qty"><input v-model="po_item.Qty" min="1" type="number" @change="chckQty(po_item)"></div></td>
                    <td class="in">{{po_item.UnitCost | numeral('0,0')}}</td>
                    <td>{{po_item.Tcost | numeral('0,0')}} Php</td>
                    <td>
                      <span class="badge badge-info">Recompute</span>
                     <span class="badge badge-danger" @click="deleteRow(k, po_item)">X</span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
           
             
           </div>
              
      </div>

      <div class="row">
        <div class="col"></div>
          <div class="col-md-2" style="border:solid #eee 1px;padding:30px;border-radius:5px;">
            
            <span><b>Total:</b> {{PO_total | numeral('0,0')}} Php</span><br>
            <hr>
            <button type="button" class="btn btn-info" @click.prevent="saveform" style="margin-bottom:5px;">Save</button>
            <button type="button" class="btn danger btn-danger" @click.prevent="clearData">Clear ALL</button>
          </div>
      </div>
    </div>


    
    </div>
   
<!--modal Vendor-->
<div id="addVendorModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Add Vendor</h4>
					<button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group">		
                    <label>Item Code</label>	
                    
										<input type="text" id='Vcode' v-model="Vendor">
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" 
    v-for="(Vendor, k) in List_Vendor" :key="k">
    <a @click="Selected_ven(Vendor.id)">{{Vendor.Vendor}}</a>
    <span class="badge badge-primary badge-pill">{{Vendor.id}}</span>
  </li>
  <a class="link">New Vendor</a>
</ul>
          </div>
				</div>
				<div class="modal-footer">
          <button  type="button" class="btn btn-light" data-dismiss="modal" aria-hidden="true">Select Vendor</button>
				</div>
			
		</div>
	</div>
</div>

<!--modal Customer-->
<div id="addCustomerModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Add Customer</h4>
					<button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group">		
                    <label>Item Code</label>	
                    
										<input type="text" id='Vcode' v-model="Customer">
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" 
    v-for="(Customer, k) in List_Customer" :key="k">
    <a @click="Selected_cus(Customer.id)">{{Customer.Customer}}</a>
    <span class="badge badge-primary badge-pill">{{Customer.id}}</span>
  </li>
  <a class="link">New Customer</a>
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
import ItemsModal from '../../Modals/ItemsModal';
import MenuList from '../MainPO'
import VendorModal from '../../Modals/VendorModal';
import CustomerModal from '../../Modals/CustomerModal';
import Swal from 'sweetalert2'

function int_data(){
  return{
   //---for list of po
       datacollection: null,
       po:'',
       PO_total:0,
       Vendor_code:'',
       Customer_code:'',
       Ship_to:'Ship',
       //---for loading Vendors
        List_Vendor:[],
        Vendor:'',
        add_Ven:'',
  
      //---for loading Ship to
       Ship:'',
       List_Customer:[],
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
        status:'Open',
       last_update:'',
      }],
      //-----for loading items
        items:[],
        //try convert
        AmountCeiling:'',
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
      var $POL = this.$route.params.PO_Load;      
      if(typeof this.$route.params.PO_Load === "undefined" ){
        //console.log("PO Undefied")
      }else{
        this.Load_Details();
        this.Load_PO();
        
      }
    },

    methods:{
      
      Selected_Item(event){
         var code=event['Code'],Name=event['Name'],Unit=event['Unit'];
        var i,unitCost;
        var meron = false;
        var wala = false;
        //console.log(this.po_items);
       

         for (i=0;i < this.po_items2.length; i++){
            if(this.po_items2[i]['Icode']==code){
              unitCost=this.po_items2[i]['UnitCost'];
              meron = true;
            }
        }

        if (meron==false){
             Swal.fire({
                title: 'Item is Not on the List',
                icon: 'info',
                showCancelButton: true,
                showConfirmButton: false 
              })
        }
        else{
            if (this.po_items[0]['Icode']=="")
        {this.po_items.splice(0, 1);}
          var j;
          for (j=0;j<=this.po_items.length-1; j++){
            if(this.po_items[j]['Icode']==code || this.po_items[j]['Icode']==""){
              if(this.PO_total!= this.AmountCeiling){
              var newQTY= parseFloat(this.po_items[j]['Qty'])+1;     
              this.po_items[j]['Qty']=newQTY;
              this.chckQty(this.po_items[j]);
              }
              wala=true;
              break; 
            }
        }
        
        //console.log(wala);
              if(wala==false){
              //console.log("Pasok din");
              this.AmountCeiling=this.PO_total;
              this.PO_total=unitCost;
              this.po_items.push({
                Icode:code,
                idescription:Name,
                iunit:Unit,
                Qty:1,
                UnitCost:unitCost,
                Tcost:unitCost,
              });
            }
        }
            //this.tryconvert=Object.assign({}, this.po_items[this.po_items.length-1]);
            //console.log(this.tryconvert);
            this.calculateLineTotal(this.po_items[this.po_items.length-1]);
            //this.calculateLineTotal(this.tryconvert);
            this.closeModal();
      },


      Selected_ven(codes){        
        var code;
        code = parseInt(codes);
        var i;
        for (i=0;i < this.List_Vendor.length; i++){
            if(this.List_Vendor[i]['id']===code){
                this.add_Ven=this.List_Vendor[i]['Address'];
                this.Vendor=this.List_Vendor[i]['Vendor'];
                this.Vendor_code=this.List_Vendor[i]['id'];
            }
        }
                this.Vendor_code=code;
      },

       Selected_cus(codes){        
        var code;
        code = parseInt(codes);
        var i;
        for (i=0;i < this.List_Customer.length; i++){
            if(this.List_Customer[i]['id']===code){
                this.add_Cus=this.List_Customer[i]['Address'];
                this.Customer=this.List_Customer[i]['Customer'];
                this.Customer_code=this.List_Customer[i]['id'];
            }
        }
                this.Customer_code=code;
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
          //console.log(codes);
            this.po_items.push({
                Icode:codes,
                idescription:'New Added Descriptopn',
                iunit:'ea',
            });
            this.closeModal()
        },

        deleteRow(index,invoice_product) {
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
            //console.log(idx, index);
            if (idx > -1) {
                this.po_items.splice(idx, 1);
            }

            if (this.po_items.length==0){
              this.po_items=[];
              this.po_items.push({
                Icode:'',
                idescription:'',
                iunit:'',
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
          //console.log('Item Stays');
          }
        })

        },

        chckQty(invoice_product){
          var i;
          for (i=0;i < this.po_items2.length; i++){
            if(this.po_items2[i]['Icode']==invoice_product.Icode){
              if( parseFloat(this.po_items2[i]['Qty'])<= parseFloat(invoice_product.Qty)){
                invoice_product.Qty=this.po_items2[i]['Qty'];
               // alert("Qty is greater than expected!")

                 Swal.fire({
                          title: 'Qty is greater than expected',
                          icon: 'info',
                          showCancelButton: true,
                          showConfirmButton: false 
                        })
                
              }
              else{
              }
            }
        }

          this.calculateLineTotal(invoice_product)
        },
        
        calculateLineTotal(invoice_product) {
            var total = parseFloat(invoice_product.Qty) * parseFloat(invoice_product.UnitCost);
            var sub=0-invoice_product.Tcost;
            this.calculateTotal(sub);
            if (!isNaN(total)) {
                invoice_product.Tcost = total.toFixed(2);
            }
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
          var i,j;
              Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure with the following details of your received purchase?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
              }).then((result) => {
                if (result.value) {
                   for(i=0;i<=this.po_items.length-1;i++) {console.log(i);
                     for(j=0;j<=this.po_items2.length-1;j++) {console.log(j);
                    if(this.po_items[i]['Icode']==this.po_items2[j]['Icode']){
                      
                     if(this.po_items[i]['Qty']!=this.po_items2[j]['Qty']){
                      // alert('items are lesthan expected cant be save!!')

                        Swal.fire({
                          title: 'Oops!',
                          text:'items are less than expected, can`t be save',
                          icon: 'warning',
                          showCancelButton: true,
                          showConfirmButton: false 
                        })
                       
                       return 0;
                     }

                     else{

                     }
              
              }}}
             axios.post('/api/SaveReceived', {
              po_items:this.po_items, 
              PO_total:this.PO_total,
              PO:this.po,
              
              })
            .then(()=>{
               this.clearData();
            })
            .catch((error)=>{
                this.errors=error.response.data.errors;

              Swal.fire({
              title: 'Error',
              icon:'danger',
              text: error.response.data.errors,
              showCancelButton: false,
              showConfirmButton: false 
            })
                
            })
  
            Swal.fire({
              title: 'PO Received is placed Successfully',
              icon: 'success',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
            })

          }else if (result.dismiss === Swal.DismissReason.cancel) {
          //console.log('Back to Create PORecieve');
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
                      //this.calculateTotal(this.po_items2[i]['Tcost']);
                  }

                  //this.po_items=this.po_items2;
                  
                  //this.Load_idescription();
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
                  if(this.po_details[0]['Status']=="Open" || this.po_details[0]['Status']=="Canceled" || this.po_details[0]['Status']=="Done"){
                    //alert("not approved PO");
                    var a=this.po_details[0]['Status'] + " P.O. is not accessible";
                    
                    Swal.fire({
                      
                      title: a,
                      icon: 'info',
                      showCancelButton: true,
                      showConfirmButton: false 
                    })
                    this.clearData()
                    }
                  
                  else{
                  this.loadingMethod();
                  }
              }
          )
          .catch((error)=>{
                this.errors=error.response.data.errors;
            })
        },

        loadingMethod(){
                  this.po = this.po_details[0]['PO'];
                  //this.PO_total = this.po_details[0]['Total_Amount'];
                  this.Vendor_code = this.po_details[0]['Vendor'];
                  this.Customer_code = this.po_details[0]['Ship_to'];
                  this.load_Selected_customer(this.Customer_code);
                  this.load_Selected_vendor(this.Vendor_code);
        },

        clearData(){
          Object.assign(this.$data, this.$options.data.apply(this));
               this.load_vendor();
               this.load_customer();
               this.load_item();
               
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

/**try for input table
.in { color: blue;}
.in input {display: block; padding: 0; margin: 0; border: 0; width: 100%;}
.in td {margin: 0; padding: 0;}*/
</style>