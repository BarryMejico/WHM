<template>
    <div>
<div class="dropdown">
    <button class="dropdown-toggle" type="button" data-toggle="dropdown" :disabled="disabled == 1">
    <span class="caret">Add Items</span></button>
    <ul class="dropdown-menu">
      <li><button href="#addEmployeeModal" class="btn-light btn-sm nav-link" data-toggle="modal">From List</button></li>
      <li><button @click="ScanShow" class="btn-light btn-sm nav-link" data-toggle="modal">Scan</button></li>
    </ul>
    <div v-show="Scan">
    <input v-on:input="scanItem" id="ScanTxt" v-model="SearchS" type="text">
    <button @click.prevent="ScanShow" class="btn-danger btn-sm">X</button>
    </div>
</div>

      <!--modal-->

  <div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Add Item</h4>
					<button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top:10px;">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group">		
            <label>Item Code</label>		
            <input type="text" v-on:input="liveSearch" v-model="Search">
          </div>

          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" 
              v-for="(item, k) in items" :key="k">
              <a @click="Selected_Item(k)">{{item.Name}}</a>
              <span class="badge badge-primary badge-pill">{{item.Unit}}</span>
            </li>
          </ul>
				</div>

				<div class="modal-footer" style="text-align:right;" >
          <a @click="addNewRow('code')" type="button" class="my_btn btn link tn-secondary" id="addItemBtn">Add Item</a>
				</div>
			
		</div>
	</div>
</div>

<div id="ScanCode" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Add Item</h4>
					<button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group">		
                    <label>Item Code</label>		
										<input type="text" id='code' @keyup.enter="addNewRow('code')">
          </div>


				</div>
				<div class="modal-footer">
          <button  type="button" class="btn btn-light"  @click="addNewRow('code')">Add Item</button>
				</div>
			
		</div>
	</div>
</div>


    </div>
</template>

<script>
import DevicesModal from './DevicesModal.vue';

export default {
  props:{
    disabled: 0
  },
  
  components: { DevicesModal },
  data(){
    return{
      //-----for loading items
        items:[],
        //Live Search
        Search:'',
        SearchS:'',
        //scan
        Scan:false,
    }
  },
  mounted(){
    this.load_item();
  },

  watch:{
    Scan: function(){

    }
  },

  methods:{
    Selected_Item(index){
        this.$emit("SelectedItems",this.items[index]);
        this.closeModal();
    },

    closeModal() {
              this.items=[];
             document.getElementById('close').click();
             this.load_item();
},

load_item(){
        axios.get('/api/LoadItems')
        .then(
          (response)=>{
            this.items=response.data;
          }
        )
      },

      liveSearch(){
        axios.get('/api/LiveSearchItem',{params:{Search:this.Search}})
          .then(
              (response)=>{
                //console.log(response.data);
              this.items=response.data;
              }
          )
          .catch()
      },

      scanItem(){
        this.items
        var i;
        for(i=0;i<this.items.length;i++){
          if(this.SearchS==this.items[i]['Code']){
            this.Selected_Item(i);
            this.SearchS="";
          }
        }
      },

      ScanShow(){
        if (this.Scan==false){
        this.Scan=true;
        
        this.$nextTick(() => {
    var s = document.getElementById("ScanTxt");
        s.focus();
  })
        }
        else{this.Scan=false;
        }
      },
  }
}
</script>

<style scoped>
/* Modal styles */
/* this is class for dialog itself*/
.modal {
   
   z-index: 9999
}
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
ul li:hover{
  background-color: #eee;
  cursor: pointer;
}
.addItemBtn:hover{
  color:#5bc0de;
}
.close{
  text-align: right;
}
</style>