<template>
    <Fragment>
        <div class="action-wrapper">
            <div>
                <span @click="quantity_action('decrease')"><font-awesome-icon icon="minus" size="lg" ></font-awesome-icon></span>
                <input type="number" v-model="quantity"/>
                <span @click="quantity_action('increase')"><font-awesome-icon icon="plus" size="lg"></font-awesome-icon></span>
            </div>
        </div>
    </Fragment> 
</template>

<script>
import {Fragment} from "vue-fragment";
import { debounce } from "debounce";
export default {
    components:{Fragment},
    props:['item_quantity','cart_id'],
    data(){
       return {quantity:1}
    },
    mounted(){
        this.quantity = this.item_quantity;
    },
    methods:{
        action_dispatcher:debounce(function(){
            let cart_details = {cart_id:this.cart_id,quantity:this.quantity}
            this.$emit('quantity_change',this.quantity)
            this.$store.dispatch('updateCart',cart_details)
        },500),
        quantity_action: function(action){
           if(action == 'increase'){
               this.quantity +=1;
               
           }else if(action == 'decrease' && this.quantity > 1){
               this.quantity -= 1;
           }else{
               this.quantity = 1;
           }
            this.action_dispatcher();
        }
    }
}
</script>

<style>
.action-wrapper div {
    width: 125px;
    justify-content: center;
    align-items: center;
    display: flex;
    border: 1px solid #e6e6e6;
    height: 40px;
}
.action-wrapper div input,.action-wrapper div span{
    width: 45px;
}
.action-wrapper div span {
    display: flex;
    justify-content: center;
    align-items: center;
    color: #555;
    cursor: pointer;
    transition: 0.25s all ease-in-out;
    height: 100%;
}
.action-wrapper div span:hover {
    text-align: center;
    color: #fff;
    background-color: #717fe0;
    cursor: pointer;
    transition: 0.25s all ease-in-out;
}
.action-wrapper div input,.action-wrapper div input:focus-visible {
    height: 100%;
    color: #666;
    background-color: #f7f7f7;
    border-top: none;
    border-bottom: none;
    border-left: 1px solid #e6e6e6;
    border-right: 1px solid #e6e6e6;
    outline: none;
    font-size: 16px;
    text-align: center;
    margin: 0;
}
</style>