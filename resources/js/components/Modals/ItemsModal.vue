<template>
    <div>
<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
    <span class="caret">Add Items</span></button>
    <ul class="dropdown-menu">
      <li><button href="#addEmployeeModal" class="btn-light btn-sm nav-link" data-toggle="modal">From List</button></li>
      <li><button class="btn-light btn-sm nav-link">Scan</button></li>
    </ul>
</div>
<label>Scan Product Code of Serial Number</label>
<input type="text"/>
      <!--modal-->
       <div id="addEmployeeModal" class="modal fade">
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

<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" 
    v-for="(item, k) in items" :key="k">
    <a @click="Selected_Item(k)">{{item.Name}}</a>
    <span class="badge badge-primary badge-pill">{{item.Unit}}</span>
  </li>
  <a class="link">New Vendor</a>
</ul>
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

export default {
  data(){
    return{
      //-----for loading items
        items:[],
    }
  },
  mounted(){
    this.load_item();
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
  }
}
</script>

<style>
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
</style>