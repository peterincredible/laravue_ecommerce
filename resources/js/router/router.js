import Home from "../components/pages/Home";
import Shop from "../components/pages/Shop";
import Contact from "../components/pages/Contact";
import About from "../components/pages/About";
import  VueRouter from "vue-router";
import ViewCart from "../components/pages/ViewCart";
import Signin from "../components/pages/Signin";
import Signup from "../components/pages/Signup";
import Dashboard from "../components/pages/Dashboard";
import UserOrders from "../components/pages/UserOrders";
import AccountSettings from "../components/pages/AccountSettings";
import Products from "../components/pages/Products";
import EditProduct from "../components/pages/EditProduct";
import AddProduct from "../components/pages/AddProduct";
import Categories from "../components/pages/Categories";
import AddCategory from "../components/pages/AddCategory";
import EditCategory from "../components/pages/EditCategory";
import AdminAllOrders from "../components/pages/AdminAllOrders"
import SuccessCheckout from "../components/pages/SuccessCheckout";
let requireAuth=true;
let requireAdmin=true;
const routes = [
    { path: '/', component: Home },
    { path: '/shop', component: Shop },
    { path: '/contact', component:Contact},
    { path: '/about', component:About},
    { path: '/viewcart', component:ViewCart},
    { path: '/signin', component:Signin},
    { path: '/signup', component:Signup},
    { path: '/success_checkout_page', component:SuccessCheckout,meta:{requireAuth}},
    { path: '/dashboard', component:Dashboard,meta:{requireAuth}},
    { path: '/user/orders', component:UserOrders,meta:{requireAuth}},
    { path: '/user/account', component:AccountSettings,meta:{requireAuth}},
    { path: '/admin/products', component:Products,meta:{requireAdmin}},
    { path: '/admin/product/edit/:product_id', component:EditProduct,meta:{requireAdmin}},
    { path: '/admin/product/add', component:AddProduct,meta:{requireAdmin}},
    { path: '/admin/categories', component:Categories,meta:{requireAdmin}},
    { path: '/admin/category/add', component:AddCategory,meta:{requireAdmin}},
    { path: '/admin/category/edit/:cat_id', component:EditCategory ,meta:{requireAdmin}},
    { path: '/admin/orders', component:AdminAllOrders ,meta:{requireAdmin}},
  ]

  const router = new VueRouter({
    routes ,// short for `routes: routes`
    mode: 'history'
  })
  router.beforeEach((to,from,next)=>{
       let state = null;
       if(localStorage['user']){
         state = JSON.parse(localStorage['user']);
       }

      if(to.matched.some(record=>record.meta.requireAuth)){
        if(!state){
        next("/signin");
        }else{
          next();
        }
       
      }else if(to.matched.some(record=>record.meta.requireAdmin)){
            if(state && state.isadmin){
              next()
            }else{
              next('/')
            }
      }else{
        next();
      }
  })

  export default router;