<template>
    <base-regular>
       <template #content>
             <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='' class="">Home</router-link>
                        <span class="">Shopping Cart</span>
                    </div>
                </div>
              </div>
             </div>
             <div class="row mt-5 mb-2" style="">
                <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                    <div class="default-layout d-flex justify-content-between flex-wrap ">
                         <div class="cart_main">
                             <div class="table_wrapper">
                                <table class="">
                                        <tr class="tr-head">
                                        <th class="pt_class">PRODUCT</th>
                                        <th class="ot_class">PRICE</th>
                                        <th class="ot_q_class">QUANTITY</th>
                                        <th class="ot_class">TOTAL</th>
                                        </tr>
                                        <cart-row v-for="(item,index) in cart" :key="index" :cart_item='item'></cart-row>
                                        
                                       
                                </table>
                                  <p v-if="!cart.length" class="text-center">sorry you dont have any items in cart</p>
                               </div>
                              <div class="cart_total py-5 px-3">
                                   <div style="max-width:450px;">
                                        <h4>CART TOTALS</h4>
                                        <table class="my-3" >
                                            <tr class="py-3 shipping" style="border-bottom:1px dashed #d9d9d9;">
                                                <td class="td_label">Shipping:</td>
                                                <td class="td_data">
                                                    <input type="text" placeholder="phone no" v-model="phone_no"/>
                                                    <input type="text" placeholder="State" v-model="state"/>
                                                    <input type="text" placeholder="Local govt" v-model="local_govt"/>
                                                    <input type="text" placeholder="Town" v-model="town"/>
                                                    <input type="text" placeholder="Street" v-model="street"/>
                                                </td>
                                            </tr>
                                            <tr class="py-2 total">
                                                <td class="td_label" style="font-size:18px;">Total:</td>
                                                <td class="td_data">&#8358;{{cartTotal}}</td>
                                            </tr>
                                         </table>
                                         <button class="w-100 btn-checkout px-4 py-3" @click="process_payment">PROCEED TO CHECKOUT</button>
                                   </div> 
                              </div>
                         </div>
                    </div>
                </div>
             </div>
            <my-loader :loading="page_loading"></my-loader>
       </template>
    </base-regular>
</template>

<script>
 import BaseRegular from "../BaseRegularTwo.vue";
 import CartRow from "../CartRow.vue";
import { mapState,mapGetters } from 'vuex';
import axios from "../../utils/myaxios";
import  MyLoader from "../MyLoader.vue";
export default {
    components:{BaseRegular,CartRow,MyLoader},
      computed:{
          ...mapState(['cart','user']),
          ...mapGetters(['cartTotal'])
      },
      methods:{
          async after_payment_success(order_details){
               try{
                     let {data} = await axios.post('/api/order/make',order_details);
                     localStorage['cart'] = JSON.stringify([]);
                     let old_orders = JSON.parse(localStorage['orders']);
                     let new_orders = [...data.orders,...old_orders];
                     localStorage['orders'] = JSON.stringify(new_orders);
                     this.$store.commit('emptycart');
                     window.location.href = '/success_checkout_page';
                    //  console.log(data);
               }catch(e){
                   console.dir(e);
                   this.$toasted.error(e.message);
               }
          },
          async process_payment(){
                try{ 
                         let phone_no = this.phone_no;
                         let state = this.state 
                         let local_govt = this.local_govt
                         let town = this.town;
                         let street  = this.street
                        if(!phone_no||!state ||!local_govt || !town ||!street){
                            throw new Error('sorry input field can\'t be empty');
                        }
                        
                        this.$launchFlutterwave({
                                    tx_ref: Date.now(),
                                    amount: this.cartTotal,
                                    currency: 'NGN',
                                    payment_options: 'card,mobilemoney,ussd',
                                    customer: {
                                    email: this.user.email,
                                    phonenumber: '08102909304',
                                    name: this.user.name
                                    },
                                    callback:(res)=>{
                                        if(res.status == 'successful'){
                                            let ref_id= res.transaction_id;
                                            let order_details = {phone_no,state,local_govt,town,street,ref_id}
                                            this.after_payment_success(order_details);
                                        }
                                    },
                                    customizations: {
                                    title: 'Cozar Store',
                                    description: 'Payment for items in cart',
                                    logo: 'https://assets.piedpiper.com/logo.png'
                                    }
                                });
                }catch(e){
                    console.log('testing');
                       console.dir(e.message);
                       this.$toasted.error(e.message);
                }
                
          }
      },
      data(){
          return {page_loading:true,phone_no:"",state:"",local_govt:"",town:'',street:""}
      },
     mounted () {
        // this.$refs.mapRef.$mapPromise.then((map) => {
        // map.panTo({lat: 1.38, lng: 103.80})
        //})
         this.page_loading = false;  
  }
}
</script>

<style>
.cart_total h4{
   font-family: "Poppins";
   font-weight: 600;
   color:#333;
   font-size: 20px;
}
.cart_total table tr{
display: flex;
}

.shipping{
display: flex;
width:100%;
justify-content: space-between;
}
.total{
display: flex;
width:100%;
justify-content: space-between;
}

.td_label{
width: 30%;
font-family: "Poppins";
font-weight: 500;
color:#333;
font-size:15px;
}

.td_data{
 width: 65%;
}
.td_data{
font-family: "Poppins";
font-weight: 400;
font-size: 18px;
color:#333;
}
.td_data input{
 width: 100%;
 margin-top:10px;
 margin-bottom:10px;
 padding:6px 10px;
 border:1px solid #e6e6e6;
 outline: none;
 color:#555;
 font-family:"Poppins";
 font-weight:400;
 font-size:13px;
 height: 40px;
}

.btn-checkout{
    background-color: #222;
    font-family: 'Poppins';
    font-weight: 500;
    color: #fff;
    border-radius: 30px;
    outline: none;
    border: none;
    transition: 0.25s all ease-in-out;
    text-decoration: none;
}

.btn-checkout:hover{
    background-color: #717fe0;
    color: #fff;

}


</style>