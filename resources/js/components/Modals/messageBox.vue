<template>
    <div v-if="message.visibility" class="card">
<div class="card-header">{{message.head}}</div>
<div class="card-body">
    <!-- <span>{{message.insdide}}</span><br> -->
    <!-- <p>{{message.errors.message}}</p> -->
<ul v-if="message.errors.errors" class="list-group error-list">

    <li v-for="(value,name) in message.errors.errors" :key="name" class="list-group-item d-flex justify-content-between align-items-center">
      {{name}}: {{value[0]}}
  </li>
</ul>  
</div>
</div>
</template>

<script>

export default {
    props:['message'],
}
</script>