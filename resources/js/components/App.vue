<template>
    <div class="container-fluid">
           <router-view></router-view>
    </div>
</template>

<script>
import HeaderComponent from "./header";
import Home from "./pages/Home.vue";
    export default {
        components:{HeaderComponent,Home},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
