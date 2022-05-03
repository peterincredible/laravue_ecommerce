<template>
<Fragment>
       <div v-if="showmain" :class="['col-12 d-none d-lg-flex justify-content-center  px-0 mx-auto  px-lg-3 mynavbar py-3 animate__animated animate__fadeIn',show? '':'animate__fadeOut']"><!---->
           <div class="default-layout d-flex justify-content-between  align-items-center">
                <NavBar></NavBar>
           </div>
       </div>
</Fragment>
</template>

<script>
import NavBar from "./NavBar.vue"
import {Fragment} from "vue-fragment";
export default {
  data(){
    return {show:false,showmain:false}
  },
    components:{Fragment,NavBar},
    methods:{
      scrollhandle(){
            if(window.scrollY > 140){
               if(this.show != true || this.showmain != true){
                   this.show= true;
                   this.showmain = true;
               }
              
            }else{
                if(this.show ==true){
                            this.show =false
                    setTimeout(()=>{
                      this.showmain=false;
                    },200)
                }
             
            }
      }
    },
    created(){
          window.addEventListener('scroll',this.scrollhandle);
    },
     destroyed () {
    window.removeEventListener('scroll', this.scrollhandle);
  }
    

}
</script>

<style scoped>
[v-cloak] { display:none !important; }
.mynavbar{
position: fixed;
top: 0px;
left:0px;
background-color: #fff;
box-shadow:0.3px 0.3px 3px #888;

}
</style>