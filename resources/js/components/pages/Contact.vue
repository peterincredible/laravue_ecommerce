<template>
    <base-regular>
       <template #banner>
             <div class="banner"> <h3 class="">Contact</h3></div>
       </template>
       <template #content>
             <div class="row mt-4 mb-2">
              <div class="col-12 d-md-flex justify-content-center  px-0 mx-auto  px-lg-3 px-2 px-lg-0">
                <div class="default-layout d-flex justify-content-between  align-items-center  flex-wrap ">
                    <div style="width:100%;">
                         <div class="contact_wrapper">
                             <div class="message p-5">
                                    <h4 class="mb-4">Send Us A Message</h4>
                                    <form>
                                        <div class="mb-3">
                                          <span><img :src="image" /></span>
                                          <input type="text"  placeholder="Your Email Address"/>
                                        </div>
                                        <textarea class='mb-3' ></textarea>
                                        <button class="w-100 d-block">SUBMIT</button>
                                    </form>
                             </div>
                             <div class="info p-5 ">
                                 <div class="info_wrapper">
                                     <div class="d-flex justify-content-between">
                                       <span style="color:#222; font-size:18px;"><font-awesome-icon :icon="['fas','fa-map-marker-alt']"  style=""></font-awesome-icon></span>
                                       <div style="width:90%" class="">
                                           <h5>Address</h5>
                                           <p style="color: #888;">Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US</p>
                                       </div>
                                     </div>
                                     <div class="d-flex justify-content-between mt-4">
                                       <span style="color:#222; font-size:18px;"><font-awesome-icon :icon="['fas','fa-phone']"  style=""></font-awesome-icon></span>
                                       <div style="width:90%" class="">
                                           <h5>Address</h5>
                                           <p style="color:#717fe0;">+1800 1236879</p><!---->
                                       </div>
                                     </div>
                                     <div class="d-flex justify-content-between mt-4">
                                       <span style="color:#222; font-size:18px;"><font-awesome-icon :icon="['fas','fa-square-envelope']"  style=""></font-awesome-icon></span>
                                       <div style="width:90%" class="">
                                           <h5>Sale Support</h5>
                                           <p style="color:#717fe0;">contact@example.com</p>
                                       </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
              </div>
             </div>
             <div class="row mt-4">
                <div class="col-12 px-0">
                <gmap-map
                    :center="{lat: 6.832201, lng:3.631913}"
                    :zoom="11"
                    map-type-id="terrain"
                    style="width: 100%; height: 500px"
                    :options="{zoomControl: false,gestureHandling:'none'}"
                    >
                    <gmap-marker
                    :key="index"
                    v-for="(m, index) in markers"
                    :position="m.position"
                     @click="center=m.position"
                    
                    >
                    </gmap-marker>
                
                </gmap-map>
                </div>
             </div>
              <my-loader :loading="page_loading"></my-loader>
       </template>
    </base-regular>
</template>

<script>
 import BaseRegular from "../BaseRegular.vue";
 import Banner from "../../images/bg-01.jpg";
 import image from "../../images/icons/icon-email.png";
  import  MyLoader from "../MyLoader.vue";

    //  <GmapMarker
    //                     :key="index"
    //                     v-for="(m, index) in markers"
    //                     :position="m.position"
    //                     :clickable="true"
    //                     :draggable="true"
    //                     @click="center=m.position"
                        

    //                 />
export default {
    components:{BaseRegular,MyLoader},
    data(){
        let markers = [{position:{lat: 6.832201, lng:3.631913}}];
         
        return {Banner,image,markers,page_loading:true}
    },
     mounted(){
         this.page_loading = false;  
    }
}
</script>

<style>

</style>