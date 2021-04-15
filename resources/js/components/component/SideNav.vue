<template>
    <div>
        <button type="button" class="btn btn-outline-secondary" @click="loadMenu()">Menu</button>
<!--side bar-->
<div id="DynamicSideNav" class="sidenav">
  <a href="javascript:void(0)" class="closeli" @click="closeNav()"><b-icon icon="x" font-scale="2"></b-icon></a>

<ul v-for="(menus,k) in menusp" :key="k">
    <li v-if="menus.route!=0" class="Menu2">
        <router-link  :to="{path: menus.route}">
            <b-icon :icon="menus.icon" font-scale="2"></b-icon>
                        {{menus.Description}}
        </router-link>
    </li>

     <li v-if="menus.route==0" data-toggle="collapse" :data-target="'#s'+ menus.id" class="Menu">
            <b-icon :icon="menus.icon" font-scale="2"></b-icon>
                        {{menus.Description}}
        
    </li>
       <div  :id="'s' + menus.id" class="collapse">
        <ul>
            <li  v-for="(smenu,i) in menus.child" :key="i" class="subMenus">
                 <router-link  :to="{path: smenu.route}">
                <b-icon :icon="smenu.icon" font-scale="2"></b-icon>
                {{smenu.Description}}
                 </router-link>
                </li>
        </ul>
       </div>  
</ul>


</div>
<!--side bar End-->


    </div>
</template>

<script>
export default{
mounted(){
    this.getListofMenu();
   
},

    data(){
        return{
            menus:[],
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
methods:{
openNav() {
  document.getElementById("DynamicSideNav").style.width = "350px";
  },

 closeNav() {
  document.getElementById("DynamicSideNav").style.width = "0";
  },

  loadMenu(){
      this.openNav();
  },
  
  getListofMenu(){
      axios
      .get('/api/menu')
      .then((res)=>{
          this.menus=res.data;
          this.toggle_child(this.menus)
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
                    })
    }
        }}
    },
}
}
</script>

<style scoped>
    .notAvailable{ /* empty link/components */
        text-decoration: line-through;
        background-color:grey;
        padding:5px;
        margin:3px;
        border-radius:5px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
        
    }
   
    .footer-bs{
        margin-top:500px;
    }
    .Menu{ /* menus */
        padding:15px;
        text-indent:10%;
        margin:10px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
       
    }
    .Menu2{ /* menus: PO & Warehouse Setup only*/
        padding:15px;
        margin:10px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
       
    }

    .subMenus{ /* submenus */
        padding:5px;
        margin:3px;
        border-top-left-radius:100px;
        border-bottom-left-radius:100px;
        color:#5bc0de;
       
    }
    .closeli{  /* close btn */
        text-align:right;
        margin-bottom:50px;
    }

    /* hover effects*/
    .Menu:hover{
        color:#5bc0de;
        cursor:pointer;
    }
    .Menu2:hover{
        color:#5bc0de;
        text-decoration:none;
        list-style:none;
    }
    /* active effects*/
    .Menu:active{
        color:#5bc0de;
       
        
    }
    .Menu2:active{
        color:#5bc0de;
        font-weight: 700;
       
    }
    #account,#WH,#WHsetup{
        text-decoration: line-through;
    }
    #appname:hover{
        cursor:pointer;
        color:#5bc0de;
    }
    
</style>
