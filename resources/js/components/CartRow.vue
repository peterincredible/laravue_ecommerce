<template>
   <tr class="tr-body">
        <td class="pt_class d-flex align-items-center">
                <img :src="cart_item.product.images[0].url"/>
                <span>
                        <span>{{cart_item.product.product_name}}</span><br/>
                        <a href="#" @click.prevent='remove'>remove</a>
                </span>
        <td>
        <td class="ot_class">&#8358;{{cart_item.product.product_price}}</td>
        <td class="ot_q_class"><cart-quantity :item_quantity='cart_item.quantity' :cart_id='cart_item.id' @quantity_change='quantity_change'></cart-quantity></td>
        <td class="ot_class">&#8358;{{cart_item.quantity * cart_item.product.product_price}}</td>
    </tr>
</template>

<script>
 import CartQuantity from "./CartQuantity.vue";
export default {
    components:{CartQuantity},
    props:['cart_item'],
    methods:{
        remove(){
            let cart_id = this.cart_item.id;
            this.$store.dispatch('removeCart',cart_id);
        },
        quantity_change(quantity){
           this.cart_item.quantity = quantity
        }
    }
}
</script>

<style>
.tr-body .pt_class span a{
    color: red;
    text-decoration: none;
}
</style>