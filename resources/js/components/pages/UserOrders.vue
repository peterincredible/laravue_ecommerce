<template>
    <base-regular-two>
        <template #content>
             <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='/' class="">Home</router-link>
                        <router-link to='/dashboard' class="">Dashboard</router-link>
                        <span class="">Orders</span>
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
                                       <h4>Orders</h4>
                                       <Fragment v-if="!showMobile">
                                              <table>
                                                <tr class="tr-head">
                                                    <th class="pt_class">PRODUCT</th>
                                                    <th class="ot_class extend_width">TOTAL</th>
                                                    <th class="ot_class extend_width">DATE</th>
                                                    <th class="ot_class extend_width">REF ID</th>
                                                    <th class="ot_class extend_small">ACTION</th>
                                                </tr>
                                               <order-table v-for='(order,index) in orders' :order='order' :index='index' :key="index" @delete_order='delete_order'></order-table>
                                             </table>
                                       </Fragment>
                                       <Fragment v-if='showMobile'>
                                          <order-mobile v-for="(order,index) in orders" :key="index" :order='order' :index="index" @delete_order='delete_order'></order-mobile>
                                       </Fragment>
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
import BaseRegularTwo from "../BaseRegularTwo.vue";
import OrderMobile from "../OrderMobile.vue";
import OrderTable from "../Order.vue";
import {Fragment} from "vue-fragment";
import DashboardSidepanel from "../DashboardSidepanel.vue";
import axios from "../../utils/myaxios";
import  MyLoader from "../MyLoader.vue";

export default {
    data(){
        return {showMobile:false,orders:[],pageCount:0,links:[],page:0,page_loading:true}
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
        async delete_order(index){
            let order_id = this.orders[index].id;
            this.orders.splice(index,1);
            await axios.delete(`/api/order/del/${order_id}`);
            this.refresh_orders();
            
        },
         async functionName(pagenum){
               console.log(pagenum)
                let url = this.links[pagenum].url;
                console.log(url);
                try{
                    let {data} = await axios.get(url);
                    // console.log(data);
                    this.orders = data.orders.data;
                    this.page = data.orders.current_page;
                    // this.page_count = Math.floor(data.bookings.total/data.bookings.per_page);
                    this.links = data.orders.links;
                }catch(e){
                    console.dir(e)
                console.log("an error occured cliclcallback");
                }

           },
            async refresh_orders(){
                  let {data} = await axios.get(`/api/user/orders`)
                  this.orders = data.orders.data;
                  this.pageCount = data.orders.last_page;
                  this.page = data.orders.current_page;
                  this.links = data.orders.links
           }

    },
    async mounted(){
              try{
                  
                    if(window.innerWidth < 556){
                            this.showMobile = true;
                        }
                    window.addEventListener('resize',this.Resize);
                      let {data} = await axios.get(`/api/user/orders`)
                        this.orders = data.orders.data;
                        this.pageCount = data.orders.last_page;
                        this.page = data.orders.current_page;
                        this.links = data.orders.links
                        console.dir(data);

                      this.page_loading = false;  

              }catch(e){
                  console.dir(e)
              }       
    }

}
</script>

<style scoped>
table {
    width: 100%;
    height: auto;
    max-width: 992px;
    border-left: 1px solid #e6e6e6;
    border-right: 1px solid #e6e6e6;
    min-width: 530px;
}
.pt_class div p{
    color: #555;
    font-family: 'Poppins';
    font-weight: 400;
    font-size: 13px;
    margin-bottom:4px;
}

.pt_class div p.p_q{
    color:#888;
}
.extend_width{
    width:16.7%;
}
.extend_small{
    width:10%
}

</style>