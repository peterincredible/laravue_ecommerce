<template>
    <base-regular-two>
       <template #content>
           <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='' class="">Home</router-link>
                        <span class="">Shop</span>
                    </div>
                </div>
              </div>
             </div>
          <div class="row mt-3 mb-2">
            <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0"><!---->
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                  <h3 class="w-100" style="font-family:'Poppins'; font-weight:600; font-size: 36px;">PRODUCT OVERVIEW</h3>
                  <div class=" d-flex justify-content-between  align-items-center  flex-wrap w-100">
                         <ul class="product_category mb-2 mb-md-0">
                          <li><a href="#" 
                                @click.prevent="searchcatfunc(0)" 
                                :class="[search==0? 'stactive':' ' ]">All Products
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                  v-for="(category,index) in categories" :key="index"
                                  @click.prevent="searchcatfunc(category.id)" 
                                  :class="[search==category.id? 'stactive':' ' ]">{{category.category}}
                                  </a>
                            </li>
                        </ul>
                        <div class="product_selector ">
                            <ToggleButton text='Filter' icon='filter'  target="#collapseExample" :mykey='1' :openedkey="openedkey" @change-openedkey="keychanged"></ToggleButton>
                            <ToggleButton text='Search' icon='search'  target="#collapseExample2" :mykey='2' :openedkey="openedkey" @change-openedkey="keychanged"></ToggleButton>
                        </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-2">
          <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
              <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                <div class="w-100" id="myparent">
                    <div class="collapse" id="collapseExample" data-bs-parent="#myparent">
                        <search-filter   @search_order='orderby' @search_price_range='search_price_range' @search_price_above='search_price_above'></search-filter>
                    </div> 
                    <div class="collapse" id="collapseExample2" data-bs-parent="#myparent">
                        <search-component @search_small='search_small_change'></search-component>
                    </div> 
                </div>
              </div>
          </div>
        </div>
        <div class="row mt-4 mb-2">
            <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
              <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                      <product-item v-for="(product,index) in products" :key="index" :item='product'></product-item>
                      <div class="product_item" style="height: 10px;"></div>
                      <div class="product_item" style="height: 10px;"></div>
                      <div class="product_item" style="height: 10px;"></div>
                      <!--<p v-for="(product,index) in products" :key="index">{{product.product_name}}</p>-->
            </div>
          </div>
          <div v-if="!products.length" class="text-center w-100">sorry no product found or available</div>
        </div>
        <!--<div class="row mt-4 mb-2">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-center  align-items-center  flex-wrap ">
                        <button class="load_more p-2">LOAD MORE</button>
                </div>
              </div>
        </div>-->
        <my-loader :loading="page_loading"></my-loader>
       </template>
    </base-regular-two>
</template>

<script>
import BaseRegularTwo from "../BaseRegularTwo.vue";
import ProductItem from "../Product.vue";
import ToggleButton from "../ToggleButton.vue";
import SearchComponent from "../Search.vue";
import SearchFilter from "../SearchFilter.vue";
import  MyLoader from "../MyLoader.vue";
export default {
    components:{BaseRegularTwo,ProductItem,ToggleButton,SearchComponent,SearchFilter,MyLoader},
     data(){
        return{key:0,openedkey:0,products:[],search:0,categories:[],page_loading:true}
    },
    methods:{
      keychanged(newkey){
        this.openedkey= newkey
      },
      async searchcatfunc(search){
         this.search=search
         if(search !=0){
              let {data} = await axios.get(`/api/product/search/category/${search}`);
              this.products = data.product;
         }else{
             let {data} = await axios.get('/api/product');
             this.products = data.products;
         }   
      },
      async orderby(order){
        // console.log('orderby..',order);
        if(order == 'asc'){
            let {data} = await axios.get(`/api/product/search/orderby/${order}`);
            this.products = data.product;
            
        }else{
                 let {data} = await axios.get(`/api/product/search/orderby/${order}`);
                  this.products = data.product;
        }
      },
      async search_price_range(pricerange){
        let {data} = await axios.get(`/api/product/search/price/${pricerange.min}/${pricerange.max}`);
        this.products = data.product;
        // console.dir(data);
        // console.dir(pricerange);
      },
      async search_price_above(priceabove){
            let {data} = await axios.get(`/api/product/search/above/${priceabove}`);
            this.products = data.product;
            console.dir(data.product);
      },
      async search_small_change(text){
            let {data} = await axios.get(`/api/product/search/text/${text}`);
            this.products = data.product;
            // console.dir(data);
        //  console.log(text);
      }
    },
    async mounted(){
      try{
             let {data} = await axios.get('/api/product');
             this.products = data.products;
             let categories =await axios.get('api/category')
             this.categories = categories.data.categories
              this.page_loading = false;  
              console.log('shop mounted triggered',this.page_loading);
      }catch(e){
        console.dir(e);
      }
        
    }
}
</script>

<style>

</style>