<template>
  <tr class="tr-body">
        <td class="pt_class d-flex align-items-center">
                <img :src="product.images[0].url"/>
                <div>
                    <p>{{product.product_name}}</p>
                </div>
        <td>
        <td class="ot_class extend_width">&#8358;{{product.product_price}}</td>
        <td class="ot_class extend_width">{{product.product_description.slice(1,15)+ "..."}}</td>
        <td class="ot_class extend_width ps-1">
            <span data-bs-toggle='tooltip' data-bs-placement='bottom' title='view product' @click="toggleview"> 
                  <font-awesome-icon icon="eye" style="font-size:15px;color:rgb(151 159 215)"></font-awesome-icon>
            </span>
            <router-link :to="'/admin/product/edit/'+product.id" class="ms-2" data-bs-toggle='tooltip' data-bs-placement='bottom' title='edit product'>
                  <font-awesome-icon icon="edit" style="font-size:15px;color:#717fe0;" ></font-awesome-icon>
            </router-link>
            <span class="ms-2" data-bs-toggle='tooltip' data-bs-placement='bottom' title='delete product' @click.prevent="del()">
                  <font-awesome-icon icon="trash" style="font-size:15px;color:#f05757;" ></font-awesome-icon>
            </span>
        </td>
        <product-viewer v-if="showproduct" @close='toggleview' :product='product'></product-viewer>
    </tr>
</template>

<script>
import image1 from "../images/about-01.jpg";
import ProductViewer from "./ProductViewer.vue";
export default {
    components:{ProductViewer},
    props:['product'],
     data(){
        return {image1,showproduct:false}
    },
    methods:{
        toggleview(){
            this.showproduct = !this.showproduct;
        },
        del(){
            this.$emit('delete_product',this.product);
        }
    }
}
</script>

<style scoped>
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
    width:20%;
}

.extend_width span{
    cursor: pointer;
}
</style>