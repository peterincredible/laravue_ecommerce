<template>
    <tr class="tr-body">
        <td class="pt_class d-flex align-items-center">
                <img :src="order.product.images[0].url"/>
                <div>
                    <p>{{order.product.product_name}}</p>
                    <p class="p_q">{{order.quantity}} x &#8358;{{order.price}}</p>
                </div>
        <td>
        <td class="ot_class extend_width">&#8358;{{order.quantity * order.price}}</td>
        <td class="ot_class extend_width">{{order.date}}</td>
        <td class="ot_class extend_width" style="text-align:center;">{{order.ref}}</td>
        <td class="ot_class extend_small del" style="text-align:center;">
              <span data-bs-toggle='tooltip' data-bs-placement='bottom' title='view product' @click="toggle_quick_view"> 
                  <font-awesome-icon icon="eye" style="font-size:15px;color:rgb(151 159 215)"></font-awesome-icon>
            </span>
            <!--<router-link :to="'/admin/product/edit/'+product.id" class="ms-2" data-bs-toggle='tooltip' data-bs-placement='bottom' title='edit product'>
                  <font-awesome-icon icon="edit" style="font-size:15px;color:#717fe0;" ></font-awesome-icon>
            </router-link>-->
            <span class="ms-2" data-bs-toggle='tooltip' data-bs-placement='bottom' title='delete product'  @click="del(index)">
                  <font-awesome-icon icon="trash" style="font-size:15px;color:#f05757;" ></font-awesome-icon>
            </span>
            <order-viewer v-if="view_order" @close='toggle_quick_view' :item='order'></order-viewer>
        </td>
        
    </tr>

    
</template>

<script>
import OrderViewer from './OrderViewer.vue';
export default {
    data(){
        return {view_order:false}
    },
    components:{OrderViewer},
    props:['order','index'],
    methods:{
        del(index){
            this.$emit('delete_order',index);
        },
        toggle_quick_view(){
            this.view_order=!this.view_order;
        }
    }

}
</script>

<style scoped>
.del{
    font-family: "Poppins";
    font-weight: 400;
    color:#777;
    font-size:15px;
    cursor: pointer;
    transition: 0.25s all ease-in-out;
}
.del:hover{
    color: rgb(238, 53, 53);
}
</style>