<template>
    <div>
        <br>
        <br>
        <br>
        <b-row>
            <b-col></b-col>
            <b-col>
                  <b-row>
                    <b-col>
                         <b-card title="Permission Details">
                             <br>
                             <br>
                            <b-row>
                                <b-col>
                                    <small>Perm. Code</small><br>
                                    <b-form-input></b-form-input>
                                </b-col>
                                <b-col>
                                     <small>ID</small><br>
                                    <b-form-input id="inline-form-input-username"></b-form-input>
                                </b-col>
                            </b-row>
                            <br>
                            <b-button @click="add()" variant="success" style="width:100%;">Submit</b-button>
                        </b-card>
                    </b-col>
                    
                </b-row>
            </b-col>
            <b-col></b-col>
        </b-row>
       
    </div>
</template>

<script>
import Swal from 'sweetalert2'
export default{
    methods:{
        add(){
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you Sure to add this permission to this user?',
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
              }).then((result) => {
                if (result.value) {


              Swal.fire({
              title: 'Permission Added Successfully',
              icon: 'success',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
            })
            

          }else if (result.dismiss === Swal.DismissReason.cancel) {
                 Swal.fire({
              title: 'Permission Canceled',
              icon: 'warning',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
            })
          }
        })
        }
    }

}
</script>
<style scoped>


</style>

