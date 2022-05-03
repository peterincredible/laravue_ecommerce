<template>
   <div :class="['search_header animate__animated animate__faster','animate__slideInDown',fade?'animate__slideOutUp':'  ']">
        <div class="search_header_container">
            <div class="d-flex justify-content-end mb-2">
                <span @click='searchHeaderToggle' style="cursor:pointer;"><font-awesome-icon icon="times"   size='2x'></font-awesome-icon></span>
            </div>
            <div class="card card-body d-flex flex-row justify-content-between align-items-center search_container m_local">
                <span class="m_local_icon"><font-awesome-icon icon="search"  ></font-awesome-icon></span>
                <input type="text" class="" placeholder="Search"/>
            </div>
        </div>
   </div>
  
</template>

<script>
export default {
     data(){
          return {fade:false}
      },
      methods:{
           searchHeaderToggle(){

             this.fade=!this.fade;
             setTimeout(()=>{
                    this.$store.commit('searchHeaderToggle');
             },400);
            
        }
      }

}
</script>

<style >


</style>