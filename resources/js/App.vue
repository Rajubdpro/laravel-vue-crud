<template>

<div class="container">
  <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                 <header-area/>
                <div class="card-body">
                
                   <router-view></router-view>

                </div>
            </div>
        </div>
    </div>
    </div>


</template>

<script>


import Header from "./components/header.vue";

export default {
  name:'App',
  
  components:{

      'header-area': Header,

  }
}




</script>
