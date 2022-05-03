<template>
  <carousel 
            :per-page="1" 
            :autoplay="true" 
            :loop='true'
            :autoplayTimeout='7000'
            :paginationEnabled='false'  
            :navigationEnabled='true'
            @page-change='page_change'

            >
                <slide>
                    <div class="slide1">
                        <div class="slide-content  px-2 px-lg-0">
                            <p class="animate__animated animate__fadeInDown animate__delay-2s animate__faster">Women collection 2018</p>
                            <h3 class="animate__animated animate__fadeInUp animate__delay-3s animate__faster	">NEW SEASON</h3>
                            <router-link to="/shop" class="animate__animated animate__fadeIn animate__delay-4s animate__faster py-3 px-4 mt-2">SHOP NOW </router-link>
                        </div>
                    </div>
                </slide>

                <slide>
                    <div class="slide2">
                          <div class="slide-content px-2 px-lg-0">
                            <p class="animate__animated  animate__delay-2s animate__faster">Men New-Season</p>
                            <h3 class="animate__animated  animate__delay-3s animate__faster">JACKETS & COATS</h3>
                            <router-link to="/shop" class="animate__animated  animate__delay-4s animate__faster py-3 px-4 mt-2">SHOP NOW </router-link>
                          </div>
                    </div>
                </slide>
                <slide>
                    <div class="slide3">
                          <div class="slide-content px-2 px-lg-0">
                            <p class="animate__animated  animate__delay-2s animate__faster">Men collection 2018</p>
                            <h3 class="animate__animated  animate__delay-3s animate__faster">NEW ARRIVALS</h3>
                            <router-link to="/shop" class="animate__animated  animate__delay-4s animate__faster py-3 px-4 mt-2">SHOP NOW </router-link>
                        </div>
                    </div>
                </slide>
        </carousel>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
export default {
    components:{Carousel,Slide},
 methods:{
        page_change(current_slide){
            if(current_slide==0){
                //add animaed class to slide 1 
                let slide1_content = document.querySelector('.slide1 .slide-content')
                slide1_content.children[0].classList.add('animate__fadeInDown');
                slide1_content.children[1].classList.add('animate__fadeInUp');
                slide1_content.children[2].classList.add('animate__fadeIn');
                //remove animated classes in slide 2
                let slide2_content = document.querySelector('.slide2 .slide-content')
                        slide2_content.children[0].classList.remove('animate__rotateInDownLeft');
                        slide2_content.children[1].classList.remove('animate__fadeInRight');
                        slide2_content.children[2].classList.remove('animate__fadeInUp');

                //remove animated classes in slide 3
                  let slide3_content = document.querySelector('.slide3 .slide-content')
                        slide3_content.children[0].classList.remove('animate__rotateInDownLeft');
                        slide3_content.children[1].classList.remove('animate__rotateInUpRight');
                        slide3_content.children[2].classList.remove('animate__rotateIn');
                
            }else if(current_slide ==1){
                    //remove animated classes in slide 1
                     let slide1_content = document.querySelector('.slide1 .slide-content')
                        slide1_content.children[0].classList.remove('animate__fadeInDown');
                        slide1_content.children[1].classList.remove('animate__fadeInUp');
                        slide1_content.children[2].classList.remove('animate__fadeIn');
                     //remove animated classes in slide 3
                      let slide3_content = document.querySelector('.slide3 .slide-content')
                        slide3_content.children[0].classList.remove('animate__rotateInDownLeft');
                        slide3_content.children[1].classList.remove('animate__rotateInUpRight');
                        slide3_content.children[2].classList.remove('animate__rotateIn');

                     //add animaed class to slide 2
                     let slide2_content = document.querySelector('.slide2 .slide-content')
                        slide2_content.children[0].classList.add('animate__rotateInDownLeft');
                        slide2_content.children[1].classList.add('animate__fadeInRight');
                        slide2_content.children[2].classList.add('animate__fadeInUp');

            }else{
                 //remove animated classes in slide 1
                  let slide1_content = document.querySelector('.slide1 .slide-content')
                  slide1_content.children[0].classList.remove('animate__fadeInDown');
                  slide1_content.children[1].classList.remove('animate__fadeInUp');
                  slide1_content.children[2].classList.remove('animate__fadeIn');

                  //remove animated classes in slide 2
                  let slide2_content = document.querySelector('.slide2 .slide-content')
                        slide2_content.children[0].classList.remove('animate__rotateInDownLeft');
                        slide2_content.children[1].classList.remove('animate__fadeInRight');
                        slide2_content.children[2].classList.remove('animate__fadeInUp');

                  //add animated class to slide 3
                   let slide3_content = document.querySelector('.slide3 .slide-content')
                        slide3_content.children[0].classList.add('animate__rotateInDownLeft');
                        slide3_content.children[1].classList.add('animate__rotateInUpRight');
                        slide3_content.children[2].classList.add('animate__rotateIn');
            }
        }
    },
    mounted() {
           let VueCarousel = document.querySelector('.VueCarousel');
           VueCarousel.addEventListener('mouseenter',function(){
               console.log('hippi')
                let VueCarousel_nav_prev = document.querySelector('.VueCarousel-navigation-prev');
                let VueCarousel_nav_next = document.querySelector('.VueCarousel-navigation-next');
                console.log(VueCarousel_nav_prev.parentElement.previousElementSibling,'this is nav prev');
                
                    VueCarousel_nav_prev.classList.add('navigation-show')
                    VueCarousel_nav_next.classList.add('navigation-show')
    
                // console.log(this,'this is the event caller')
                
                 
               
           });
            VueCarousel.addEventListener('mouseleave',()=>{
               console.log('hippi windows mouseout')
             
                let VueCarousel_nav_prev = document.querySelector('.VueCarousel-navigation-prev');
                let VueCarousel_nav_next = document.querySelector('.VueCarousel-navigation-next');
                 VueCarousel_nav_prev.classList.remove('navigation-show')
                 VueCarousel_nav_next.classList.remove('navigation-show')
               
           })

    }
}
</script>

<style>
.VueCarousel {
    padding-left:0px;
    padding-right:0px;
}

.VueCarousel-navigation-prev,.VueCarousel-navigation-next{
transform: none !important;
font-size: 38px !important;
color:rgba(0,0,0,0.3) !important;
opacity: 0;
outline: none !important;
top:0 !important;
bottom:0 !important;
margin-top:auto !important;
margin-bottom: auto !important;
transition: 0.25s all ease-in-out;
}
.VueCarousel-navigation-prev:hover,.VueCarousel-navigation-next:hover{
   color: #7280e0 !important;
}
.navigation-show{
opacity: 1 !important;
}
</style>