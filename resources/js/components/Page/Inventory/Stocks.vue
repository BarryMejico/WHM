<template>
    <div>
         <table class="table table-responsive">
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