export default {
    isCartVisible(state){
        return state.cartVisible;
    },
    isSearchHeaderVisible(state){
        return state.searchHeaderVisible;
    },
    isAdmin(state){
        if(state.user){
            if(state.user.isadmin){
                return true;
            }
            return false
        }else{
            return false;
        }
    },
    isAuth(state){
        return state.user? true:false;
    },
    cartLength(state){
        return state.cart.length;
    },
    cartTotal(state){
        let initialValue=0;
        let reducer = (previousValue, currentValue)=>{
            // let previous_price = previousValue.quantity * previousValue.product.product_price;
            let current_price = currentValue.quantity * currentValue.product.product_price;
            return previousValue + current_price;
        }
        return state.cart.reduce( reducer,initialValue)
        // return state.cart[0].product.product_price;
    }
}