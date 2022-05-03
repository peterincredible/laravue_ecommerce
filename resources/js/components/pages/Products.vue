<template>
    <base-regular-two>
        <template #content>
            <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='/' class="">Home</router-link>
                        <router-link to='/dashboard' class="">Dashboard</router-link>
                        <span class="">Admin Products</span>
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
                                              <h4>Products</h4>
                                              <router-link to="/admin/product/add"><font-awesome-icon icon="plus" style="font-size:19px;color:#717fe0;" ></font-awesome-icon></router-link>
                                           </div>
                                            <product-table :products="products" @refresh_products='refresh_products'></product-table>
                                        </div>
                                        <div class="w-100 mt-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                  <paginate
                                                    v-model="page"
                                                    :pageCount="pageCount"
                                                    :clickHandler="functionName"
                                                    :prevText="'Prev'"
                                                    :prev-class='"prev_class"'
                                                    :nextText="'Next'"
                                                    :next-class='"next_class"'
                                                    :active-class='"active_class"'
                                                    :page-class="'page_class'"
                                                    :containerClass="'paginate_container'">
                                                 </paginate>
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
import ProductTable from "../ProductTable.vue";
import axios from "../../utils/myaxios";
 import  MyLoader from "../MyLoader.vue";
export default {
    data(){
        return {products:[],pageCount:0,links:[],page:0,page_loading:true}
    },
    methods:{
           async functionName(pagenum){
               console.log(pagenum)
                let url = this.links[pagenum].url;
                console.log(url);
                try{
                    let {data} = await axios.get(url);
                    // console.log(data);
                    this.products = data.products.data;
                    this.page = data.products.current_page;
                    // this.page_count = Math.floor(data.bookings.total/data.bookings.per_page);
                    this.links = data.products.links;
                }catch(e){
                    console.dir(e)
                console.log("an error occured cliclcallback");
                }

           },
           async refresh_products(){
                 let {data} = await axios.get(`/api/product/admin`)
                this.products = data.products.data;
                this.page = data.products.current_page;
                this.pageCount = data.products.last_page;
                this.links = data.products.links
           }
    },
   components:{BaseRegularTwo,DashboardSidepanel,ProductTable,MyLoader},
    async mounted(){
          try{
    
                let {data} = await axios.get(`/api/product/admin`)
                this.products = data.products.data;
                this.pageCount = data.products.last_page;
                this.page = data.products.current_page;
                this.links = data.products.links
                console.dir(data);
                // this.products = data.products;
                this.page_loading = false;  
           
         }catch(e){
             this.$toasted.error('sorry their might be an issue with the server');
         }  
    }
}
</script>

<style >
.paginate_container{
  display:flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  list-style-type: none;
}
.page_class{
   font-family: 'Poppins';
   font-weight: 400;
   /* padding:3px 7px; */
   border: 1px solid #e6e6e6;
   text-align: center;
   color:#717fe0;
   width:30px;
   padding:4px;
}
.prev_class,.next_class{
   font-family: 'Poppins';
   font-weight: 400;
   width:50px;
   border: 1px solid #e6e6e6;
   text-align: center;
   color:#717fe0;
    padding:4px;
}
.next_class{
   border-bottom-right-radius: 5px;
    border-top-right-radius: 5px;
}
.prev_class{
     border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}
.active_class{
  background-color:#717fe0;
  color:#fff;
}
</style>