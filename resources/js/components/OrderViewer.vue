<template>
  <div :class="['image_viewer_container animate__animated animate__fadeIn',show? '':'animate__fadeOut']">
       <div class="image_viewer_wrapper mt-3">
            <div class="image_viewer_cancel d-flex justify-content-end">
                <span @click="close"><font-awesome-icon icon="times" size="2x"></font-awesome-icon></span>
            </div>
            <div class="order_viewer_main mx-auto p-4"> 
                     <div class="uo_info_contianer d-flex justify-content-between align-center flex-wrap">
                          <div class="user_info p-4">
                                <span class="img_holder" style="color:#222; font-size:20px;">
                                    <font-awesome-icon :icon="['fas','fa-map-marker-alt']"  style=""></font-awesome-icon>
                                </span>
                                <div class="ms-3">
                                    <p>{{item.user.name}}</p>
                                    <p>{{item.phone_no}}</p>
                                    <p>{{item.street}},{{item.town}}</p>
                                    <p>{{item.local_govt}},{{item.state}}</p>
                                </div>
                          </div>
                          <div class="order_info p-4">
                                <div class="img_holder" style="color:#222; font-size:20px;">
                                        <font-awesome-icon :icon="['fas','fa-map-marker-alt']"  style=""></font-awesome-icon>
                                </div>
                                <div class="ms-3">
                                    <p>Order ID: {{item.ref}}</p>
                                    <p>Order placed: {{item.date}}</p>
                                </div>
                          </div>
                     </div>
                     <div class="product_info p-4">
                        <div class="prod_img">
                              <img alt="cant view image" :src="item.product.images[0].url"/>
                        </div>
                        <div class="prod_d ms-3">
                            <p class="name">{{item.product.product_name}}</p>
                            <p class="q_p"> {{item.quantity}} x &#8358;{{item.price}}</p>
                        </div>
                     </div>
                     <div  class="total_info p-4 ">
                         <p style="text-align:right">Total: &#8358;{{item.quantity * item.price}}</p>
                     </div>
            </div>
       </div>
  </div>
</template>

<script>
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

import VueSlickCarousel from 'vue-slick-carousel';

export default {
    props:['item'],
    components:{VueSlickCarousel,CoolLightBox},
    data(){
        return {quantity:1,carousel_index:0,image_index:null,show:true}
    },
    methods:{
        quantity_action(action){
           if(action == 'increase'){
               this.quantity +=1;
           }else if(action == 'decrease' && this.quantity > 1){
               this.quantity -= 1;
           }else{
               this.quantity = 1;
           }
        },
        next_btn(){
              this.$refs.carousel.next();
        },
        prev_btn(){
            this.$refs.carousel.prev();
        },
        afterchange(index){
            this.carousel_index = index;
            
        },
        show_lightbox(){
            this.image_index = this.carousel_index;
        },
        close(){
            this.show = false;
            setTimeout(()=>{this.$emit('close');},400);
            
        },
         async add(){
               this.show = false;
            setTimeout(()=>{
                this.$emit('add_to_cart',this.quantity)
                this.$emit('close');

                },400);
        }
    }

}
</script>

<style>

</style>