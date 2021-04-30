<template>
    <div class="a">
        <span class="navbar-brand" style="font-size:30px;cursor:pointer" @click="loadMenu()" >&#9776; Menu</span>
<!--side bar-->
    <div id="DynamicSideNav" class="sidenav">
  <a class="closeli" @click="closeNav()"><b-icon icon="x" font-scale="2"></b-icon></a>

<ul v-for="(menus,k) in menusp" :key="k">
    <li v-if="menus.route!=0" class="Menu2" @click.prevent="closeNav()">
        <router-link :to="{path: menus.route}" >
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
            <li  v-for="(smenu,i) in menus.child" :key="i" class="subMenus" @click.prevent="closeNav()">
                 <router-link  :to="{path: smenu.route}">
                <b-icon :icon="smenu.icon" font-scale="2"></b-icon>
                {{smenu.Description}}
                 </router-link>
                </li>
        </ul>
        <br>


        <div id="footer1" class="fixed-bottom">
            <h5>Footer</h5>
        </div>

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

    #footer1 {
        position: relative;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        color:white;
        text-align: center;
        background-color: #292b2c;
    }


</style>

