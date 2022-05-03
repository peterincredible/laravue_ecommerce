<template>
    <base-regular-two>
        <template #content>
            <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='/' class="">Home</router-link>
                        <router-link to='/dashboard' class="">Dashboard</router-link>
                        <span class="">Admin Categories</span>
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
                                           <div class="d-flex justify-content-between align-items-center mb-2">
                                              <h4>Categories</h4>
                                              <router-link to="/admin/category/add"><font-awesome-icon icon="plus" style="font-size:19px;color:#717fe0;" ></font-awesome-icon></router-link>
                                           </div>
                                              <category-table></category-table>
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
import CategoryTable from "../CategoryTable.vue";
 import  MyLoader from "../MyLoader.vue";
export default {
   components:{BaseRegularTwo,DashboardSidepanel,CategoryTable,MyLoader},
   data(){
       return {page_loading:true}
   },
   mounted(){
       this.page_loading = false;  
   }
}
</script>

<style>

</style>