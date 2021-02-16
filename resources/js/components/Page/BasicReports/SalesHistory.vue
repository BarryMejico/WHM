<template>
    <div>
         <table class="table table-responsive">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Invoice</th>
      <th scope="col">Amount</th>
      <th scope="col">Created by</th>
      <th scope="col">Incoming</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(item, k) in stocks" :key="k">      
      <th scope="row">{{k}}</th>
      <td>{{item.updated_at}}</td>
      <td>{{item.invoice}}</td>
      <td>{{item.Total_Amount}}</td>
      <td>{{item.Created_by}}</td>
      
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
</template>
<script>
export default {
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
            axios.get('/api/Saleshistory',{params:{Status:"Approved"}})
            .then((res)=>{
                this.stocks=res.data;
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