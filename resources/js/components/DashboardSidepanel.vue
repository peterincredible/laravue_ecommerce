<template>
   <div class="dashboard_sidepanel">
    <div>
        <h4>Dashboard</h4>
        <ul>
            <li class='py-2'><router-link to="/user/orders" :class="[link =='/user/orders'?'link_active':'']">My Orders</router-link></li>
            <li class='py-2 '><router-link to="/user/account" :class="[link =='/user/account'?'link_active':'']">Account Settings</router-link></li>
            <li class="py-2" v-if='!isAdmin'><a href="#"  @click.prevent="logout">Log Out</a></li>
        </ul>
        </div>
        <div class="mt-4" v-if='isAdmin'>
            <h4>Admin</h4>
            <ul>
                <li class='py-2'><router-link to="/admin/orders" :class="[link =='/orders'?'link_active':'']">All Orders</router-link></li>
                <li class='py-2'><router-link to="/admin/products" :class="[link =='/admin/products'?'link_active':'']">Products</router-link></li>
                <li class='py-2'><router-link to="/admin/categories" :class="[link =='/admin/categories'?'link_active':'']">Categories</router-link></li>
                <li class="py-2"><a href="#" @click.prevent="logout" >Log Out</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import axios from "../utils/myaxios";
export default {
    data(){
        return {link:""}
    },
    computed:{
        ...mapGetters(['isAdmin'])
    },
    mounted(){
        this.link = this.$route.path
        console.log(this.link);
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
.link_active{
   color:#717fe0 !important;
}
</style>