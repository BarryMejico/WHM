<template>
    <div>
        <table>
            <thead class="thead-dark">
                 <tr>
                  <th scope="col">#</th>
                  <th scope="col">Item Code</th>
                  <th scope="col">Description</th>
                  <th scope="col">Icon</th>
                  <th scope="col">route</th>
                  
                </tr>
              </thead>
              <tbody>
                  <tr v-for="(menu, k) in roots" :key="k">
                    <td>
                          {{k}}
                      </td>
                      <td>
                          {{menu.id}}
                      </td>

                      <td><button @click="getChild(menu.id)">
                          {{menu.Description}}
                          </button>
                      </td>

                      <td>
                          <b-icon :icon="menu.icon" font-scale="2"></b-icon>
                         {{menu.icon}}
                      </td>

                      <td>
                          {{menu.route}}
                      </td>
                  </tr>
                   <tr>
                                <td>
                                <button>Add Root</button>
                                </td>
                                </tr>
                  
              </tbody>
        </table>

        <table>
                           <thead class="thead-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Icon</th>
                                <th scope="col">route</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(Child, k) in Children" :key="k">
                                <td>
                          {{k}}
                      </td>
                      <td>
                          {{Child.id}}
                      </td>

                      <td>
                          {{Child.Description}}
                         
                      </td>

                      <td>
                          <b-icon :icon="Child.icon" font-scale="2"></b-icon>
                         {{Child.icon}}
                      </td>

                      <td>
                          {{Child.route}}
                      </td>
                                </tr>

                                <tr>
                                <td>
                                <button>Add Child</button>
                                </td>
                                </tr>
                            </tbody>
</table>

    </div>
</template>
<script>
function int_data(){
     return{
         menus:[],
         roots:[],
         Children:[],
     }
}
export default {

    data:function(){
      return int_data();
      }, 

      beforeMount(){
this.getmenus()
      },

    mounted(){
        
    },

    methods:{
        getmenus(){
            axios.get('/api/allmenu')
            .then((res)=>{
                    this.menus=res.data;
                    this.getroots();
                    
            })
            //.catch(()=>{})
        },

        getroots(){
            var i;
            for (i=0;i<=this.menus.length-1;i++){
                if(this.menus[i]['menuParent']=='root'){
                    this.roots.push({
                        Description: this.menus[i]['Description'],
                        icon:this.menus[i]['icon'],
                        id:this.menus[i]['id'],
                        menuParent:this.menus[i]['menuParent'],
                        route: this.menus[i]['route']
                        });
                }
                
                }
        },

        getChild(index){
var i;
this.Children=[]
            for (i=0;i<=this.menus.length-1;i++){
                if(this.menus[i]['menuParent']==index){
                    this.Children.push({
                        Description: this.menus[i]['Description'],
                        icon:this.menus[i]['icon'],
                        id:this.menus[i]['id'],
                        menuParent:this.menus[i]['menuParent'],
                        route: this.menus[i]['route']
                        });
                }
                
                }
        },
    }
}
</script>