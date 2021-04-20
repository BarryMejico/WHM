<template>
<div class="container">

    <div>
<div>
  <b-button v-b-toggle.collapse-1 variant="primary" style="width:30%;"><b-icon icon="gear-wide-connected" font-scale="2"></b-icon>
  {{notif.length}}</b-button>
  <b-collapse id="collapse-1" class="mt-2">
    <b-card v-for="(noti,k) in notif" :key="k">
        <b-card title="Company Invite" style="width:30%;">
                <b-card-header style="background-color:white;">
                    <i>{{noti.name}}</i> Invites you to join <i>{{noti.CompanyName}}</i>.<br>
                </b-card-header>
                <b-card-body>
                    <button @click.prevent="accept" style="margin-bottom:10px;">Accept</button>
                    <button class="alert">Decline</button>
                </b-card-body>
            </b-card>
    </b-card>
  </b-collapse>
</div>
</div>
</div>
</template>

<script>

export default {
    data(){
        return{
         notif:null,
        }
    },

    mounted(){
        this.getnotif()
    },

    methods:{
accept(){
    console.log("accept")
    axios.post('/api/setCompany',{CoCode:this.notif[0]['CoCode']})
            .then(()=>{
                     axios.post('/api/accepted',{id:this.notif[0]['id']})
            .then(()=>{
                    this.getnotif()
            })
            })
},

         getnotif(){
             axios('/api/getNotif')
             .then((res)=>{
                 this.notif=res.data;
                 console.log(this.notif[0])
             })
         },
    }
 
}
</script>

<style scoped>
.temp{
    background-color:#eee ;
    width:20%;
    border-radius: 5px;
    color:black;
}


</style>