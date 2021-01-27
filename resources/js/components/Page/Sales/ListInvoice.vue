<template>
    <div>
    <div class="container">
    <div class="row">
        <div class="col-lg-2">
        <MenuList></MenuList>
        </div>
<div class="col-lg-10">
<div class="row">
   <table class="table table-responsive">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Invoice</th>
      <th scope="col">Customer</th>
      <th scope="col">Amount</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(po_item, k) in POs" :key="k">      
      <th scope="row">{{k}}</th>
      <td>{{po_item.invoice}}</td>
      <td>{{po_item.Ccode}}</td>
      <td>{{po_item.Total_Amount}}</td>
      <td>{{po_item.Status}}</td>
      <td>
        <button class="btn-sm">
        <router-link :to="{ name:'invoice', params:{PO_Load: po_item.invoice }}">
          Invoice
        </router-link>
        </button>

        <button @click.prevent="approve(po_item.invoice,po_item.Status)" class="btn-sm">
        
          Approved
        
        </button>
        
        
        </td>
    </tr>
  </tbody>
</table>
    </div>
    </div>
</div>
</div>

</div>

</template>

<script>
import MenuList from '../Sales/MainInvoice'
import CreatePO from '../Sales/invoice'
import Receiving from '../Inventory/Receiving'

export default {
    components: {
     MenuList,
     CreatePO,
        Receiving
    },

    data() {
      return{
             POs:[]
    }},

    mounted(){
        this.loadpos();
    },

    props: {
    userId:String,
    },

    methods:{
      loadpos:function(){
          axios.get('/api/LoadInvoive')
          .then(
              (response)=>{
                  this.POs=response.data;
              }
          )
          .catch()
},

approve(invoice,status){
if (status=="Open"){
axios.post('/api/ApprovedInvoice',{params:{invoice:invoice}})
          .then(
                this.loadpos()
          )
          .catch()}
          else{
            console.log("Already approved!!")
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
</style>