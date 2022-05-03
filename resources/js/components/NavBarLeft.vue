<template>
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
            
            <button class="navbar-toggler px-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" @click="collapsed= !collapsed">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <transition name="fade">
                <font-awesome-icon icon="times"  style="font-size:29px; color:#000;"  v-if='collapsed'></font-awesome-icon>
                <font-awesome-icon icon="bars"  style="font-size:29px; color:#000;" v-else></font-awesome-icon>
            </transition>
            </button>
    </div>
</template>

<script>
import IconLink from "./IconLink.vue";
import { mapGetters } from 'vuex';
export default {
    data(){
        return {collapsed:false,link:""}
    },
     mounted(){
        this.link = this.$route.path
    },
    components:{IconLink},
    computed:{
      ...mapGetters(['isAuth'])
    }
}
</script>

<style>
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