<template>
  <div class="sidecart_container" style="" @click.prevent="sideCartToggle">
        <div :class="['sidecart animate__animated animate__faster','animate__slideInRight',fade?'animate__slideOutRight':'  ']">
              <div class="sidecart_inner mt-5">
                    <div class="d-flex justify-content-between sidecart_header py-2 align-items-center">
                        <h4>YOUR CART</h4>
                        <span @click.stop.prevent="sideCartToggle" style="cursor:pointer;"><font-awesome-icon icon="times"  style="font-size:33px"></font-awesome-icon></span>
                    </div>

                    <div class="sidecart_prodcts_container mt-2" style="height:380px; overflow:auto">
                        <div class="sidecart_product d-flex justify-content-start align-items-center mt-2" v-for="(item,index) in cart" :key="index">
                            <div class="img_holder"> <img :src="item.product.images[0].url" alt="sorry can't display image" style="display: block;width: 100%;height: 100%;"/> </div>
                            <div class="sidecart_product_info">
                                <router-link to="#">{{item.product.product_name}}</router-link>
                                <p class="mt-2"> {{item.quantity}} x &#8358;{{item.product.product_price}}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="sidecart_footer">
                       <p class="my-5">Total: &#8358;{{cartTotal}}</p>
                       <div>
                          <a href="#" @click.stop.prevent="to_viewcart">VIEW CART</a>
                          <!--<router-link to="#">CHECK OUT</router-link>-->
                       </div>
                    </div>
              </div>
        </div>
  </div>
</template>

<script>
import image from "../images/item-cart-01.jpg";
import { mapState,mapGetters } from 'vuex';
export default {
      data(){
          return {image,fade:false}
      },
      computed:{
          ...mapState(['cart']),...mapGetters(['cartTotal'])
      },
      methods:{
           sideCartToggle(){
           
             this.fade=!this.fade;
             setTimeout(()=>{
                    this.$store.commit('cartToggle');
             },400);
            
        },
        to_viewcart(){
            this.fade=!this.fade;
            this.$store.commit('cartToggle');
            this.$router.push('/viewcart'); 
        }
      }
}
</script >
 
<style>

</style>