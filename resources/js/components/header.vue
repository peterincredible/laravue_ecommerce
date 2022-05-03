<template>
<Fragment>
       <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 mynavbar"><!---->
           <div class="default-layout d-flex justify-content-between  align-items-center">
                <NavBar></NavBar>
           </div>
       </div>
</Fragment>
</template>

<script>
import NavBar from "./NavBar.vue"
import NavBarTop from "./NavBarTop.vue"
import {Fragment} from "vue-fragment";
export default {
     components:{NavBar,NavBarTop,Fragment}

}
</script>

<style scoped>


</style>