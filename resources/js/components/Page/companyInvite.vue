<template>
<div class="container">

  

  <b-button v-b-toggle.collapse-1 variant="outline-info" size="sm">
      <b v-if="notif.length < 1"> No </b> 
      <b v-else>{{notif.length}}</b> Invitation 
      <!-- <b-icon icon="gear-wide-connected" font-scale="1"></b-icon> -->
      </b-button>

  <b-collapse id="collapse-1" class="mt-2">
    <b-card v-for="(noti,k) in notif" :key="k" title="Company Invitation" align="center">
                    <br>
                    <br>
                    <i>{{noti.name}}</i> Invites you to join <b>{{noti.CompanyName}}</b>.
                    <br>
                    <hr>

               
                    <button @click.prevent="accept" style="margin-bottom:10px;">Accept</button>
                    <button class="alert">Decline</button>
                
            
    </b-card>
  </b-collapse>


</div>
</template>

<script>

export default {
    data(){
        return{
         notif:[],
         notifcount:0,
        }
    },

    mounted(){
        this.getnotif()
        this.notifcount=this.notif.length;
    },

    methods:{
accept(){
    
    axios.post('/api/setCompany',{CoCode:this.notif[0]['CoCode']})
            .then(()=>{
                     axios.post('/api/accepted',{id:this.notif[0]['id']})
                            .then(()=>{
                                this.getnotif()
                                
                                axios.post('/api/SaveInvitedEmployee',{params:{Name_:this.Name_}})
                            })
            })
},

         getnotif(){
             axios('/api/getNotif')
             .then((res)=>{
                 this.notif=res.data;
                
             })
         },
    }
 
}
</script>

<style scoped>


</style>