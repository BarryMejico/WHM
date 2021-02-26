<template>
    <div>
        <h1> Products </h1>
        <hr>
        <div class="col-lg-2">
        <items-modal @SelectedItems="Selected_Item" :disabled="disabled"></items-modal>
        </div>
        <br>
        <br>
        <table class="table table-responsive">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Item Code</th>
                  <th scope="col">Description</th>
                  <th scope="col">Unit</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
                <tr v-for="(items,k) in listProduct" :key="k">
                    <td>{{k}}</td>
                    <td>{{items.Icode}}</td>
                    <td>{{items.Name}}</td>
                    <td>{{items.Unit}}</td>
                    <td><a @click="DeleteRow(k)">Delete</a></td>
                    </tr>              
        </table>
        <div class="col-lg-10">
<div>
  
    <div class="form-group">
      <!--<div class="alert alert-success" v-show="success">
      The data has been saved!!-->
      </div>
      
      <label for="name">Code:</label>
      <span class="alert-danger" v-if="errors && errors.Code">{{errors.Code[0]}}</span>
      <input   class="form-control" id="name" placeholder="Enter Code" v-model="product.Pcode">
    </div>

    <div class="form-group">
      <label for="pwd">Name:</label>
       <span class="alert-danger" v-if="errors && errors.Name">{{errors.Name[0]}}</span>
      <input v-model="product.Name" type="text" class="form-control" id="pwd" placeholder="Enter Name">
    </div>

    <div class="form-group">
      <label for="comment">Unit:</label>
      <input v-model="product.Unit" type="text" class="form-control" id="pwd" placeholder="Enter Unit" name="Unit">
      <span class="alert-danger" v-if="errors.Unit">{{errors.Unit[0]}}</span>
    </div>

    <div class="form-group">
      <label for="comment">Unit Price:</label>
      <input v-model="product.Price" type="number" class="form-control" id="pwd" placeholder="Enter Price" name="Price">
      <span class="alert-danger" v-if="errors.Price">{{errors.Unit[0]}}</span>
    </div>

    <button type="button" class="btn btn-primary" @click.prevent="SaveVendor">Submit</button>
  </div>
</div>
    
</template>
<script>

import ItemsModal from '../../Modals/ItemsModal.vue';
export default {

    data(){
        return {
            listProduct:[{
                Icode:'',
                Name:'',
                Pcode:'',
                Unit:"",
            }],
            product:[{
                Pcode:'',
                Name:'',
                Unit:'',
                UnitPrice:'',
            }],
            disabled:0,
            errors:[],
        }
    },

    components:{
        
        ItemsModal,
    },

    methods:{
         Selected_Item(event){
             var meron = false;
             var i;
             for (i=0;i < this.listProduct.length; i++){
            if(this.listProduct[i]['Icode']===event['Code']){
               meron = true;
               
            }
        }
     if (meron){
            alert("Item already Exist!!!");
        }

        else{
             if (this.listProduct[0]['Icode']=="")
        {this.listProduct.splice(0, 1);}

         this.listProduct.push({
            Icode:event['Code'],
            Name:event['Name'],
            Unit:event['Unit'],
         })
         

         }},

         DeleteRow(index){
             

              if (index > -1) {
                      this.listProduct.splice(index, 1);
                  }
                  if(this.listProduct.length==0){
                    this.listProduct.push({
                Icode:"",
                Name:'',
                Unit:'',
                Qty:0,
                                  });
                  }
         }
    }
    
}
</script>