<template>
  <div class="col-12 d-flex flex-column d-lg-none justify-content-between mx-auto" style="background-color:#222">
           <div class="default-layout d-flex flex-column ">
                 <p class="m-0 px-1 py-2 theader-container-p w-100 px-2 px-lg-0" style="border-bottom:0.2px solid #b2b2b2;">Free shipping for standard order over $100</p>
                 <ul class="theader-container theader-mobile-container mb-1 w-100 px-2 px-lg-0">
                    <li ><router-link  to="#" class="py-0 px-2">Help & FAQS</router-link></li>
                    <li v-if="!isAuth"><router-link  to="/signin" class="py-0 px-2">My Account</router-link></li>
                    <li v-if="isAuth"><a href="#" class="py-2 px-4"  @click.prevent="logout" >Log Out</a></li>
                </ul>
           </div>
       </div>
</template>

<script>
import axios from "../utils/myaxios";
import {mapGetters} from "vuex";
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

<style scoped>
.theader-mobile-container li {
    border-left: none;
    border-right: none;
}
.theader-mobile-container li a{
    border-left: 0.2px solid rgba(255,255,255,0.3);
    border-right: 0.2px solid rgba(255,255,255,0.3);
}
.theader-mobile-container li:first-of-type a{
   border-right: none;
}
</style>