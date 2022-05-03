<template>
   <ul class="navbar-nav  mb-0 mb-lg-0 flex-row mb-0">
        <!--<li class="nav-item">
            <a class="nav-link mx-2" href="#" @click.prevent='searchHeaderToggle()'>
                <font-awesome-icon icon="search"  style="font-size:19px; color:#333"></font-awesome-icon>
            </a>
        </li>-->
         <li class="nav-item">
            <a class="nav-link mx-2" href="#" @click.prevent="sideCartToggle()">
                 <span class="badge">{{cartLength}}</span>
                <font-awesome-icon icon="shopping-cart" style="font-size:19px;color:#333;" ></font-awesome-icon>
            </a>
        </li>
       
       
  </ul>
</template>l

<script>
import {mapGetters} from "vuex";
  /*<li class="nav-item">
            <a class="nav-link mx-2 " href="#">
                    <span class="badge">2</span>
                <font-awesome-icon icon="heart" style="font-size:19px; color:#333"></font-awesome-icon>
            </a>
        </li>*/
export default {
    methods:{
        sideCartToggle(){
             this.$store.commit('cartToggle');
        },
        searchHeaderToggle(){
             this.$store.commit('searchHeaderToggle');
        }
    },
    computed:{
        ...mapGetters(['cartLength'])
    }

}
</script>

<style>

</style>