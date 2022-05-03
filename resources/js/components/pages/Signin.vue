<template>
    <base-regular-two>
       <template #content>
           <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='' class="">Home</router-link>
                        <span class="">Sing In</span>
                    </div>
                </div>
              </div>
             </div>
             <div class="row mt-5 mb-2">
                <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                    <div class="default-layout d-flex justify-content-between flex-wrap ">
                        <div class="w-100" style="height:700px;">
                                <div class="account_wrapper p-5 mt-4 mx-auto">
                                    <h4 class="text-center mb-4">Sign In</h4>
                                    <!--<p class="mb-4 account_error">Wrong Email or Password</p>-->
                                    <form class="account_form " @submit.prevent="submit">
                                        <div class="mb-3 sep">
                                          <span><img :src="image" /></span>
                                          <input type="text"  placeholder="Your Email Address" v-model="email"/>
                                        </div>
                                         <div class="mb-3 sep">
                                           <span><font-awesome-icon icon="lock" style="font-size:19px; color:#888"></font-awesome-icon></span>
                                          <input type="password"  placeholder="*****" v-model="password"/>
                                        </div>
                                        <button class="w-100" :disabled='isDisabled'>SIGN IN</button>
                                    </form>
                                    <p class="mt-2 redirect_account">Click this link to <router-link to="/signup">create Account</router-link></p>
                                </div>
                        </div>
                    </div>
                </div>
             </div>
             <my-loader :loading="page_loading"></my-loader>
       </template>
    </base-regular-two>
</template>

<script>
import BaseRegularTwo from "../BaseRegularTwo.vue";
 import image from "../../images/icons/icon-email.png";
 import axios from "../../utils/myaxios";
 import  MyLoader from "../MyLoader.vue";
export default {
    data(){
        return {image,email:"",password:'',isDisabled:false,page_loading:true}
    },
    methods:{
        async submit(){
           
            try{
                this.isDisabled = true;
                let email = this.email;
                let password = this.password;
                if(email =="" || password==""){
                    throw new Error('input field cant\'t be empty');
                }
                await axios.get('/sanctum/csrf-cookie');
                let {data} = await axios.post('/api/signin',{email,password});
                this.$store.commit('login',data.user)
                this.$store.commit('addcart',data.cart);
                this.$store.commit('addorders',data.orders);
                // console.dir(data.cart);
                localStorage['user'] = JSON.stringify(data.user);
                localStorage['cart'] = JSON.stringify(data.cart);
                localStorage['orders'] = JSON.stringify(data.orders);
                axios.login(data.user);
                 this.isDisabled = false;
                this.$router.push('/'); 
            }catch(e){
                console.dir(e);
                let message = e.response?e.response.data.message : e.message;
                this.isDisabled = false;
                this.$toasted.error(message);
              
            }      
        }
    },
    components:{BaseRegularTwo,MyLoader},
      mounted(){
         this.page_loading = false;  
    }

}
</script>

<style>

</style>