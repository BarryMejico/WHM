<template>
    <div class="container">
        <div class="row" >
          <div class="col-md-12">
                <div class="jumbotron" style="background-color:white; ">
                  <h1 class="display-4 text-muted"><b-icon icon="tag" font-scale="1"></b-icon>Sales Invoice: <b>List</b></h1>
                  <MenuList></MenuList>
                </div>
          </div>
        </div>

         <div class="row">
          <div class="col"></div>
          <div class="col-md-2">
            <toExcel :array1 = this.POs.data></toExcel>
          </div>
        </div>
        <br>


        <div class="row">
            <div class="col-lg-12">
                <table class="table" style="width:100%;">
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
                  <tr v-for="(po_item, k) in POs.data" :key="k">      
                    <th scope="row">{{k}}</th>
                    <td>{{po_item.invoice}}</td>
                    <td>{{po_item.Customer}}</td>
                    <td>{{po_item.Total_Amount| numeral('0,0')}}</td>
                    <td>{{po_item.Status}}</td>
                    <td>
                      <button class="btn-sm">
                        <router-link :to="{ name:'invoice', params:{PO_Load: po_item.invoice }}">
                          Invoice
                        </router-link>
                      </button>
                      <button @click.prevent="approve(po_item.invoice,po_item.Status)" class="btn-sm">Approved</button>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
        <div class="row">
          <ul class="pagination justify-content-end">
                  <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="prepAGE()">Previous</a></li>
                  <ul class="pagination justify-content-end" v-for="(pages, page) in POs.last_page" :key=page>
                  <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="changepAGE(pages)">{{pages}}</a></li>
                  </ul>
                  <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="nextpAGE()">Next</a></li>
              </ul>  
        </div>
      </div>
</template>

<script>
import MenuList from '../Sales/MainInvoice'
import CreatePO from '../Sales/invoice'
import Receiving from '../Inventory/Receiving'

import toExcel from '../../component/toExcel.vue';

export default {
    components: {
     MenuList,
     CreatePO,
    Receiving,
    toExcel
        
    },

    data() {
      return{
             POs:[],
             pass:true,
             ItemStatus:false,
            
    }},

    mounted(){
        this.loadpos();
    },

    props: {
    userId:String,
    },

    methods:{
//pagination

      changepAGE(page){
        axios.get('/api/LoadInvoive?page='+page)
        .then((res)=>{
          this.POs=res.data;
          })
          .catch((errors)=>{
          })
      },
     prepAGE(){
        axios.get(this.POs.first_page_url)
        .then((res)=>{
          this.POs=res.data;
          })
          .catch((errors)=>{
          })
      },
      nextpAGE(){
        axios.get(this.POs.next_page_url)
        .then((res)=>{
          this.POs=res.data;
          })
          .catch((errors)=>{
          })
      },
//end pagination


      loadpos:function(){
          axios.get('/api/LoadInvoive')
          .then(
              (response)=>{
                  this.POs=response.data;
              }
          )
          .catch()
},

checkQty(product,i,l,invoice){
  var Item;
          this.ItemStatus=true;
          var pers=100;
              i=i+1;
              pers=(i/l)*100;

if (pers==100){
                if(this.ItemStatus){
                       this.appInvoice(invoice);
                }
                else{
                alert("Qty is greater than available!")
              }
}   
else{
          axios.get('/api/getitem',{params:{Code:product['Icode']}})
          .then(
            (res)=>{
              Item=res.data;
              if(parseFloat(Item[0]['Qty'])>=parseFloat(product['Qty']) ){
                //walng gagawin
              }
              else{
                console.log(product['Qty']);
                console.log(Item[0]['Qty']);
                this.ItemStatus= false;
                }
            })
          .catch(

            (err)=>{
                 
            }
          )
}
        
        },



        appInvoice(invoice){
                    axios.post('/api/ApprovedInvoice',{params:{invoice:invoice}})
                      .then(
                       this.loadpos()
                      )
                      .catch()
        },

approve(invoice,status){
if (status=="Open"){
  var inVoiceDetails;
  axios.get('/api/GetInvoice',{params:{invoice:invoice}})
  .then(
    (res)=>{
      inVoiceDetails=res.data;
       var i;
      for(i=0;i<=inVoiceDetails.length-1;i++){
        this.checkQty(inVoiceDetails[i],i,inVoiceDetails.length,invoice);
        
      }
  
    }
  )

  }
          else{
            alert("Already approved!!")
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
.btn-sm{
  margin:3px;
} 

</style>