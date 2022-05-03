<template>
  <div class="om_wrapper p-4 mt-2">
        <div class="om_header">
          <span class="ref">Ref: 12345678</span>
          <span class="date">12 jun 2022</span>
        </div>
        <div class="om_body mt-3">
           <img :src='order.product.images[0].url'/>
           <div>
               <p>{{order.product.product_name}}</p>
               <p class="p_q">{{order.quantity}} x &#8358;{{order.price}}0</p>
           </div>
        </div>
        <div class="om_footer mt-4">
            <span class="total">Total: &#8358;{{order.quantity * order.price}}</span>
            <span class="actions">
               <!--<span class="view"> view</span>
               <span class="del" @click="del(index)">Delete</span>-->
                <span data-bs-toggle='tooltip' data-bs-placement='bottom' title='view product' @click="toggle_quick_view" style="cursor:pointer"> 
                  <font-awesome-icon icon="eye" style="font-size:15px;color:rgb(151 159 215)"></font-awesome-icon>
                </span>
            <!--<router-link :to="'/admin/product/edit/'+product.id" class="ms-2" data-bs-toggle='tooltip' data-bs-placement='bottom' title='edit product'>
                  <font-awesome-icon icon="edit" style="font-size:15px;color:#717fe0;" ></font-awesome-icon>
            </router-link>-->
                <span class="ms-2 del" data-bs-toggle='tooltip' data-bs-placement='bottom' title='delete product'  @click="del(index)">
                    <font-awesome-icon icon="trash" style="font-size:15px;color:#f05757;" ></font-awesome-icon>
                </span>
            </span>
        </div>
         <order-viewer v-if="view_order" @close='toggle_quick_view' :item='order'></order-viewer>
  </div>
</template>

<script>
import OrderViewer from './OrderViewer.vue';
export default {
  props:['order','index'],
   components:{OrderViewer},
   data(){
        return {view_order:false}
    },
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
.om_wrapper{
    border: 1px solid #e6e6e6;
    height: 220px;

}
.om_header{
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.om_header .ref{
    font-family: "Poppins";
    font-weight: 500;
    color:#333;
    font-size:15px
}
.om_header .date{
    font-family: "Poppins";
    font-weight: 400;
    color:#777;
    font-size:14px
}
.om_body{
   display: flex;
}
.om_body img{
    width: 60px;
    height: 80px;
    margin-right: 10px;
    image-rendering: -webkit-optimize-contrast;
}
.om_body div p{
    color: #555;
    font-family: 'Poppins';
    font-weight: 400;
    font-size: 14px;
    margin-bottom:4px;
}
.om_footer{
  display: flex;
  justify-content: space-between;
}
.om_footer .total{
    font-family: "Poppins";
    font-weight: 500;
    color:#333;
    font-size:15px;
    width:80%;
}
.om_footer .actions{
  width: 20%;
}
.om_footer .del{
    font-family: "Poppins";
    font-weight: 400;
    color:#777;
    font-size:15px;
    cursor: pointer;
    transition: 0.25s all ease-in-out;
}
.om_footer .del:hover{
    color: rgb(238, 53, 53);
}
</style>