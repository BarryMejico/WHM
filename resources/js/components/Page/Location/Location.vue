
<template> 

<div>
    <div class="container">
        <h1>Tree Data : A Location Storage</h1>
        <hr>
        <br>
        <br>
    <div class="row justify-content-left">
        <div class="col-md-10">
           <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                             
                            <h3>
                                <label id="Namehead">root</label>
                                <label id="head" type="text"></label>
                            </h3>
                        </div>
                        <div class="col-md-3">
                            <button @click="addNode" class="btn btn-info">Add</button>
                        </div>
                    </div>
                </div>
           </div>        
               <br>
               <br>
                   
            <label id="errorLabe"></label>
            <div id="datatree" class="card-body tree">
                <ul id="root">
                </ul>
            </div> 
                   
                
           
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">
                     <ItemsModal @SelectedItems="Selected_Item"></ItemsModal>

                    <input type="text">

                    <ul class="list-group">
                        <li 
                            class="list-group-item d-flex justify-content-between align-items-center" 
                            v-for="(item, k) in items" :key="k" style="border:solid grey 1px">
                            {{item.Name}}
                            <span class="badge badge-primary badge-pill">{{item.Unit}}</span>
                        </li>
                    </ul>
                </div>

                <!-- <div class="card-body"></div> -->
            </div>
        </div>
    </div>
</div>
    
               
       
    
</div>
</template>

<script>
import ItemsModal from '../../Modals/ItemsModal.vue';
import Swal from 'sweetalert2'

export default {
    components: {
        ItemsModal
    }, 
    data(){

        return{
            
            LocationRoot:[],

            selectedItem:'',

            ItemsInsidecode:[],

            items:[],

            items2:[],
        }
    },

    

     mounted(){
         
         this.getparent();
         this.itemsloader();
         //this.toggle_child();
         document.getElementById("datatree").addEventListener("click",this.datatree);
         document.getElementById("datatree").addEventListener("focusout",this.CheckOut);
         document.getElementById("datatree").addEventListener("dblclick",this.itemsInside);
         
     },
methods:{

saveItemtoLoaction(c,p){
    
    axios.post('/api/saveItemtoLoaction',{itemCode:c,parent:p})
    .then(()=>{

    })
},

    Selected_Item(event){
        console.log(event['status']);
        if (event['status']==1){

              Swal.fire({
                icon:'error',
                title:'Oops !',
                text:'Item already Exist in other location',
                showCancelButton: true,
                showConfirmButton: false
                }) 

             console.log("Item already Exist in other location!!!");
             return;
            }
else{
        var code=event['Code'],Name=event['Name'],Unit=event['Unit'];
        var parent = document.getElementById('head').textContent;
        var i;
        var meron = false;

         for (i=0;i < this.items.length; i++){
            if(this.items[i]['Code']===code){
               meron = true;
            }
        }

         if (meron){
             console.log("Item already Exist!!!")
              Swal.fire({
                icon:'warning',
                title:'Oops !',
                text:'Item already Exist',
                showCancelButton: true,
                showConfirmButton: false
                }) 
          }
        else{
            
          this.saveItemtoLoaction(code,parent);
        this.items.push({
                Code:code,
                Name:Name,
                Unit:Unit,

                                  });
        }
            //this.closeModal();
    }},

CheckOut(){    
var eTarget = document.getElementById("Dispo"),
newLiNode=document.createElement("li"),
textNode=document.createTextNode(">" + eTarget.value),
parentcode=eTarget.parentElement.parentElement.id;

//console.log(newcode)

if(eTarget.value==""){
eTarget.remove();
}
else{
newLiNode.appendChild(textNode);
eTarget.replaceWith(newLiNode);

axios.post('/api/SaveNode',{ name:eTarget.value, parent:parentcode})
.then(()=>{
console.log(newLiNode);
})
}
},

savingNode(){

},

     datatree(e){
    e=e||window.event;
    e=e.target||e.srcElement; 
    var newId=e.id.slice(3,e.id.length);
    var eTarget = document.getElementById(newId);

    if(eTarget.style.display=="none"){
        eTarget.style.display="inherit";
    }else{
        eTarget.style.display="none"
    }
},

itemsInside(e)
{
    e=e||window.event;
    e=e.target||e.srcElement; 
    var newId=e.id.slice(3,e.id.length);
    var eTarget = document.getElementById(newId);
        var parent=eTarget.id,
        textBox=document.getElementById("head"),
        textBox2=document.getElementById("Namehead");
        textBox.textContent=eTarget.id;
        textBox2.textContent= e.textContent + "/";
        
    axios.get('/api/itemsInside',{params:{parent:parent}})
        .then((response)=>{
            this.ItemsInsidecode=response.data;
            var i,j,code;
            this.items=[];
            for(i=0;i<this.ItemsInsidecode.length;i++){
                for(j=0;j<this.items2.length;j++){
                    if(code==this.items2[j]['Code']){
                            this.items.push({
                             Code:this.items2[j]['Code'],
                             Name:this.items2[j]['Name'],
                             Unit:this.items2[j]['Unit']
                })
                    }
                }
                
        }})
},

itemsloader(Code){
    axios.get('/api/LoadItems')
        .then(
          (response)=>{
            this.items2=response.data;  
          }
        )
},

    refreshTree(){
        setTimeout(() => location.reload(), 500);
    },



    toggle_child(){
        this.children=[];
        var i,j;
        var parent_code;
        //Loading parent code
        for (i=0;i < this.LocationRoot.length; i++){
            if(this.LocationRoot[i]['parent']==='root'){
            var target = document.getElementById("root"),
            ulparent= document.createElement("UL"),
            Label=document.createElement("li"),
            parentLabel=document.createTextNode(">  " + this.LocationRoot[i]['name']);
            Label.id= "pa-" + this.LocationRoot[i]['code'];
            Label.appendChild(parentLabel);
            target.appendChild(Label);
            ulparent.id=this.LocationRoot[i]['code'];
            target.append(ulparent);
            }
        }
    //end loading all parent node
    //loading child node
        for (i=0;i < this.LocationRoot.length; i++){   
            if(this.LocationRoot[i]['parent']!="root"){

                var idname=this.LocationRoot[i]['parent'];
                var liID="li-" + this.LocationRoot[i]['code'];
                    var laman = ">  " + this.LocationRoot[i]['name'];
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
        var tId = document.getElementById("head").textContent;
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

    
}
}
</script>

<style>

.tree {
cursor:pointer;
list-style: none;
font-family: 'century gothic';
font-size: 20px;

}

.tree ul{
border-left: 1px solid lightgrey;
margin-left: 20px;
padding-left: 20px;
}
.tree ul li:hover{
    font-weight:900;
}

.tree ul li{
cursor:pointer;
list-style: none;


}

.tree li:hover{
color: cornflowerblue;

}

.tree li:active{
color: red;
}

.tree div{
border: grey 1px solid;
}

</style>