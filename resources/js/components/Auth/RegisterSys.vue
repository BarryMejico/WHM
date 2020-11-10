<template>
    <div class="container">
        
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registers</div>
                    
                <div class="card-body">
                                       
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Name</label>
                            <span v-if="errors.name">{{errors.name[0]}}</span>
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
    </div>
</div>
</template>
<script>
export default {
    data() {
      return{
      form:{
        name:'',
        email:'',
        password:'',
        password_confirmation:''
      },
      errors:[]
    }},

    methods:{ 
        saveform(){
            axios.post('/api/registeraccount', this.form).then(()=>{
                console.log('Save');
            }).catch((error)=>{
                this.errors=error.response.data.errors;
            })
        }
    } 
}
</script>