<template>
   <div class="card card-body d-flex flex-row justify-content-between align-items-center search_container p-4">
        <span><font-awesome-icon icon="search"   size='xs'></font-awesome-icon></span>
        <input type="text" class="" placeholder="Search" @keydown="change" v-model="searchtext"/>
    </div>
</template>

<script>
export default {
     data(){
         return {searchtext:""}
     },
 methods:{
     change(e){
          if (e.key === 'Enter' || e.keyCode === 13) {
             this.$emit('search_small',this.searchtext);
          }
        //  console.dir(e)
     }
 }
}
</script>

<style>

</style>