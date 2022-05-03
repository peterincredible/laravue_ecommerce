<template>
    <base-regular-two>
        <template #content>
             <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='/' class="">Home</router-link>
                        <router-link to='/dashboard' class="">Dashboard</router-link>
                        <span class="">Account Settings</span>
                    </div>
                </div>
              </div>
             </div>
             <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  flex-wrap ">
                   <div class="w-100 d-flex justify-content-between">
                          <dashboard-sidepanel></dashboard-sidepanel>
                          <div class="dashboard_content">
                                <div class="w-100">
                                  <div class="account_wrapper p-5 mt-4 mx-auto">
                                    <h4 class="text-center mb-4">Account Settings</h4>
                                    <form class="account_form " @submit.prevent="submit">
                                        <div class="mb-3 sep">
                                           <span><font-awesome-icon icon="user" style="font-size:19px; color:#888"></font-awesome-icon></span>
                                          <input type="text"  placeholder="name" v-model="name"/>
                                        </div>
                                         <!--<div class="mb-3 sep">
                                           <span><font-awesome-icon icon="phone" style="font-size:19px; color:#888"></font-awesome-icon></span>
                                          <input type="text"  placeholder="phone no"/>
                                        </div>-->
                                        <div class="mb-3 sep">
                                          <span><font-awesome-icon :icon="['fas','fa-square-envelope']"  style="font-size:19px; color:#888"></font-awesome-icon></span>
                                          <input type="text"  placeholder="Your Email Address" v-model="email"/>
                                        </div>
                                        <button class="w-100" :disabled='isDisabled'>Save</button>
                                    </form>
                                  </div>
                                       
                                </div>
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
import image1 from "../../images/about-01.jpg";
import OrderMobile from "../OrderMobile.vue";
import OrderTable from "../Order.vue";
import {Fragment} from "vue-fragment";
import DashboardSidepanel from "../DashboardSidepanel.vue";
import  MyLoader from "../MyLoader.vue";
import {mapState} from "vuex";
import axios from "../../utils/myaxios";

export default {
    data(){
        return {image1,showMobile:false,page_loading:true,email:"",name:"",isDisabled:false}
    },
    components:{BaseRegularTwo,OrderMobile,OrderTable,Fragment,DashboardSidepanel,MyLoader},
    methods:{
        Resize(){
            if (window.innerWidth < 556){
                  if(this.showMobile != true){
                      this.showMobile = true
                  }
            }else{
                    if(this.showMobile != false){
                      this.showMobile = false
                  }
            }
        },
        async submit(){
                  this.isDisabled=true;  
                  try{
                        if(!this.name || !this.email){
                          throw new Error('input field can\'t be empty');
                        }
                         let details = {name:this.name,email:this.email,_method:'put'}
                         let {data} = await axios.post('/api/accountsettings',details);
                         let l_user = JSON.parse(localStorage['user']);
                         l_user.name = data.user.name;
                         l_user.email = data.user.email;
                         localStorage['user']=JSON.stringify(l_user);
                         this.$store.commit('updateUser',data.user);
                         this.$toasted.success('Account successfully updated');
                         this.isDisabled=false;  
                          
                  }catch(e){
                    this.isDisabled=false;  
                    if(e.response){
                       let user_errors = e.response.data;
                       for(let key in user_errors){
                            let message = `${key}  ${user_errors[key]}`
                            this.$toasted.error(message);
                       }
                    }else{
                       this.$toasted.error(e.message);
                    }
                    
                  }
        }

    },
    computed:{
       ...mapState(['user'])
    },
    mounted(){
                if(window.innerWidth < 556){
                      this.showMobile = true;
                }
        window.addEventListener('resize',this.Resize);
        this.name = this.user.name;
        this.email = this.user.email;
         this.page_loading = false;  

    }

}
</script>

<style scoped>

</style>