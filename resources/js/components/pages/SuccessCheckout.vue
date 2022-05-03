<template>
  
</template>

<script>
import BaseRegular from "../BaseRegularTwo.vue";

import  MyLoader from "../MyLoader.vue";
export default {
    // components:{BaseRegular,MyLoader},
    data(){
        return {page_loading:true}
    },
    methods:{
        addwishlist(){
            this.$swal({
                icon: 'success',
                title: 'checkout',
                text: 'payment successfull'
            }).then(()=>{
                this.$router.push('/');
            });
        }
    },
    mounted () {
        this.page_loading = false;
        this.addwishlist();
    }
  
     
}

</script>