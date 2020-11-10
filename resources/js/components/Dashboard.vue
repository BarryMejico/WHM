<template>
    <div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   Laman?
                   
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