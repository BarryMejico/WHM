<template>
    <div class="container">

      <div class="row" >
        <div class="col-md-12">
          <div class="jumbotron" style="background-color:white; ">
            <h1 class="display-4 text-muted"><b-icon icon="cart-x-fill" font-scale="1"></b-icon>Purchase Order: <b>Stocks</b></h1>
            <MenuList></MenuList>
          </div>
        </div>
      </div>

       <div class="row">
          <div class="col"></div>
          <div class="col-md-2">
            <toExcel :array1 = this.stocks></toExcel>
          </div>
        </div>
        <br>

      <div class='row'>
          <div class="col-lg-12">
            <table class="table" style="width:100%;">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Code</th>
                  <th scope="col">Description</th>
                  <th scope="col">Unit</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Incoming</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, k) in stocks" :key="k">      
                  <th scope="row">{{k}}</th>
                  <td>{{item.Icode}}</td>
                  <td>{{item.idescription}}</td>
                  <td>{{item.iunit}}</td>
                  <td>{{item.Qty}}</td>
                  <!--<td>
                    <button class="btn-sm">
                  <router-link :to="{ name:'PO', params:{PO_Load: po_item.PO }}">
                      Purchase Order
                    </router-link>
                    </button><button class="btn-sm"><router-link :to="{ name:'Receiving', params:{PO_Load: po_item.PO }}">
                      Receiving
                      </router-link></button></td>-->
                </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</template>
<script>

import MenuList from '../MainPO';
import toExcel from '../../component/toExcel';

export default {
  components:{
     MenuList,
     toExcel
  },
    data(){
        return{
            stocks:[{
                idescription:'',
            }],
            //-----for loading items
            items:[],
        }
    },
    
    beforeMount(){
        this.load_data();
    },

    beforeUpdate(){
        this.Load_idescription();
    },

    mounted(){
        
    },

    methods:{
        Load_stocks(){
            axios.get('/api/stocks')
            .then((res)=>{
                this.stocks=res.data;
            })
        },

        Load_idescription(){
          var i,j;
          
                  for (i=0; i < this.stocks.length; i++){   
                    for (j=0; j < this.items.length; j++){
                      if (this.stocks[i]['Icode']===this.items[j]['Code']){
                        this.stocks[i]['idescription']=this.items[j]['Name'];  
                        this.stocks[i]['iunit']=this.items[j]['Unit']; 
                 }}}
        
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

</style>