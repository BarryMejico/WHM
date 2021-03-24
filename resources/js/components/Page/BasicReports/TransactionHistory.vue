<template>
<div class="container">
  <h1>Transaction History</h1>
  <hr>
  <br>
  <br>
    <div class="row">
      <div class="col"></div>
      <div class="col-lg-12">
<h3>Transaction Filter</h3>
          <label for="datefrom">date from:</label>
          <input type="date" id="datefrom" name="datefrom" v-model="datefrom">
          
         <label for="dateto">date to:</label>
          <input type="date" id="dateto" name="dateto"  v-model="dateto">
          <hr>
          <!--Status-->        
          <div class="dropdown">
              <label>Status</label> 
          <button class="btn btn-default dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
          <span class="caret">{{Status}}</span>
          </button>
          <ul class="dropdown-menu">
            <li><a @click="changeStatus('Open')" class="my_btn btn">Open</a></li>
            <li><a @click="changeStatus('Approved')" class="success btn">Approved</a></li>
            <li><a @click="changeStatus('Canceled')" class="btn">Canceled</a></li>
            <li><a @click="changeStatus('All')" class="btn">All</a></li>
          </ul>
          </div>
          <!--End Status--><hr>


          <div class="col-lg-6">
              <customer-modal id="CusModal" @SelectedCustomer="Selected_cus" :disabled="disabled"></customer-modal>
                <div class="form-inline">    
                  <div>
                    <b>Name: </b><label class="text-muted"><i>{{Customer}}</i></label><br>
                    <b>Address: </b><label class="text-muted"><i>{{add_Cus}}</i></label><br>
                  </div>
                </div>
              </div>
          <hr>
          <div class="col-lg-12">
          <devices-modal @SelectedDevice="Selected_Device" v-bind:selectedCus="Ccode" :disabled="disabled"/><br>
          <b>Device: </b><label class="text-muted"><i>{{Device}}</i></label><br>
          </div>
          <hr>
          <label>Repaired By:{{RepairedBy}} <employee-modal @SelectedEmployee="Selected_employee" /></label><br>
          <label>Model <i>type text</i></label><br>
          <label>Device Status 
            </label>
             <select v-model="Status">
                      <option>Claimed</option>
                      <option>RTO</option>
                      <option>Open</option>
                      
                    </select>
            <br>
          <button @click.prevent="Search()">Load</button><br>
          <button class="btn-danger" @click.prevent="">Clear Filters</button><br>
          
  <table class="table table-responsive">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Customer</th>
      <th scope="col">Amount</th>
      <th scope="col">Deposit</th>
      <th scope="col">Balance</th>
      <th scope="col">Created by</th>
      <th scope="col">Status</th>


      <th scope="col">
         <thead style="max-width:100px">
        <tr>
            <th scope="col">Model</th>
            <th scope="col">Description</th>
            <th scope="col">Repaired By</th>
            <th scope="col">Remarks</th>
            <th scope="col">date update</th>
        </tr>
        </thead>
      </th>
      
    </tr>
  </thead>
  <tbody>
    <tr v-for="(item, k) in stocks" :key="k">      
      <th scope="row">{{k}}</th>
      <td><a href="#load">{{item.updated_at}}</a></td>
      <td>{{item.Customer}}</td>
      <td>{{item.Total_Amount| numeral('0,0')}}</td>
      <td><i>{{item.payment| numeral('0,0')}}</i></td>
      <td><i>Balance</i></td>
      <td>{{item.name}}</td>
      <td>{{item.Status}}</td>
      <td class="subTable2">
        <table>
          <thead>
        <tr >
            <th class="subTable" scope="col">Description</th>
            <th class="subTable" scope="col">Repaired By</th>
            <th class="subTable" scope="col">Remarks</th>
            <th class="subTable" scope="col">date update</th>
        </tr>
        </thead>
        <tr v-for="(details,d) in item.items" :key="d">
         <td>{{ item.items[d][0].Icode }}</td>
         <td>{{ item.items[d][0].description }}</td>
         <td><i>{{item.items[d][0].Repairedby}}</i></td>
          <td>{{item.items[d][0].Remarks}}</td>
         <td>{{item.items[d][0].updated_at}}</td>
        </tr>
       
        </table>
      </td>
      
       
    </tr>
     <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Total</td>
          <td>Total of payment</td>
          <td>Total of Balance</td>
          </tr>
  </tbody>
</table>
      </div>
       <div class="col"></div>
    </div>
</div>
</template>
<script>
import CustomerModal from '../../Modals/CustomerModal.vue';
import DevicesModal from '../../Modals/DevicesModal.vue';
import EmployeeModal from '../../Modals/EmployeeModal.vue';

export default {
    components: {
        CustomerModal,
        DevicesModal,
        EmployeeModal,
    },

    data(){
        return{
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
            Createdby:'',
            CreatedbyCode:'',
    
            Status:'',
            Customer:'',
            add_Cus:'',
            Ccode:'',
            Device:'',
            Devcode:'',
            DevUnit:'',
            RepairedBy:'',
            RepairedByCode:'',
            Status:'',
            
        }
    },
    
    beforeMount(){
        //this.load_data();
    },

    beforeUpdate(){
        //this.Load_idescription();
    },

    mounted(){
      var FDate=new Date();
      var month =FDate.getMonth()+1;
      var newMonth
      if (month>10){
        newMonth=month.toString();}
      else{newMonth="0" + month.toString();}

      var newDate= FDate.getFullYear().toString() +"-"+ newMonth + "-"+ "01"
      var FromDate = new Date(newDate).toISOString().substr(0, 10);
      this.datefrom=FromDate;

    },

    methods:{
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
              }})
            .then((response)=>{
                console.log(response.data);
               this.stocks=response.data;
               this.PresentationLoop();
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
                                Status:this.stocks[i].Status,
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
<style>
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
</style>