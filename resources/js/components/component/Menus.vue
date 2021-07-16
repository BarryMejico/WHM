<template>
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                 <tr>
                  <th scope="col" class="t">#</th>
                  <th scope="col" class="t">Item Code</th>
                  <th scope="col">Description</th>
                  <th scope="col">Icon</th>
                  <th scope="col">route</th>
                </tr>
              </thead>
              <br>

              <tbody>
                  <tr v-for="(menu, k) in roots" :key="k">
                    <td class="zz">
                          {{k}}
                      </td>
                      <td class="zz">
                          {{menu.id}}
                      </td>

                      <td>
                          <b-btn variant="outline-dark" @click="getChild(menu.id)">{{menu.Description}}</b-btn>
                      </td>

                      <td class="x">
                          <b-icon :icon="menu.icon" font-scale="2"></b-icon>
                         {{menu.icon}}
                      </td>

                      <td>
                          {{menu.route}}
                      </td>
                  </tr>
                  <br>
                   <tr id="emptyRow">
                       <td>---</td>
                       <td>---</td>
                       <td>---</td>
                       <td>---</td>
                    <td>
                        <b-btn variant="outline-info" align="right">Add Root</b-btn>
                    </td>
                    </tr>

              </tbody>
        </table>


        <table class="table">
                           <thead class="thead-dark">
                                <tr>
                                <th scope="col" class="t">#</th>
                                <th scope="col" class="t">Item Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Icon</th>
                                <th scope="col">route</th>
                                </tr>
                            </thead>
                            <br>
                            <tbody>
                                <tr v-for="(Child, k) in Children" :key="k">
                                <td class="zz">
                          {{k}}
                      </td>
                      <td class="zz">
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
                   <br>

                    <tr id="emptyRow">
                       <td>---</td>
                       <td>---</td>
                       <td>---</td>
                       <td>---</td>
                        <td>
                            <b-btn variant="outline-info" align="right">Add Child</b-btn>
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
<style scoped>
table{
    width:100%;
}
.t{
    text-align: center;
}
.zz{
    text-align: center;
}
.x{
    padding-left:20px;
}
#emptyRow{
    text-align: center;
}
</style>