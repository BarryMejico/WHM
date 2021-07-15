<template>
    <div>

          <!-- <select>
                      <option v-for="(Customer, k) in List_Customer" :key="k">{{Customer.Employee}}</option>
          </select> -->
         

          <a id="cus" href="#EmployeeModal" @click="loadindex" data-toggle="modal" type="button" class="my_btn btn link tn-secondary" :disabled="disabled == 1">
                       <b-icon icon="search"></b-icon></a>

        <!--modal Employee-->
<div id="EmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Employees</h4>
					<button type="button" id="closeGetEmployee" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top:10px;">&times;</button>
				</div>
				<div class="modal-body">	
          <div class="form-group">		
                    <label>Search Employee Name</label>	
                    <input type="text" v-on:input="liveSearch" v-model="Search">
          </div>
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center" 
    v-for="(Customer, k) in List_Customer" :key="k">
    <a @click="Selected_cus(k)">{{Customer.Employee}}</a>
    <span class="badge badge-primary badge-pill">{{Customer.id}}</span>
  </li>
</ul>
<br>

<ul class="pagination justify-content-end">
    <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="prepAGE()">Previous</a></li>
    <ul class="pagination justify-content-end" v-for="(pages, page) in pages.last_page" :key=page>
    <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="changepAGE(pages)">{{pages}}</a></li>
    </ul>
    <li class="page-item"><a class="page-link bg-dark text-white" @click.prevent="nextpAGE()">Next</a></li>
</ul>


          </div>			
				<div class="modal-footer">
           <a  href="#NewEmployee" data-toggle="modal" type="button" class="my_btn btn link tn-secondary" id="newEmployeeModal">New Employee</a>
          <!-- <button  type="button" class="btn btn-light" data-dismiss="modal" aria-hidden="true">Select Vendor</button> -->
				</div>
			
		</div>
	</div>
</div>
<!--modal Add-->
<div id="NewEmployee" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			
				<div class="modal-header">						
					<h4 class="modal-title">Employees</h4>
					<button type="button" id="closeEmployee" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
        <br>

				<div class="modal-body">	
          <br>

          <b-tabs content-class="mt-3">
            <b-tab title="Add" active>
              <div class="form-group">
                      		
                        <label>Name</label>	
                        <input type="text" v-model="Name_">     
                        <button  type="button" class="btn btn-light" data-dismiss="modal" @click.prevent="SaveEmployee()" aria-hidden="true">Save</button>    
              </div>
            </b-tab>
            <b-tab title="Search">
               <div class="form-group">	
                
                          <label>Search by id or Email</label>	
                          <input type="text" v-model="iName_">
                          <b class="employeeData">Name:<i>{{iName}}</i></b><br>
                          <b class="employeeData">Email:<i>{{iEmail}}</i></b>
                          <br><br>
                          <button @click="saveInvite()"> Send Invite</button>
                </div>
            </b-tab>
          </b-tabs>

          </div>			
			
		</div>
	</div>
</div>

    </div>
    
</template>
<script>
function int_data(){
  return{
  
       //---for loading Ship to
       Ship:'',
       List_Customer:[],
       Customer:'',
       Name_:'',
       iName_:'',
       iName:'Automatically will load',
       iEmail:'Automatically will load',
       add_Cus:'',
       //Live Search
        Search:'',
        //forselection
        selected: 'A',
        ins:null,
        pages:'',
        to:'',
        from:'',
        COCode:'',
    }
    }
export default {

  props:{
    disabled: Number,
    index:Number
  },

    data:function(){
      return int_data();
      }, 
mounted(){
this.load_customer();
},

watch:{
  iName_:function(val){
    this.sUser();
  }
},


methods:{

  //pagination

      changepAGE(page){
        axios.get('/api/LoadEmployee?page='+page)
        .then((res)=>{
          this.List_Customer=res.data.data;
          this.pages=res.data
          })
          .catch((errors)=>{
          })
      },
     prepAGE(){
        axios.get(this.pages.first_page_url)
        .then((res)=>{
          this.List_Customer=res.data.data;
          this.pages=res.data
          })
          .catch((errors)=>{
          })
      },
      nextpAGE(){
        axios.get(this.pages.next_page_url)
        .then((res)=>{
          this.List_Customer=res.data.data;
          this.pages=res.data
          })
          .catch((errors)=>{
          })
      },
//end pagination
saveInvite(){
  axios.post('/api/saveInvite',{invite_to:this.to})
  .then(()=>{
    this.closeModal();
  })
},

sUser(){
  this.iName="loading";
  this.iEmail="loading";
  axios.get('/api/getUser',{params:{sUser:this.iName_}})
  .then((res=>{
    this.iName=res.data[0]['name'];
    this.iEmail=res.data[0]['email'];
    this.to=res.data[0]['id'];
  }))
  .catch(()=>{
    this.to="";
    this.iName="?";
    this.iEmail="?";}
  )
},

  loadindex(){
    this.ins=this.index;
    this.$emit("loadindex",this.ins);
    console.log("inside: " + this.ins)
  },

  Selected_cus(index){
        this.$emit("SelectedEmployee",this.List_Customer[index]);
        console.log(this.List_Customer[index])
        this.closeModal();
    },

    closeModal() {
      document.getElementById('closeGetEmployee').click();
      document.getElementById('closeEmployee').click();
              this.List_Customer=[];
              this.load_customer();
             
},

   load_customer(){
          axios.get('/api/LoadEmployee')
          .then(
              (response)=>{
                  this.List_Customer=response.data.data;
                  this.pages=response.data;
              }
          )
          .catch()
      },

      SaveEmployee(){
        axios('/api/SaveEmployee',{params:{Name_:this.Name_}})
        .then((res)=>{
            this.load_customer();
              this.closeModal();
        })
      },

      liveSearch(){
        axios.get('/api/searchEmployee',{params:{Search:this.Search}})
          .then(
              (response)=>{
              this.List_Customer=response.data.data;
              this.pages=response.data;
              }
          )
          .catch()
      },
},

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
.close{
  text-align: right;
}
ul li:hover{
  background-color: #eee;
  cursor: pointer;
}
#newEmployeeModal:hover{
  color:#5bc0de;
}
.employeeData{
  margin-top:30px;
}
</style>