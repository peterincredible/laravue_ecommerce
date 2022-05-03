<template>
   <table>
        <tr class="tr-head">
            <th class="ot_class extend_id">ID</th>
            <th class="ot_class extend_cat">CATEGORY</th>
            <th class="ot_class extend_action">ACTION</th>
        </tr>
        <tr class="tr-body" v-for="(category,index) in categories" :key="index">
           <td class="ot_class extend_id">{{category.id}}</td>
            <td class="ot_class extend_cat">{{category.category}}</td>
             <td class="ot_class extend_action">
                <router-link :to="'/admin/category/edit/'+category.id" class="ms-2" data-bs-toggle='tooltip' data-bs-placement='bottom' title='edit category'>
                    <font-awesome-icon icon="edit" style="font-size:15px;color:#717fe0;" ></font-awesome-icon>
                </router-link>
                <span class="ms-2" data-bs-toggle='tooltip' data-bs-placement='bottom' title='delete category' @click.prevent='deleteCategory(category.id,index)'>
                    <font-awesome-icon icon="trash" style="font-size:15px;color:#f05757;" ></font-awesome-icon>
                </span>
           </td>
        </tr>
    </table>
</template>

<script>
import axios from "../utils/myaxios";
export default {
    data(){
        return {categories:[]}
    },
    methods:{
        async deleteCategory(id,index){
                   try{
                       await axios.delete(`/api/category/${id}`);
                      this.$toasted.success('category successfully deleted');
                      this.categories.splice(index,1);
                   
                }catch(e){
                    console.log(e);
                    this.$toasted.error('error failed to delete category')
                }
        }
    },
    async mounted (){
          try{
                   let data = await axios.get('/api/category');
                   this.categories=data.data.categories;
          }catch(e){
              console.log(e);
          }
    }

}
</script>

<style scoped>
table {
    width: 100%;
    height: auto;
    max-width: 992px;
    border-left: 1px solid #e6e6e6;
    border-right: 1px solid #e6e6e6;
    min-width: 530px;
}
.extend_id{
 width:20%;
 text-align: center;
}
.extend_cat{
    width:40%;
     text-align: center;
}
.extend_action{
  width: 40%;
   text-align: center;
}

.extend_action span{
    cursor: pointer;
}
</style>