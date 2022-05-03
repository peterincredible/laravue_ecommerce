<template>
    <base-regular-two>
        <template #content>
            <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='/' class="">Home</router-link>
                        <router-link to='/dashboard' class="">Dashboard</router-link>
                        <span class="">Admin Category</span>
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
                                                <h4 class="text-center mb-4">ADD CATEGORY</h4>
                                                <!-- <p class="mb-4 account_error">ERROR CAN'T SAVE</p> -->
                                                <form class="account_form " @submit.prevent="submitCategory">
                                                    <div class="mb-3 sep">
                                                        <input type="text" placeholder="CATEGORY" v-model="cat"/>
                                                    </div>
                                                    <button class="w-100">ADD CATEGORY</button>
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
import DashboardSidepanel from "../DashboardSidepanel.vue";
import BaseRegularTwo from "../BaseRegularTwo.vue";
import axios from "../../utils/myaxios";
 import  MyLoader from "../MyLoader.vue";
export default {
    data(){
        return {cat:"",page_loading:true}
    },
   components:{BaseRegularTwo,DashboardSidepanel,MyLoader},
   methods:{
       async submitCategory(){
             try{
                       if(this.cat.length >1){
                            let cat = this.cat;
                            let data = await axios.post('/api/category',{cat});
                            this.$toasted.success(data.data.message)
                            this.cat = "";

                        }else{
                            throw new Error('category input can\'t be empty client');
                        }
             }catch(e){
                 
                  let message = e.response? e.response.data.message : e.message;
                  this.$toasted.error(message)
             }
       }
   },
   mounted(){
       this.page_loading = false;  
   }
}
</script>

<style scoped>
.account_wrapper .account_form div.sep input, .account_wrapper .account_form div.sep input:focus-visible {
    border: none;
    outline: none;
    width: 100%;
    font-family: 'Poppins';
    font-weight: 400;
    font-size: 13px;
    color: #333;
}
</style>