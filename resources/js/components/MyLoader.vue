<template>
 <div v-if='show' :class="['d-flex justify-content-center align-items-center  myloader animate__animated animate__faster',loading?'':'animate__fadeOut']">
       <bounce-loader :loading="true" :color="'#0d6efd'" :height="height" :width="width"></bounce-loader>
 </div>
   
</template>

<script>
import BounceLoader from 'vue-spinner/src/BounceLoader.vue';
export default {
    props:['loading'],
   components:{BounceLoader},
   data(){
       return {width:'100%',height:"100%",show:true}
   },
   watch:{
       loading(new_value){
              if(new_value ==false){
                  setTimeout(()=>{
                   this.show=false;
                  },400)
              }
       }
   }
}
</script>

<style >

</style>