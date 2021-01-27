<template>
    <div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   <ul>
                   <li>Step 1:
                       <h3>Data Setup</h3>
                        
                   </li>
                   <li>Step 2:</li>
                   <li>Step 3:</li>
                   <li>Step 4:</li>
                   <li>Step 5:</li>
                   </ul>
                </div>
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
            user:null
        }
    },
    mounted(){
        axios.get('/api/user').then((res)=>{
            this.user=res.data
        })
    }
}
</script>