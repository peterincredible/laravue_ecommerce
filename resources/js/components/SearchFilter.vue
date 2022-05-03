<template>
  <div class="d-flex flex-wrap  p-3 search_filter">
     <div class="search_filter_items mb-3 mb-md-0">
        <p class="mb-2">Sort By</p>
        <ul>
            <li><a href="#" @click.prevent='order("asc")'>Price:Low to High</a></li>
            <li><a href="#" @click.prevent='order("desc")'>Price:Low to High</a></li>
       </ul>
     </div>

     <div class="search_filter_items">
        <p class="mb-2">Price</p>
        <ul>
            <li><a href="#" @click.prevent='orderPrice({min:"0",max:"400"})'>&#8358;0 - &#8358;400.00</a></li>
            <li><a href="#" @click.prevent='orderPrice({min:"400",max:"600"})'>&#8358;400 - &#8358;600.00</a></li>
            <li><a href="#" @click.prevent='orderPrice({min:"600",max:"800"})'>&#8358;600 - &#8358;800.00</a></li>
            <li><a href="#" @click.prevent='orderPrice({min:"800",max:"1000"})'>&#8358;800 - &#8358;1000.00</a></li>
            <li><a href="#" @click.prevent='orderPriceAbove(1000)' > &#8358; 1000 Above </a></li>
        </ul>
     </div>
 </div>
</template>

<script>
export default {
   methods:{
     order(orderby){
       this.$emit('search_order',orderby);
     },
     orderPrice(pricerange){
             this.$emit('search_price_range',pricerange);
     },
     orderPriceAbove(priceabove){
        this.$emit('search_price_above',priceabove);
     }
   }
}
</script>

<style>

</style>