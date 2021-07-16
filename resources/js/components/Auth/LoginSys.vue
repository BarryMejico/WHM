<template>
    <div>
        <br>
        <br>
        <br>
        <b-row>
            <b-col></b-col>
            <b-col sm="10" md="4" lg="4" align="center" style="border-radius:15px;box-shadow:13px 15px 37px grey;padding:60px;font-family:Verdana;background: rgb(238,238,238);
background: linear-gradient(24deg, rgba(238,238,238,1) 2%, rgba(255,255,255,1) 50%);">
                <div class="container">

                    <!-- #C69C6D -->

                <h3 class="text-muted" style="letter-spacing: 3px;"><b>Login</b></h3>
                <hr>

                <br>
                <br>
                <br>

                <!-- <b-form>
                    <b-form-group label="Email" label-for="email">
                        <b-form-input id="email" v-model="log.email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" required autocomplete="email" autofocus></b-form-input>
                    </b-form-group> 
                     <b-form-group label="Password" label-for="password">
                        <b-form-input id="password" v-model="log.email" type="email" class="form-control @error('email') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password"></b-form-input>
                    </b-form-group> 
                    <br>
                    <b-btn @click.prevent="login" action="" variant="secondary" size="lg">Submit</b-btn> 
                </b-form> -->

        
                    <form>
                        <div class="input-group-lg row" style="margin-bottom:10px;">
                            <!-- <label for="email"  class="col-md-4 col-form-label text-md-right">E-Mail Address</label> -->
                            <input id="email" v-model="log.email" type="email" class="form-control @error('email') is-invalid @enderror input-lg" name="email" placeholder="Email Address" required autocomplete="email" autofocus> 
                        </div>
                        <div class="input-group-lg row">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">Password</label> -->
                                <input id="password" v-model="log.password" type="password" class="form-control @error('password') is-invalid @enderror input-lg" name="password" placeholder="Password" required autocomplete="current-password">  
                        </div>
                        <br>
                        <div class="input-group-lg row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label text-muted" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                        </div>
                        <br>
                        <b-btn @click.prevent="login" action="" variant="secondary" size="lg"> Submit</b-btn>     
                    </form>
                        <message-box :message="message"></message-box>
                </div>
            </b-col>
        <b-col></b-col>
        </b-row>

</div>
</template>
<script>
import messageBox from '../Modals/messageBox.vue';
import Swal from 'sweetalert2'

export default {
  components: { messageBox },
    data() {
      return{
      log:{
        email:'',
        password:'',
      },
      errors:[],
      message:{
          visibility:false,
          head:'',
          insdide:'',
          errors:{},
      },
    }},

    methods:{
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/api/login', this.log)
        .then(()=>{
                this.$router.push({name:"Dashboard"});
                setTimeout(() => location.reload(), 500);

                Swal.fire({
                title: 'Login Successfully',
                icon: 'success',
                timer:2000,
                showCancelButton: false,
                showConfirmButton:false

            })
             })
        .catch((error)=>{
                this.message.errors=error.response.data;
                this.message.insdide="Please check these errors before proceeding!";
                this.message.head="Error!";
                this.message.visibility=true;
                console.log(this.errors);

                Swal.fire({
                title: 'Oops!',
                text: this.message.errors.message + ' ' + this.message.insdide,
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton:true
            
              })
            })
            


   
        })}
    }
}
</script>
<style scoped>

</style>