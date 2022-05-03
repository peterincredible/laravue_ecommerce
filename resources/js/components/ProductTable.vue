<template>
  <table>
    <tr class="tr-head">
        <th class="pt_class">PRODUCT</th>
        <th class="ot_class extend_width">Price</th>
        <th class="ot_class extend_width">Description</th>
        <th class="ot_class extend_width ps-1">ACTION</th>
    </tr>
      <product-table-row v-for="(product,index) in products" :key="index" :product='product' @delete_product='delete_product'></product-table-row>
    </table>
</template>

<script>
 import ProductTableRow from "./ProductTableRow.vue";
 import axios from "../utils/myaxios";
export default {
    
    components:{ProductTableRow},
    props:['products'],
    methods:{
     async delete_product(product){
         try{
            console.log('event delete product triggered');
           let product_index = this.products.indexOf(product);
           if(product_index !== -1){
                    let {data} = await axios.delete(`/api/product/${product.id}`)
                    this.products.splice(product_index,1);
                    this.$emit('refresh_products');
                    this.$toasted.success('Product successfully deleted');
           }
         }catch(e){
             this.$toasted.error('sorry can\'t delete product');
         }  
     }
    },
   
}
</script>

<style scoped>
table {
    width: 100%;
    height: auto;
    max-width: 992px;
    border-left: 1px solid #e6e6e6;
    border-right: 1px solid #e6e6e6;
    min-width: 530px;
}
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
.extend_small{
    width:10%
}
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