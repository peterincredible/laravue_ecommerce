<template>
    <Fragment>
        <div  :class="['col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3  py-3 ',shadow?'mybox_shadow':'']"><!---->
            <div class="default-layout d-flex justify-content-between  align-items-center">
                <nav class="navbar navbar-expand-lg navbar-light  py-0 py-md-auto" style="width:100%;">
                    <div class="container-fluid p-0" >
                        <div class="d-flex w-100 px-2 px-lg-0 mobile_brand py-2">
                            <router-link class="navbar-brand" to="/">COZA STORE</router-link>
                            <ul class="navbar-nav d-none d-lg-flex me-auto mb-2 mb-lg-0 px-2 px-lg-0">
                                <li class="nav-item">
                                <router-link :class="['nav-link',link =='/'?'link_active':'']" aria-current="page" to="/">Home</router-link>
                                </li>
                                <li class="nav-item">
                                <router-link :class="['nav-link',link =='/shop'?'link_active':'']" to="/shop">Shop</router-link>
                                </li>
                                <li class="nav-item" v-if="isAuth">
                                    <router-link :class="['nav-link',link =='/dashboard'?'link_active':'']" to="/dashboard">Dashboard</router-link>
                                </li>
                                <li class="nav-item">
                                <router-link :class="['nav-link',link =='/about'?'link_active':'']" to="/about">About</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link :class="['nav-link',link =='/contact'?'link_active':'']" to="/contact">Contact</router-link>
                                </li>
                            </ul>
                            <div class="d-block d-lg-none ms-auto me-3">
                                <IconLink></IconLink>
                            </div>
                            
                            <button class="navbar-toggler px-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" @click="toggleCollapse">
                            <!-- <span class="navbar-toggler-icon"></span> -->
                            <transition name="fade">
                                <font-awesome-icon icon="times"  style="font-size:29px; color:#000;"  v-if='collapsed'></font-awesome-icon>
                                <font-awesome-icon icon="bars"  style="font-size:29px; color:#000;" v-else></font-awesome-icon>
                            </transition>
                            </button>
                        </div>
                        <NavBarRight></NavBarRight>
                    </div>
                </nav>
            </div>
        </div>
    </Fragment>
</template>

<script>

import NavBarTop from "./NavBarTop.vue"
import NavBarRight from "./NavBarRight.vue";
import {Fragment} from "vue-fragment";
import IconLink from "./IconLink.vue"
import {mapGetters} from "vuex";
export default {
    data(){
        return {collapsed:false,shadow:false,link:""}
    },
     components:{Fragment,IconLink,NavBarRight},
     methods:{
         toggleCollapse(){
                 this.collapsed = !this.collapsed;
                 if(this.collapsed == true){
                     this.shadow = false;
                 }else{
                     this.shadow = true;
                 }
         }
     },
     mounted(){
           this.shadow=true;
            this.link = this.$route.path;
     },
     computed:{
          ...mapGetters(['isAuth'])
     }

}

</script>

<style scoped>
.mybox_shadow{
box-shadow:0.3px 0.3px 3px #888;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity .10s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
.nav-item{
  display: inline-block;
}
</style>