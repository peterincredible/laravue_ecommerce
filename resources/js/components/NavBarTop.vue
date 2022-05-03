<template>
  <div class="col-12 d-none d-lg-flex justify-content-center mx-auto" style="background-color:#222">
           <div class="default-layout d-flex justify-content-between  align-items-center">
                 <p class="m-0 p-1 theader-container-p">Free shipping for standard order over $100</p>
                 <ul class="theader-container m-0 ">
                    <li class="py-2 px-4"><router-link  to="#">Help & FAQS</router-link></li>
                    <li class="py-2 px-4" v-if="!isAuth"><router-link  to="/signin">My Account</router-link></li>
                    <li class="py-2 px-4" v-if="isAuth"><a href="#" @click.prevent="logout" >Log Out</a></li>
                </ul>
           </div>
       </div>
</template>

<script>
import {mapGetters} from "vuex";
import axios from "../utils/myaxios"
export default {
  computed:{
    ...mapGetters(['isAuth'])
  },
    methods:{
        async logout(){
            try{
                    await axios.get('/api/logout');
                    delete localStorage.user;
                    delete localStorage.cart;
                    delete localStorage.orders;
                    this.$store.commit('logout');
                    this.$store.commit('emptycart');
                    this.$store.commit('emptyorders');
                    
                    axios.logout();
                    this.$router.push('/signin');
            }catch(e){
                console.dir(e);
            }
        } 
    }

}
</script>

<style>

</style>