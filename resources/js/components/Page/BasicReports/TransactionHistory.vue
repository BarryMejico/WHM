<template>
<div>
      <div class="container">

        <div class="row" >
            <div class="col-md-12">
                  <div class="jumbotron" style="background-color:white; ">
                    <h1 class="display-4 text-muted"><b-icon icon="clock-history" font-scale="1"></b-icon> JOb Order: <b>Transaction History</b></h1>
                    <MenuList></MenuList>
                  </div>
            </div>
        </div>
     
        
          <div class="row">
            <div class="col-md-2">
              <b-form-group label="From" label-for="datefrom">
                <input type="date" id="datefrom" @change="DatDiff()" name="datefrom" v-model="datefrom">
              </b-form-group>
            </div>
            <div class="col-md-2">
              <b-form-group label="To" label-for="dateto">
                <input type="date" id="dateto" name="dateto" @change="DatDiff()" v-model="dateto">
              </b-form-group>
            </div>
            <div class="col-md-2">
               <!--Status-->        
            <div class="dropdown">
               <b-form-group label="Status" label-for="x">
                 <button class="btn btn-secondary dropdown-toggle btn-sm" id="x" type="button" data-toggle="dropdown">
                    <span class="caret">{{Status}}</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a @click="changeStatus('Open')" class="my_btn btn">Open</a></li>
                  <li><a @click="changeStatus('Approved')" class="success btn">Approved</a></li>
                  <li><a @click="changeStatus('Canceled')" class="btn">Canceled</a></li>
                  <li><a @click="changeStatus('All')" class="btn">All</a></li>
                </ul>
              </b-form-group>
            </div>
            <!--End Status-->
            </div>
            <div class="col"></div>
          </div>
          <hr>
          <br>

          <div class="row">
            <div class="col">
              <customer-modal id="CusModal" @SelectedCustomer="Selected_cus" :disabled="disabled"/><br>
                <div class="form-inline">    
                  <div>
                    <b class="text-muted">Name:</b>
                    <h4>{{Customer}}</h4>
                    <br>
                    <b class="text-muted">Address: </b>
                    <h4>{{add_Cus}}</h4>
                    <br>
                  </div>
                </div>
              </div>
              <div class="col">
                <devices-modal @SelectedDevice="Selected_Device" v-bind:selectedCus="Ccode" :disabled="disabled"/><br>
                <b class="text-muted">Device: </b>
                <br>
                <h3>{{Device}}</h3>
                <br>
              </div>
              <div class="col"></div>
          </div>

          <div class="row">
            <div class="col"><small class="text-muted">Repaired By</small></div>
            <div class="col-md-1"></div>
            <div class="col"><small class="text-muted">Model</small></div>
            <div class="col"><small class="text-muted">Device Name</small></div>
            <div class="col"><small class="text-muted">Device Status</small> </div>
          </div>
          <div class="row">
            <div class="col"><input type="text" :value="RepairedBy" disabled/></div>
            <div class="col-md-1" style="padding:15px 0px 0px 0px;"><employee-modal @SelectedEmployee="Selected_employee" /></div>
            <div class="col"><input type="text" v-model="model"/></div>
            <div class="col"><input type="text" v-model="DeviceName"/></div>
            <div class="col">
              <b-select v-model="DeviceStatus" style="margin-top:7px;">
                <option>Claimed</option>
                <option>RTO</option>
                <option>Open</option>
              </b-select> 
            </div>
          </div>
            
  
              <br>
              <br>
              <br>

              <div class="row">
                <div class="col">
                  <button class="btn btn-outline-info" @click.prevent="Search()">Load</button>
                </div>
                <div class="col">
                   <button class="btn btn-outline-secondary" @click.prevent="reloadthis()">Clear Filters</button>
                </div>
                <div class="col">
                  <toExcel :array1 = this.stocks></toExcel>
                </div>
              </div>
            
          <br>
      </div>
     
       <div class="container-fluid">
         <table class="table table-responsive" id="mytable" style="width:100%;height:700px;">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date</th>
              <th scope="col">Customer</th>
              <th scope="col">Amount</th>
              <th scope="col">Payment</th>
              <th scope="col">Balance</th>
              <th scope="col">Created by</th>
              <th scope="col">Status</th>


              <th scope="col" style="text-align:center;">
               Device Information
              </th>
              
            </tr>
          </thead>
          <tbody>
            
            <tr v-for="(item, k) in stocks" :key="k">   
              <th scope="row"><br><br>{{k}}</th>
              <td><a href="#load"><br><br>{{item.updated_at}}</a></td>
              <td>
                <router-link :to="{ name:'JobOrder', params:{PO_Load: item.invoice}}">
                  <br><br>{{item.Customer}}
                </router-link>
              </td>
              <td><br><br>{{item.Total_Amount| numeral('0,0')}}</td>
              <td><br><br>{{item.payment| numeral('0,0')}}</td>
              <td><br><br><i>{{item.Balance| numeral('0,0')}}</i></td>
              <td><br><br>{{item.name}}</td>
              <td><br><br>{{item.Status}}</td>
              <td class="subTable2">
                <table id="mytable2" style="width:100%;">
                <thead>
                    <tr>
                      <th scope="col"><small><b>Model</b></small></th>
                      <th scope="col"><small><b>Description</b></small></th>
                      <th scope="col"><small><b>Repaired By</b></small></th>
                      <th scope="col"><small><b>Remarks</b></small></th>
                      <th scope="col"><small><b>Status</b></small></th>
                      <th scope="col"><small><b>Date Update</b></small></th>
                    </tr>
                </thead>
            
                <tr v-for="(details,d) in item.items" :key="d">
                  <td>{{item.items[d][0].Icode }}</td>
                  <td>{{item.items[d][0].description }}</td>
                  <td>{{item.items[d][0].Repairedby}}</td>
                  <td>{{item.items[d][0].Remarks}}</td>
                  <td>{{item.items[d][0].Status}}</td>
                  <td>{{item.items[d][0].updated_at}}</td>
                </tr>
                </table>
              </td>
            </tr>


          <tr>
          <td></td>
          <td></td>
          <td></td>
          <td><b>Total</b></td>
          <td><b>{{GTPayment| numeral('0,0')}}</b></td>
          <td><b>{{GTBalance| numeral('0,0')}}</b></td>
          
          </tr>
        </tbody>
      </table>

   
    </div>

</div>
</template>

<script>


import MenuList from '../../Page/Sales/MainInvoice2';
import CustomerModal from '../../Modals/CustomerModal.vue';
import DevicesModal from '../../Modals/DevicesModal.vue';
import EmployeeModal from '../../Modals/EmployeeModal.vue';

import toExcel from '../../component/toExcel.vue'

export default {
    components: {
        MenuList,
        CustomerModal,
        DevicesModal,
        EmployeeModal,
        toExcel
    },

    data(){
        return{
          GTBalance:0,
          GTPayment:0,
              stocks:[{
                idescription:'',
                 items:{},
            }],
             stocks2:[{
                idescription:'',
                invoice:'',
                items:{},
            }],
             stocks3:[{
                idescription:'',
            }],
            //-----for loading items
            items:[],
            //disable
            disabled:'',
            //filtration
            datefrom:new Date().toISOString().substr(0, 10),
            dateto:new Date().toISOString().substr(0, 10),
            Createdby:null,
            CreatedbyCode:null,
    
            Status:null,
            Customer:null,
            add_Cus:null,
            Ccode:null,
            Device:null,
            Devcode:null,
            DevUnit:null,
            RepairedBy:null,
            RepairedByCode:null,
            DeviceStatus:null,
            model:null,
            DeviceName:null,
            DifDay:0,
            
        }
    },
    
    beforeMount(){
        //this.load_data();
    },

    beforeUpdate(){
        //this.Load_idescription();
    },

    mounted(){
     this.firstDate()
      
    },

    methods:{

      CalculateGT(){
          this.GTBalance=0;
          this.GTPayment=0;
          var i;
          for(i=0;i<=this.stocks.length-1;i++){
             this.GTBalance= parseFloat(this.stocks[i]['Balance'])+this.GTBalance;
             this.GTPayment=parseFloat(this.stocks[i]['payment'])+this.GTPayment;
          }
      },


      DatDiff(){
        var D1=new Date(this.dateto)
        var D2=new Date(this.datefrom)
        this.DifDay=Math.floor((D1 - D2) / (1000*60*60*24))
        if(this.DifDay<0){
          this.firstDate()
          alert("Date Should not greater than from date!");
        }

      },

      firstDate(){
 var FDate=new Date();
      var month =FDate.getMonth()+1;
      var newMonth
      if (month>10){
        newMonth=month.toString();}
      else{newMonth="0" + month.toString();}

      var newDate= FDate.getFullYear().toString() +"-"+ newMonth + "-"+ "01"
      var FromDate = new Date(newDate).toISOString().substr(0, 10);
      this.datefrom=FromDate;
      this.dateto=new Date().toISOString().substr(0, 10);
      },

      reloadthis(){
        location.reload()
      },
      Selected_employee(event){
        console.log(event);
          this.RepairedBy=event['Employee'];
          this.RepairedByCode=event['Ecode'];
      },

      Selected_Device(event){
         this.Devcode=event['Code'];
         this.Device=event['Name'];
         this.DevUnit=event['Unit'];
         },

      Selected_cus(event){        
                this.add_Cus=event['Address'];
                this.Customer=event['Customer'];
                //this.Customer_code=event['id'];
                this.Ccode=event['Ccode'];
      },

        Search(){     
          this.stocks=[];
            axios.get('/api/searchtramsaction',{params:{
              datefrom:this.datefrom,
              dateto:this.dateto,
              Createdby:this.CreatedbyCode,
              Repairedby:this.Repairedby,
              Status:this.Status,
              Ccode:this.Ccode,
              Icode:this.Devcode,
              RepairedBy:this.RepairedByCode,
              DeviceStatus:this.DeviceStatus,
              model:this.model,
              DeviceName:this.DeviceName,
              datefrom:this.datefrom,
              DifDay:this.DifDay,
              }})
            .then((response)=>{
                console.log(response.data);
               this.stocks=response.data;
               this.PresentationLoop();
               this.CalculateGT();
            })
            .catch((err)=>{
                console.log(err)
            })

            
        },

        PresentationLoop(){
          var i,j,index;
          this.stocks2=[];
          //this.stocks2[0]=this.stocks[0]
          var meron=false;
          for(i=0;i<=this.stocks.length-1;i++){
            
                for(j=0;j<=this.stocks2.length-1;j++){
                  if(this.stocks2[j].invoice==this.stocks[i].invoice){
                      meron=true;
                      index=j;
                     }
                }

                  if (meron){
                      meron=false;
                      
                  }
                   else{         
                     this.stocks2.push(this.stocks[i]); 
                  }
                  
                  }

                
                      for(j=0;j<=this.stocks2.length-1;j++){
                         var laman=[];
                        for(i=0;i<=this.stocks.length-1;i++){
                           if(this.stocks2[j].invoice==this.stocks[i].invoice){
                               laman.push([{
                                Icode:this.stocks[i].DeciveName + this.stocks[i].Model,
                                Remarks:this.stocks[i].Remarks,
                                ligaw:this.stocks[i].invoice,
                                Repairedby:this.stocks[i].Employee,
                                UnitCost:this.stocks[i].UnitCost,
                                description:this.stocks[i].description,
                                Status:this.stocks[i].DeviceStatus,
                                updated_at:this.stocks[i].updated_at,
                      }])
                              } }

                              this.stocks2[j].items=laman;
                          }


                  this.stocks=this.stocks2
                  console.log(this.stocks)
        },

        changeStatus(stat){
          if (stat=="All"){
            this.Status=""
          }
          else            {
              this.Status=stat;
              }
        },

        Load_stocks(){
            axios.get('/api/Saleshistory',{params:{Status:"Approved"}})
            .then((res)=>{
                this.stocks=res.data;
                this.PresentationLoop();
            })
        },

        Load_idescription(){
          var i,j;
          
                  for (i=0; i < this.stocks.length; i++){   
                 var D=this.stocks[i]['updated_at'];
                 var myDate = D.split(" ");
                 this.stocks[i]['updated_at']=myDate[0];
                 }
        
        },

        load_item(){
        axios.get('/api/LoadItems')
        .then(
          (response)=>{
            this.items=response.data;       
          }
        )
      },

      load_data(){
          this.load_item();
          this.Load_stocks();
      },
    

    }
}
</script> 
<style scoped>
.subTable {
visibility: hidden !important;
padding-top: 0 !important;
padding-bottom: 0 !important;
height:3px !important;
width:inherit;
}

.subTable2{
/* visibility: hidden !important; */
padding-top: 0 !important;
padding-bottom: 0 !important;
height:3px !important;
width:inherit;

}
#x{
  height: 30px;
}
.btn{
  border-radius:5px;
}
/* #table2{
  border-top-left-radius:0px;
  border-top-right-radius:20px;
  border-bottom-left-radius:0px;
  border-bottom-right-radius:0px;

} */

small{
  font-weight: bold;
}
tr:hover{
  background-color: #eee;
  cursor:pointer;
}
table thead tr th {
  position: sticky;
  position: -webkit-sticky;
  top: 0;
  z-index: 2;
} 
</style>