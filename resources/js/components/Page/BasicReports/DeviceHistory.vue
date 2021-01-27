<template>
    <div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Device History Report</div>

                <div class="card-body">
                    <input type="text" v-model="deviceCode">
                    <button @click.prevent="LoadHistory">load</button>
                    <table class="table table-responsive">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Created by</th>
      <th scope="col">Description</th>
      <th scope="col">Invoice Number</th>
      <th scope="col">Remarks</th>
      <th scope="col">Status</th>
      <th scope="col">Reviewed by</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(item, k) in stocks" :key="k">      
      <th scope="row">{{k}}</th>
      <td>{{item.created_at}}</td>
      <td>{{item.Created_by}}</td>
      <td>{{item.description}}</td>
      <td>{{item.invoice}}</td>
      <td>{{item.Remarks}}</td>
      <td>{{item.Status}}</td>
      <td>{{item.Reviewed_by}}</td>
    </tr>
  </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</template>
<script>
 export default {
     data(){
         return{
             stocks:[],
            deviceCode:'root-001',
            invo:[],
            inoDetails:[],
            root:"root-001",
         }
     },
     mounted(){
         this.LoadInvoice();
     },
     methods:{
         LoadHistory(){
             axios.get('/api/history',{params:{Icode:this.deviceCode}})
            .then((res)=>{
                this.inoDetails=res.data;
                this.LoadDescription();
            })

            

         },

         LoadDescription(){
             var i,j;
             this.stocks=[];
             for(i=0;i<=this.inoDetails.length-1;i++){
                for(j=0;j<=this.invo.length-1;j++){
                    if (this.inoDetails[i]['invoice']==this.invo[j]['invoice']){
                       
                       //console.log(this.inoDetails[i]['description']); 
                        //console.log(i);
                        //console.log("invo: " + this.invo[0]);
                        //console.log("inodetails: " + this.inoDetails[i]);
                        var D=this.invo[j]['created_at'];
                        var myDate = D.split("T");
                        console.log(myDate);

                        this.stocks.push({
                            created_at:myDate[0],
                            Created_by:this.invo[j]['Created_by'],
                            description:this.inoDetails[i]['description'],
                            invoice:this.inoDetails[i]['invoice'],
                            //Remarks
                            Status:this.invo[j]['Status'],
                             Reviewed_by:this.invo[j]['Reviewed_by'],
              })


             }}}
         },

         LoadInvoice(){
axios.get('/api/LoadInvoive')
          .then((res)=>{
              this.invo=res.data;
              
          });
         },
     }
 }
</script>