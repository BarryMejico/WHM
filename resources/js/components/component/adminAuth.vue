<template>
    <div class="container">
         <div class="row" >
            <div class="col-md-12">
                  <div class="jumbotron" style="background-color:white; ">
                    <h1 class="display-4 text-muted"><b-icon icon="shield-lock-fill" font-scale="1"></b-icon> Admin: <b>Permissions</b></h1>
                  </div>
            </div>
        </div>
        <b-row>
            <b-col md="8">
                 <label>Permission Group</label>
                <b-form-select v-model="selected" :options="options"></b-form-select>
            </b-col>
            <b-col>
                <br>
                <b-btn variant="success">Load</b-btn>
                 <b-btn class="btns" v-b-modal.modal-Add variant="info">Add</b-btn>
            </b-col>
        </b-row>

        <b-modal id="modal-Add" title="Add" hide-footer centered>
            <b-input-group>
                <b-input placeholder="Enter Something"></b-input>
                <br><br>
                <b-btn class="btns" @click="add()" variant="success" style="width:100%;">Submit</b-btn>
            </b-input-group>
        </b-modal>
        <br>
        <br>
        <table class="table">
           <thead class="thead-dark">
               <th>Permission</th>
               <th>Description</th>
           </thead>
           <br>
           <tbody>
               <tr v-for="item in items" :key="item">
                   <td><input type="checkbox" /></td>
                   <td>{{item.des}}</td>
               </tr>
           </tbody>
        </table>

       
    </div>
</template>

<script>
import Swal from 'sweetalert2'
export default{
    data(){
        return{
        options: [
          { value: null, text: 'option 1' },
          { value: 'a', text: 'option 2' },
          { value: 'b', text: 'option 3' },
          { value: { C: '3PO' }, text: 'This is an option with object value' },
          { value: 'd', text: 'This one is disabled', disabled: true }
        ],
        items: [
          { des: 'Purchase Order' },
          { des: 'Job Order' },
          { des: 'Sales' },
          { des: 'Inventory' }
        ]

        }
    },
    methods:{
        add(){
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you Sure ********** ?',
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
              }).then((result) => {
                if (result.value) {


              Swal.fire({
              title: '******* Added Successfully',
              icon: 'success',
              timer:1500,
              showCancelButton: false,
              showConfirmButton: false 
            })
            

          }else if (result.dismiss === Swal.DismissReason.cancel) {
                 Swal.fire({
              title: '******* Canceled',
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
.btns{
    margin-top:10px;
}
table{
    width: 100%;
}
tr{
    padding:5px;
}
td{
    padding:20px;
}
th{
    padding:15px;
}
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}


</style>

