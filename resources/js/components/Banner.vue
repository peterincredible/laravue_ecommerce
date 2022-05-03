<template>
  <div class="gender_trends mt-1 " ref='banner_link' @mouseenter="mouseenter" @mouseleave="mouseleave">
        <img :src="image" alt="sorry image cant be displayed" />
        <router-link to="/shop" class="p-3">
                <div class="banner-tag">
                    <p class="mb-0">{{gender}}</p>
                    <span>spring 2018</span>
                </div>
                <div class="banner-action">
                    <p class="animate__animated  mb-0">SHOP NOW</p>
                    <span class="slid_contianer">
                        <span></span>
                    </span>
                </div>
        </router-link>
    </div>
</template>

<script>
export default {
    props:['image','gender'],
    methods:{
        mouseleave(e){
            //  let banner_link = e.target.querySelector('a');
             let show = e.target.querySelector('a .banner-action p');
             show.classList.remove('animate__slideInUp')
             let span = e.target.querySelector('a .banner-action .slid_contianer span');
             span.classList.remove('show');

        },
        mouseenter(e){
            let show = e.target.querySelector('a .banner-action p');
             show.classList.add('animate__slideInUp')
             let span = e.target.querySelector('a .banner-action .slid_contianer span');
             span.classList.add('show');
        }
    },
    mounted(){
            //   console.log(this.$refs.banner_link);
            //   let banner_link = document.querySelector('.gender_trends a');
            //   banner_link.addEventListener('mouseenter',function(){
            //        let show = document.querySelector('.gender_trends a .banner-action p');
            //        show.classList.add('animate__slideInUp')
            //        let span = document.querySelector('.gender_trends a .banner-action .slid_contianer span');
            //        span.classList.add('show');
            //   })
            //     banner_link.addEventListener('mouseleave',function(){
            //          let show = document.querySelector('.gender_trends a .banner-action p');
            //          show.classList.remove('animate__slideInUp')
            //          let span = document.querySelector('.gender_trends a .banner-action .slid_contianer span');
            //          span.classList.remove('show');
            //   })
    }


}
</script>

<style>

</style>