<template>
    <base-regular-two>
        <template #content>
            <div class="row mb-5 mt-4">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div class="m_breadcrumb">
                        <router-link to='/' class="">Home</router-link>
                        <router-link to='/dashboard' class="">Dashboard</router-link>
                        <span class="">Admin Products</span>
                    </div>
                </div>
              </div>
             </div>
               <div class="row mb-5 mt-4">
                    <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                        <div class="default-layout d-flex justify-content-between  flex-wrap ">
                            <div class="w-100 d-flex justify-content-between">
                                <dashboard-sidepanel></dashboard-sidepanel>
                                    <div class="dashboard_content">
                                        <div class="w-100">
                                              <div class="account_wrapper p-5 mt-4 mx-auto">
                                                <h4 class="text-center mb-4">EDIT PRODUCT</h4>
                                                <!--<p class="mb-4 account_error">ERROR CAN'T SAVE</p>-->
                                                <form class="account_form " @submit.prevent="submit">
                                                    <div class="mb-3 sep">
                                                        <input type="text" placeholder="product name" v-model="product.product_name"/>
                                                    </div>
                                                    <div class="mb-3 sep">
                                                       <input type="number"  placeholder="product price" min='1' v-model="product.product_price"/>
                                                    </div>
                                                    <div class="mb-3 sep">
                                                       <select v-model="product.product_category">
                                                          <option v-for="(category,index) in categories" :value="category.id" :key='index' >{{category.category}}</option>
                                                       </select>
                                                    </div>
                                                    <textarea class="mb-3" v-model="product.product_description">
                                                            little description of your product
                                                    </textarea>
                                                    <VueFileAgent
                                                     :multiple='true'
                                                     :maxFiles='3'
                                                     :accept="'image/*'"
                                                     :deletable='true'
                                                     @select='selectedImage'
                                                     @beforedelete="beforedelete"
                                                     v-model='uploadedImages'
                                                    >
                                                    </VueFileAgent>
                                                    <button class="w-100 mt-3">SAVE</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
               </div>
                <my-loader :loading="page_loading"></my-loader>
        </template>
    </base-regular-two>
</template>

<script>
import DashboardSidepanel from "../DashboardSidepanel.vue";
import BaseRegularTwo from "../BaseRegularTwo.vue";
import FormData from "form-data";
 import  MyLoader from "../MyLoader.vue";
export default {
   components:{BaseRegularTwo,DashboardSidepanel,MyLoader},
   data(){
         let product ={product_name:"example",product_price:500,product_description:"describe product",product_category:2};
      return {
               categories:[],
               product,
               uploadedImages:[],selectedImages:[],
               page_loading:true
            }
   },
   methods:{
       selectedImage($event){
           console.log('selected images');
           this.selectedImages=[...this.selectedImages,...$event];
           console.dir(this.selectedImages);
       },
       async beforedelete(filerecord){
           try{
                 //check if file is not in the server if true then delete it from the selectedimages and the uploadedimage else then 
                 //just delete it from the server and also from the uploadedimage array alone
                 let selectedImages_index = this.selectedImages.indexOf(filerecord);
                if(selectedImages_index !== -1){
                        this.selectedImages.splice(selectedImages_index,1);
                        let uploadedImages_index = this.uploadedImages.indexOf(filerecord);
                        this.uploadedImages.splice(uploadedImages_index,1);
                }else{
                    let {data} = await axios.delete(`/api/product/image/delete/${filerecord.id}`);
                    let file_index = this.uploadedImages.indexOf(filerecord);
                    this.uploadedImages.splice(file_index,1);
                    console.log('new uploaded file deleted');
                }
           }catch(e){
                    console.dir(e);
           } 
       },
        async submit(){
           try{
               this.isDisabled=true; 
                let image_length = this.selectedImages.length + this.uploadedImages.length;
                if(this.product.product_name.length < 1 ||  this.product.product_description.length < 1 || this.product.product_category < 1 || image_length < 1){
                       this.isDisabled=false; 
                       this.$toasted.error('sorry empty input field');
                  return;
                 }
                            let formdata = new FormData();
                            this.selectedImages.forEach(file=>{formdata.append('images[]',file.file)});
                            let options ={
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }
                            let product_id = this.$route.params.product_id;
                            formdata.append('product_description',this.product.product_description);
                            formdata.append('product_name',this.product.product_name);
                            formdata.append('product_category',this.product.product_category);
                            formdata.append('product_price',this.product.product_price);
                            formdata.append('_method','put')
                            // console.dir(formdata);
                            let data = await axios.post(`/api/product/${product_id}`,formdata,options);
                            // console.dir(data);
                            this.isDisabled=false; 
                            this.$toasted.success('New Product Added Successfully');
                            // console.log(this.product.product_name);
                            // console.log(this.product.product_description);
                            // console.log(this.product.product_price);
                            // console.log(this.product.product_category);
                            
           }catch(e){
            //    console.dir(e);
               this.isDisabled=false; 
               this.$toasted.error('sorry something wen\'t wrong');
           }
       },
   },
    async mounted(){
       try{
           let {product_id} =this.$route.params
           let {data} = await axios.get(`/api/product/${product_id}`)
           
           this.product = data.product;
           this.product.product_category = data.product.category_id;
           this.uploadedImages= data.product.images;

           let res =await axios.get('/api/category');
            this.categories =res.data.categories;
        //    this.rawUploadedImages = data.product.images;
        //    for(let image of this.rawUploadedImages){
        //        image.url = '/storage/'+image.url;
        //        this.uploadedImages.push(image);
        //         //   console.dir(image);
        //    }
        //    console.log(this.rawUploadedImages);

          this.page_loading = false;  
       }catch(e){
              console.log(e);
       }
   }
}
</script>

<style scoped>
.account_wrapper .account_form div.sep input, .account_wrapper .account_form div.sep input:focus-visible {
    border: none;
    outline: none;
    width: 100%;
    font-family: 'Poppins';
    font-weight: 400;
    font-size: 13px;
    color: #333;
}
.account_wrapper .account_form div.sep select{
 border: none;
 outline: none;
 width: 100%;
 font-family: 'Poppins';
 font-weight: 400;
 font-size: 13px;
 color: #333;
}
.account_wrapper .account_form div.sep textarea{
    border: none;
    outline: none;
    width: 100%;
    font-family: 'Poppins';
    font-weight: 400;
    font-size: 13px;
    color: #333;

}
.account_wrapper .account_form textarea {
    border: 1px solid #e6e6e6;
    font-family: 'Poppins';
    font-weight: 400;
    font-size: 13px;
    color: #333;
    outline: none;
    width: 100%;
    padding: 10px 25px;
    min-height: 230px;
}
.account_wrapper .account_form div.sep input[type=number]::-webkit-inner-spin-button, 
.account_wrapper .account_form div.sep input[type=number]::-webkit-outer-spin-button{
-webkit-appearance: none;
appearance: none;

}
</style>