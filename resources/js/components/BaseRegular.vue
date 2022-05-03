<template>
<Fragment>
   <div class="row"><NavBarTop></NavBarTop></div>
   <div class="row">
        <HeaderComponent></HeaderComponent>
        <slot name="banner">
          
        </slot>
   </div>
    <slot name="content">
    </slot>
    <Footer></Footer>
    <side-cart v-if="isCartVisible"></side-cart>
    <search-header v-if="isSearchHeaderVisible"></search-header>
    <scroll-header></scroll-header>
    
</Fragment>
</template>

<script>
//
import HeaderComponent from "./Header2.vue";
import {Fragment} from "vue-fragment";

import NavBarTop from "./NavBarTop.vue";


import SearchComponent from "./Search.vue";
import searchFilter from "./SearchFilter.vue";
import Footer from "./Footer.vue";
import SideCart from "./SideCart.vue";
import { mapGetters } from 'vuex';
import SearchHeader from "./SearchHeader.vue";
import ScrollHeader from './ScrollHeader.vue';
import LoginMixin from "../utils/loginMixin";


export default {
  mixins:[LoginMixin],
    components:{HeaderComponent,Fragment,
               NavBarTop,SearchComponent,
                searchFilter,Footer,
                SideCart,SearchHeader,
                ScrollHeader
                },
    data(){
        return{openedkey:0}
    },
    methods:{
      keychanged(newkey){
        this.openedkey= newkey
      }
    },
    
    // async mounted(){
    //    console.log('base mounted triggered');
            
    // },
    computed:{...mapGetters(['isCartVisible','isSearchHeaderVisible'])}
  
   
}


</script>

<style>
.ic{
    color: #333;
}



</style>