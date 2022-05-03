<template>
    <base-regular-two>
        <template #content>
             <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='/' class="">Home</router-link>
                        <span class="">Dashboard</span>
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
                                       <h5>Recent Orders</h5>
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
        return {showMobile:false,orders:[],page_loading:true}
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
            let {data} = await axios.delete(`/api/order/del/${order_id}`);
            console.log(data);
        }

    },
    async mounted(){
                let {data} = await axios.get('/api/orders/dashboard');
                this.orders = data.orders.slice(0,5);
                console.dir(this.orders);
                if(window.innerWidth < 556){
                      this.showMobile = true;
                }
        window.addEventListener('resize',this.Resize);
         this.page_loading = false;  
 
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