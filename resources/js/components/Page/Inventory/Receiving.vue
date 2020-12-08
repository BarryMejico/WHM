<template>
    <div>
    <div class="container">
    <div class="row">
        <div class="col-lg-2">
            <MenuList></MenuList>
            </div>
          <div class="col-lg-10">
<div class="row">
  <div class="col-xl-9">
<div class="form-inline">
      <label for="po">PO#:</label>                     
      <input class="form-control" v-model="po" id="po" type="text" required autocomplete="name" autofocus>
     
      <label for="mode">Mode:</label>                     
      <input id="mode" type="text" class="form-control" required autocomplete="name" autofocus>

       <div class="col-xl-5">
    <button href="#addVendorModal" data-toggle="modal" type="button" class="btn btn-secondary btn-sm">Vendor</button>
                    <div>
                    <b>Name:</b><label class="text-muted"><i>{{Vendor}}</i></label><br>
                    <b>Address:</b><label class="text-muted"><i>{{add_Ven}}</i></label><br>
                    </div>
  </div>
  <div class="col-xl-5">
    <button href="#addCustomerModal" data-toggle="modal" type="button" class="btn btn-secondary btn-sm">Ship to</button>
                    <div>
                   <b>Name: </b><label class="text-muted"><i>{{Customer}}</i></label><br>
                    <b>Address:</b><label class="text-muted"><i>{{add_Cus}}</i></label><br>
                    </div>
  </div>
    
</div>  
  </div>
    <div class="col-xl-3">        
            
            <button type="button" class="btn btn-info">Print</button>
            <items-modal @SelectedItems="Selected_Item"></items-modal>
    </div>
</div>
            
        <div class="sc">
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
      <td class="in"><div class="qty"><input v-model="po_item.Qty" min="1" type="number" @change="calculateLineTotal(po_item)"></div></td>
      <td class="in"><div class="qty"><input v-model="po_item.UnitCost"  @change="calculateLineTotal(po_item)"></div></td>
      <td>{{po_item.Tcost}} Php</td>
      <td><a class="link" @click="deleteRow(k, po_item)">Delete</a>/<a class="link">Recompute</a></td>
    </tr>
  </tbody>
</table>
<hr>
<div class="total">
  
<span><b>Total:</b> {{PO_total}} Php</span><br>
<hr>
<button type="button" class="btn btn-info" @click.prevent="saveform">Save</button>
<button type="button" class="btn danger btn-danger" @click.prevent="clearData">Clear ALL</button>
</div>
        </div>
        </div>
        </div>
    
    </div>
    <hr>
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
      }],
      //-----for loading items
        items:[],
    }
    }


export default {
  //prop:['PO_Load'],

    components: {
     MenuList,
        ItemsModal
    }, 

    data:function(){
      return int_data();
      }, 

    beforeMount(){
      this.clearData();
    },

    mounted(){
      var $POL = this.$route.params.PO_Load;      
      if(typeof this.$route.params.PO_Load === "undefined" ){
        console.log("PO Undefied")
      }else{
        //this.Load_PO();
        this.Load_Details();
      }
    },

    methods:{
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
            console.log("Item already Exist!!!")
        }
        else{
          
        this.po_items.push({
                Icode:code,
                idescription:Name,
                iunit:Unit,
                                  });
        }
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
          //console.log(codes);
            this.po_items.push({
                Icode:codes,
                idescription:'New Added Descriptopn',
                iunit:'ea',
            });
            this.closeModal()
        },

        deleteRow(index,invoice_product) {
            var idx = this.po_items.indexOf(invoice_product);
            var sub=0-invoice_product.Tcost;
            //console.log(idx, index);
            if (idx > -1) {
                this.po_items.splice(idx, 1);
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

        saveform(){
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
                  this.Selected_ven(this.po_details[0]['Vendor']);
                  this.Customer_code = this.po_details[0]['Ship_to'];
                   this.Selected_cus(this.po_details[0]['Ship_to']);
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
        }
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