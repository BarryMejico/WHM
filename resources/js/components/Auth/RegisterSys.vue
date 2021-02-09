<template>
    <div class="container">
        
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registers</div>
                    
                <div class="card-body">
                                       
                        <div class="form-group row">
                                
                            <label class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input v-model="form.name" type="text" class="form-control" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input v-model="form.email" id="email" type="email" class="form-control" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input v-model="form.password" id="password" type="password" class="form-control"  required autocomplete="new-password">

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" name="password_confirmation" v-model="form.password_confirmation" type="password" class="form-control"  required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="saveform" class="btn btn-primary">
                                   Register
                                </button>
                            </div>
                        </div>
                   
                </div>
            </div>



        </div>
        <message-box :message="message"></message-box>
    </div>
</div>
</template>
<script>
import messageBox from '../Modals/messageBox.vue';

function int_data(){
    return{
form:{
        name:'',
        email:'',
        password:'',
        password_confirmation:''
      },
      
      message:{
          visibility:false,
          head:'',
          insdide:'',
          errors:{},
      },
    }
}

export default {
  components: { messageBox },
    data() {
      return int_data();
      },

    methods:{ 
        saveform(){
            axios.post('/api/registeraccount', this.form).then(()=>{
                console.log('Save');
                this.cleardata();
                this.message.head="Sucess!";
                this.message.insdide="Sucess!";
                this.message.visibility=true;
                
                
            }).catch((error)=>{
                this.message.errors=error.response.data;
                this.message.insdide="Please check these errors before proceeding!";
                this.message.head="Error!";
                this.message.visibility=true;
                console.log(this.errors);
            })
        },

        cleardata(){
                Object.assign(this.$data, this.$options.data.apply(this));
        },
    } 
}
</script>

<style>
.error-list{
    color: red;
}
</style>>