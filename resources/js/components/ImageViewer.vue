<template>
  <div :class="['image_viewer_container animate__animated animate__fadeIn',show? '':'animate__fadeOut']">
       <div class="image_viewer_wrapper mt-3">
            <div class="image_viewer_cancel d-flex justify-content-end">
                <span @click="close"><font-awesome-icon icon="times" size="2x"></font-awesome-icon></span>
            </div>
            <div class="image_viewer_main py-5 px-3">
                    <div class="image_slider_wrapper">
                            <div class="image_slides">
                                <div class="image_wrapper" v-for='(image,index) in images'  :key="index" :class="[index == carousel_index?'active_img':'']">
                                        <img :src="image.url" alt="image cant be displayed"  class="d-block w-100 h-100"/>
                                </div>
                            </div>
                            <div class="image_holder">
                            <CoolLightBox 
                                :items="images.map(image=>image.url)" 
                                :index="image_index"
                                :slideshow='false'
                                @close="image_index = null">
                            </CoolLightBox>
                                <vue-slick-carousel :arrows='false' :slidesToShow='1' ref='carousel' @afterChange='afterchange'>
                                        <img v-for='(image,index) in images'  :key="index" :src="image.url" class=" w-100 h-100" style=""/>
                                </vue-slick-carousel>
                                <span class="prev_btn" @click="prev_btn"><font-awesome-icon icon="less-than" style=""></font-awesome-icon></span>
                                 <span class="next_btn" @click="next_btn"><font-awesome-icon icon="greater-than" style=""></font-awesome-icon></span>
                                 <!--<span class="expand" @click='show_lightbox'><font-awesome-icon icon="expand" style=""></font-awesome-icon></span>-->
                                 <span class="expand" @click='show_lightbox'><font-awesome-icon :icon="['fas','fa-up-right-and-down-left-from-center']" ></font-awesome-icon></span>
                            </div>
                    </div>
                    <div class="product_image_details mt-2 mt-md-0 ps-md-3">
                       <h4 class="mb-3">{{item.product_name}}</h4>
                       <h5 class="">&#8358;{{item.product_price}}</h5>
                       <p class="mt-3">{{item.product_description}}</p>
                        <!--<div class="action-wrapper">
                               <div>
                                    <span @click="quantity_action('decrease')"><font-awesome-icon icon="minus" size="lg" ></font-awesome-icon></span>
                                    <input type="number" v-model="quantity"/>
                                    <span @click="quantity_action('increase')"><font-awesome-icon icon="plus" size="lg"></font-awesome-icon></span>
                                </div>
                        </div>-->
                        <div class="mt-4"><a href='#' class='add_to_cart px-4 py-2' @click.prevent='add'>ADD TO CART</a></div>
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
    props:['images','item'],
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
.slick-slider{
    height: 100%;
}
.slick-list {
    height: 100%;
}
.slick-track,.slick-slide,.slick-slide div{
  height:100%;
}
.prev_btn,.next_btn{
 position: absolute;
 background-color: rgba(0,0,0,0.5);;
 width: 40px;
 height: 40px;
 cursor: pointer;
 display: flex;
 justify-content: center;
 align-items: center;
 top:0;
 bottom: 0;
 color: #fff;
 transition: 0.25s all ease-in-out;
}
.prev_btn:hover,.next_btn:hover{
background-color: rgba(0,0,0,0.9);
}

.prev_btn{
  left: 0;
  margin-top: auto;
  margin-bottom: auto;
}
.next_btn{
  right: 0;
  margin-top: auto;
  margin-bottom: auto;
}
.active_img{
border:2px solid #ccc;
}
.expand{
position:absolute;
background-color: #fff;
color:#1d1d1d;
width: 40px;
height: 40px;
border-radius: 50%;
transition: 0.25s all ease-in-out;
top:10px;
right: 10px;
display: flex;
justify-content: center;
align-items: center;
cursor: pointer;
}
.expand:hover{
background-color:#717fe0;;
color:#fff;
}
</style>