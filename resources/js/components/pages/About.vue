<template>
    <base-regular>
       <template #banner>
             <div class="banner"> <h3 class="">About</h3></div>
       </template>
       <template #content>
             <div class="row mt-5 mb-2">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                     <div class="about_wrapper mt-2">
                         <div class="about_story">
                                <h5 class="mb-3">Our Story</h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim,
                                     non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt 
                                     augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                                     Maecenas varius egestas diam, eu sodales metus scelerisque congue. Pellentesque habitant morbi 
                                     tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu 
                                     egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut 
                                     enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec condimentum 
                                     euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.
                                </p>
                                 <p>
                                    Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam 
                                    imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. 
                                    Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam 
                                    pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. 
                                    Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac 
                                    ligula
                                </p>
                         </div>
                         <div class="about_img">
                            <div class="img_wrapper w-100 h-100">
                                <img :src="image1" alt="can't display image" class="w-100 h-100"/>
                            </div>
                         </div>
                     </div>
                      <div class="about_wrapper my-5 ">
                         <div class="mission_wrapper order_w">
                            <div class="img_wrapper w-100 h-100">
                                <img :src="image2" alt="can't display image" class="w-100 h-100"/>
                            </div>
                         </div>
                         <div class="about_story order_s">
                                <h5 class="mb-3">Our Mission</h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim,
                                     non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt 
                                     augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                                     Maecenas varius egestas diam, eu sodales metus scelerisque congue. Pellentesque habitant morbi 
                                     tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu 
                                     egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut 
                                     enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec condimentum 
                                     euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.
                                </p>
                                 <p>
                                    Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam 
                                    imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. 
                                    Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam 
                                    pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. 
                                    Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac 
                                    ligula
                                </p>
                         </div>
                     </div>
                </div>
              </div>
             </div>
            <my-loader :loading="page_loading"></my-loader>
       </template>
    </base-regular>
</template>

<script>
 import BaseRegular from "../BaseRegular.vue";
 import image1 from "../../images/about-01.jpg";
 import image2 from "../../images/about-02.jpg";
  import  MyLoader from "../MyLoader.vue";
export default {
    components:{BaseRegular,MyLoader},
    data(){
        return {image1,image2,page_loading:true}
    },
     mounted () {
       
         this.page_loading = false;  
    
  }
}
</script>

<style>

</style>