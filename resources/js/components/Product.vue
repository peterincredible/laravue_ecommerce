<template>
        <div class="product_item ">
                <div class="product_image_container"><!--
                        --><img :src="item.images[0].url" alt="image cant be displayed"/>
                        <button  class="p-2" @click="toggle_quick_view">Quick View </button>
                </div>
                <div class="product_name mt-1">
                    <router-link to="#">{{item.product_name}}</router-link>
                    <!--<span @click="addwishlist"><font-awesome-icon icon="heart" size="xs"></font-awesome-icon></span>-->
                </div>
                <p class="product_price">&#8358;{{item.product_price}}</p>
                <image-viewer  v-if="view_image" @close='toggle_quick_view' :images='item.images' :item='item' @add_to_cart='add_to_cart'></image-viewer>

        </div>
        <!-- <div v-if="view_image" :class="['animate__animated animate__fadeIn',view_image?'':'animate__fadeOut']">
            <image-viewer  @close='toggle_quick_view'></image-viewer>
        </div> -->
</template>

<script>
import {Fragment} from 'vue-frag';
// import {Fragment} from 'vue-fragment';
import ImageViewer from "./ImageViewer.vue"
import axios from "../utils/myaxios";
import {mapGetters} from "vuex";
export default {
    props:['item'],
    components:{Fragment,ImageViewer},
    data(){
        return {view_image:false}
    },
    computed:{...mapGetters(['isAuth'])},
    methods:{
        addwishlist(){
            this.$swal({
                icon: 'success',
                title: 'Pieces new Shirt',
                text: 'is added to wish list'
            });
        },
        toggle_quick_view(){
            this.view_image=!this.view_image;
            console.log('toggle_quick_view',this.view_image);
            
        },
        async add_to_cart(quantity){
            let product_id = this.item.id;
            console.log(this.isAuth,'this is isauth result');
            if(this.isAuth){
                this.$toasted.success(`${this.item.product_name} added to cart`)
                let {data} = await axios.post('/api/cart',{product_id,quantity});
                if(data.message == 'added new'){
                    this.$store.commit('addcart',[data.cart])
                     let cart = localStorage['cart']? JSON.parse(localStorage['cart']):[];
                     cart.push(data.cart);
                     localStorage['cart'] = JSON.stringify(cart);
                }
                console.log(data);
            }else{
                    this.$toasted.error('sign in to add to cart');
            }
            
        }
    }


}
</script>

<style>
.swal2-actions {  
    width: 100% !important;
    justify-content: flex-end !important;
}
.swal2-styled.swal2-confirm {
 
    margin-right: 30px !important;
    background-color: #717fe0 !important;
    font-family: 'Poppins';
    font-weight: 400;
    border:none !important;
}
.swal2-title {
    font-family: 'Poppins' !important;
    font-weight: 600 !important;
    font-size:18px !important;
}
.swal2-html-container {
font-family: 'Poppins' !important;
    font-weight: 400 !important;
    font-size:16px !important;
}
</style>