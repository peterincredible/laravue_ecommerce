<template>
   <div class="collapse navbar-collapse  px-lg-0 collapse_mobile" id="navbarSupportedContent">
        <NavBarTopMobile></NavBarTopMobile>
        <ul class="navbar-nav d-lg-none me-auto mb-2 mb-lg-0 px-2 px-lg-0">
             <li class="nav-item">
                  <router-link :class="['nav-link',link =='/'?'link_active':'']" aria-current="page" to="/">Home</router-link>
            </li>
            <li class="nav-item">
                <router-link :class="['nav-link',link =='/shop'?'link_active':'']" to="/shop">Shop</router-link>
            </li>
            <li class="nav-item">
                <router-link :class="['nav-link',link =='/dashboard'?'link_active':'']" to="/dashboard"  v-if="isAuth">Dashboard</router-link>
            </li>
            <li class="nav-item">
            <router-link class="nav-link" :class="['nav-link',link =='/about'?'link_active':'']" to="/about">About</router-link>
            </li>
            <li class="nav-item">
                <router-link :class="['nav-link',link =='/contact'?'link_active':'']" to="/contact">Contact</router-link>
            </li>
            <Fragment>
                <li class="nav-item">
                    <router-link :class="['nav-link',link =='/user/orders'?'link_active':'']" to="/user/orders" v-if="isAuth">My Orders</router-link>
                </li>
                 <li class="nav-item">
                    <router-link :class="['nav-link',link =='/user/account'?'link_active':'']" to="/user/account" v-if="isAuth">Account Settings</router-link>
                </li>
                 <!--<li class="nav-item">
                    <router-link class="nav-link" to="/contact">LogOut</router-link>
                </li>-->
            </Fragment>
        </ul>
        <div class="d-none d-lg-block">
            <IconLink></IconLink>
        </div>
       
   </div>
</template>

<script>
import IconLink from "./IconLink.vue";
import NavBarTopMobile from "./NavBarTopMobile.vue";
import {Fragment} from "vue-fragment";
import {mapGetters}from "vuex";
export default {
    data(){
        return {collapsed:false,link:""}
    },
    //   mounted(){
    //     this.link = this.$route.path
    // },
    computed:{
      ...mapGetters(['isAuth'])
    },
    components:{IconLink,NavBarTopMobile,Fragment}
}
</script>

<style>

</style>