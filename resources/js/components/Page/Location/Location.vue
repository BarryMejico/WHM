
<template>

<div>
    <div class="container">
    <div class="row justify-content-left">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Home<button @click="refreshTree" class="btn btn-secondary btn-sm">Refresh</button></div>

                <div class="card-body">
                    <label id="errorLabe"></label>
                    <div id="datatree" class="card-body tree">
                        <ul id="root" >
                        </ul>
                   </div> 
                   
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Locations</div>

                <div class="card-body">
                    <input v-model="selectedItem" id="head" type="text">
                    <input type="text">
                    <button @click="addNode" class="btn btn-secondary btn-sm">Add</button>
                    <button @click="refreshTree" class="btn btn-secondary btn-sm">Save</button>
                    <button @click="refreshTree" class="btn btn-secondary btn-sm">Refresh</button>
                   
                </div>
            </div>
        </div>
    </div>
</div>
    
               
       
    
</div>
</template>

<script>


function datatree(e){
    e=e||window.event;
    e=e.target||e.srcElement;
    
    var newId=e.id.slice(3,e.id.length);
    
    var eTarget = document.getElementById(newId),
        eparent=document.getElementById(e.id),
        textBox=document.getElementById("head");
    //console.log(eTarget.style);
    textBox.value=eTarget.id;
    if(eTarget.style.display=="none"){
        eTarget.style.display="inherit";
        //eparent.style.backgroundColor="blue";
    }else{
        eTarget.style.display="none"
        //eparent.style.backgroundColor="";
    }
}

function CheckOut(){
var eTarget = document.getElementById("Dispo"),
newLiNode=document.createElement("li"),
textNode=document.createTextNode(">" + eTarget.value);
if(eTarget.value==""){
eTarget.remove();
}
else{
newLiNode.appendChild(textNode);
console.log(newLiNode)
eTarget.replaceWith(newLiNode);
}
}


export default {
    data(){

        return{
            
            LocationRoot:[],

            selectedItem:'',
        }
    },

     mounted(){
         
         this.getparent();
         //this.toggle_child();
         document.getElementById("datatree").addEventListener("click",datatree);
         document.getElementById("datatree").addEventListener("focusout",CheckOut);
         
     },
methods:{
    refreshTree(){
        setTimeout(() => location.reload(), 500);
    },

    toggle(idname){
      var listNode=document.getElementById(idname);
      //var i;
       console.log(listNode);

       //listNode.replaceChild()
      //for(i=0;i<listNode.childElementCount; i++){
          
          //console.log(listNode.children[i]);
     // }
    },

    toggle_child(){
        this.children=[];
        var i,j;
        var parent_code;
        
        for (i=0;i < this.LocationRoot.length; i++){
            if(this.LocationRoot[i]['parent']==='root'){
            var target = document.getElementById("root"),
            ulparent= document.createElement("UL"),
            Label=document.createElement("li"),
            parentLabel=document.createTextNode(">" + this.LocationRoot[i]['name']);

            Label.id= "pa-" + this.LocationRoot[i]['code'];
            Label.appendChild(parentLabel);

            target.appendChild(Label);
            ulparent.id=this.LocationRoot[i]['code'];
            
            target.append(ulparent);
            
            }
        }
        for (i=0;i < this.LocationRoot.length; i++){   
            if(this.LocationRoot[i]['parent']!="root"){

                var idname=this.LocationRoot[i]['parent'];
                var liID="li-" + this.LocationRoot[i]['code'];
                    var laman = ">" + this.LocationRoot[i]['name'];
                    var listNode=document.getElementById(idname),
                        liNode=document.createElement("LI"),
                        txtNode=document.createTextNode(laman),
                        ulNode=document.createElement("ul");
                        
                        liNode.id=liID;
                        ulNode.id=this.LocationRoot[i]['code'];
                      
                try {

                liNode.appendChild(txtNode);
                listNode.appendChild(liNode);
                listNode.append(ulNode);
                listNode.style.display="none";
                }
                catch(e){
                    console.log(e)   
                }
                
               
    }
        }
    },

    getparent(){
        axios.get('/api/treedata')
          .then(
              (response)=>{ 
                  this.LocationRoot=response.data;
                  this.toggle_child();
              }
          )
          .catch()    
},
    addNode(){
        var tId = document.getElementById("head").value;
        var TargetList=document.getElementById(tId),
            textBox=document.createElement("input"),
            newLi=document.createElement("li");
            textBox.type="text";
            textBox.id="Dispo";
            console.log("laman "+tId);
            newLi.appendChild(textBox);
            TargetList.append(newLi);
            
            if(TargetList.style.display=="none"){
        TargetList.style.display="inherit";
        //eparent.style.backgroundColor="blue";
    }
            document.getElementById("Dispo").focus();
            
    },
    away(){
        console.log("away");
    },
    
}
}
</script>

<style>

.tree {
cursor:pointer;
list-style: none;
}

.tree ul{
border-left: 1px solid black;
margin-left: 20px;
padding-left: 20px;
}

.tree ul li{
cursor:pointer;
list-style: none;

}

.tree li:hover{
color: cornflowerblue;

}

.tree li:click{
color: red;
}

.tree div{
border: black 1px solid;
}

</style>