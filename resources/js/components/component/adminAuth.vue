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
                <b-form-select v-model="selected" @change="loadpermi()" :options="options" ></b-form-select>
            </b-col>
            <b-col>
                <br>
                <b-btn variant="success"  @click="loadpermi()">Load</b-btn>
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
               <th>Submenu</th>
           </thead>
           <br>
           <tbody>
               <tr v-for="(menus,k) in menusp" :key="k">
                <td><input type="checkbox" :checked='menus.box'/></td>
                   <td>{{menus.Description}}</td>
                   <td>
                   <ul>
            <li  v-for="(smenu,i) in menus.child" :key="i">
                <input type="checkbox" :checked='smenu.box'/>
                <b-icon :icon="smenu.icon" font-scale="2"></b-icon>
                {{smenu.Description}}
            
                </li>
        </ul>
        </td>
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
            selected:'',
        options: [],
        items: [
          { des: 'Purchase Order' },
          { des: 'Job Order' },
          { des: 'Sales' },
          { des: 'Inventory' }
        ],
        menusp:[{
                Description: '',
                icon:'',
                id: '',
                menuParent:'',
                route:'',
                child:[],
            }],

        }
    },

    mounted(){
        this.loadmenus();
        this.load_employee();
    },
    methods:{

        loadpermi(){
            console.log(this.selected)
            axios
            .get('/api/menuforperma',{params:{selected:this.selected}})
            .then((res)=>{
                var laman=res.data;
                var i,j;
                for(i=0;i<=this.menusp.length-1;i++){
                    for(j=0;j<=laman.length-1;j++){
                        if(this.menusp[i]['id']==laman[j]['id']){
                            this.menusp[i]['box']=true
                        }
                        
                var ij;
                for(ij=0;ij<=this.menusp[i]['child'].length-1;ij++){
                 if(this.menusp[i]['child'][ij]['id']==laman[j]['id']){
                            this.menusp[i]['child'][ij]['box']=true
                        }
                }    
                }
                }

            })
            .catch((error)=>{
                alert(error)
                var i,j;
                for(i=0;i<=this.menusp.length-1;i++){
                            this.menusp[i]['box']=false
                for(j=0;j<=this.menusp[i]['child'].length-1;j++){
                            this.menusp[i]['child'][j]['box']=false
                }
                }
            }                
            )},

        loadmenus(){
            axios
            .get('/api/menu')
            .then((res)=>{
                this.items=res.data;
                  this.toggle_child(this.items)
            })
        },

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
        },

        toggle_child(LocationRoot){
        this.children=[];
        var i,j;
        //Loading parent code
        for (i=0;i < LocationRoot.length; i++){
             if (this.menusp[0]['id']=="")
        {this.menusp.splice(0, 1);}
            if(LocationRoot[i]['menuParent']==='root'){
                    this.menusp.push({
                            Description: LocationRoot[i]['Description'],
                            icon:LocationRoot[i]['icon'],
                            id: LocationRoot[i]['id'],
                            menuParent:LocationRoot[i]['menuParent'],
                            route: LocationRoot[i]['route'],
                            child:[],
                            box:false,
                    })}}
    //end loading all parent node

    //loading child node
    for(j=0;j<this.menusp.length;j++){
        for (i=0;i < LocationRoot.length; i++){   
            if(LocationRoot[i]['menuParent']==this.menusp[j]['id']){
                    this.menusp[j].child.push({
                        Description: LocationRoot[i]['Description'],
                            icon:LocationRoot[i]['icon'],
                            id: LocationRoot[i]['id'],
                            menuParent:LocationRoot[i]['menuParent'],
                            route: LocationRoot[i]['route'],
                            box:false,
                    })
    }
        }}
    },

             load_employee(){
          axios.get('/api/LoadallEmployee')
          .then(
              (response)=>{
                  
                  var laman = response.data
                  console.log(laman[0]['id'])
                  var i;
                  for(i=0;i<=response.data.length-1;i++){
                      this.options.push({
                          value:laman[i]['permCode'],
                          text:response.data[i]['Employee']
                      })
                  }
              }
          )
          .catch()
      },
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

