<template>
      <button :class="['togglebutton',toggler? 'bubble':'' ]" @click="click"  data-bs-toggle="collapse" :data-bs-target="target">
        <transition name='fade'>
            <span v-if='toggler' ><font-awesome-icon icon="times"  size="xs"  ></font-awesome-icon></span>
            <span  v-else ><font-awesome-icon :icon="icon"  size="xs" ></font-awesome-icon></span>
        </transition>
          {{text}}
      </button>
</template>

<script>
export default {
    props:['text','icon','target','mykey','openedkey'],
    data(){
        return {
            toggler:false
        }
    },
    watch:{
         openedkey(newvalue){
           console.log('watchig opened key');
           console.log(newvalue);
          if(newvalue !== 0 && newvalue !== this.mykey){
            this.toggler= false;
          }
         }
    },
    methods:{
        click(){
           this.toggler = !this.toggler;
          //  console.log(this.mykey)
          //  this.openedkey = this.mykey;
          this.$emit('change-openedkey',this.mykey);
        }
    }

}
</script>

<style>

.fade-enter-active, .fade-leave-active {
  transition: opacity .10s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

</style>