<template>
  <nav class="navbar navbar-expand-lg navbar-light  py-0 py-md-auto" style="width:100%;">
    <div class="container-fluid p-0" >
         <NavBarLeft></NavBarLeft>
          <NavBarRight></NavBarRight>
    </div>
  </nav>
</template>

<script>
import NavBarRight from "./NavBarRight.vue";
import NavBarLeft from "./NavBarLeft.vue";
export default {
    data(){
        return {collapsed:false}
    },
    components:{NavBarRight,NavBarLeft}
}
</script>

<style>

</style>