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
                                                <h4 class="text-center mb-4">ADD PRODUCT</h4>
                                                <!-- <p class="mb-4 account_error">ERROR CAN'T SAVE</p> -->
                                                <form class="account_form " @submit.prevent='submit'>
                                                    <div class="mb-3 sep">
                                                        <input type="text" placeholder="product name" v-model='product_name'/>
                                                    </div>
                                                    <div class="mb-3 sep">
                                                       <input type="number"  placeholder="product price" min='0' v-model='product_price'/>
                                                    </div>
                                                    <div class="mb-3 sep">
                                                       <select v-model="product_category">
                                                         <option v-for="(category,index) in categories" :value="category.id" :key='index' >{{category.category}}</option>
                                                         <!-- <option value="2">Femaile</option>
                                                         <option value="3">Unisex</option> -->
                                                       </select>
                                                    </div>
                                                    <textarea class="mb-3" v-model="product_description"> little description of your product</textarea>
                                                    <VueFileAgent
                                                     :multiple='true'
                                                     :maxFiles='3'
                                                     :accept="'image/*'"
                                                     :deletable='true'
                                                     @beforedelete="deleteToUploadImage"
                                                     v-model='uploadeImage'
                                                    >
                                                    </VueFileAgent>
                                                    <button class="w-100 mt-3" :disabled='isDisabled'>ADD PRODUCT</button>
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
import axios from "../../utils/myaxios";
import FormData from "form-data";
 import  MyLoader from "../MyLoader.vue";
export default {
    data(){
        return {categories:[],uploadeImage:[],product_name:"",product_price:"",product_description:"",product_category:2,isDisabled:false,page_loading:true}
    },
   components:{BaseRegularTwo,DashboardSidepanel,MyLoader},
   methods:{
       deleteToUploadImage(filerecord){
           let file_index = this.uploadeImage.indexOf(filerecord);
           console.dir(filerecord)
           if(file_index !== -1){
                 this.uploadeImage.splice(file_index,1);
           }
       },
       async submit(){
           try{
               this.isDisabled=true;  
                if(this.product_name.length < 1 ||  this.product_description.length < 1 || this.product_category.length < 1 || this.uploadeImage.length < 1){
                       this.isDisabled=false; 
                       this.$toasted.error('sorry empty input field');
                  return;
                 }
                        let formdata = new FormData();
                            this.uploadeImage.forEach(file=>{formdata.append('images[]',file.file)});
                            let options ={
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }
                            formdata.append('product_description',this.product_description);
                            formdata.append('product_name',this.product_name);
                            formdata.append('product_category',this.product_category);
                            formdata.append('product_price',this.product_price);
                            let {data} = await axios.post('/api/product',formdata,options);
                            console.dir(data);
                            this.product_name="";
                            this.product_description="";
                            this.product_price='1';
                            this.uploadeImage=[];
                            this.isDisabled=false; 
                            this.$toasted.success('New Product Added Successfully');
           }catch(e){
               console.dir(e);
               this.isDisabled=false; 
               this.$toasted.error('sorry something wen\'t wrong');
           }
       },

   },
   async mounted(){
       try{
            let {data} =await axios.get('/api/category');
            this.categories =data.categories;
            // console.log(this.categories);
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

.account_wrapper .account_form div.sep .is-drag-valid,.is-sortable-disabled{
 /* border:none !important; */
 padding: 0px !important;
 display:block !important;
}

.vue-file-agent.file-input-wrapper{
 border: 2px dashed #aaa !important;
 padding: 0px !important;
 display: static !important;
 width: 100%;

}
</style>