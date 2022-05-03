export default {
    cartToggle(state) {
        state.cartVisible  = !state.cartVisible
      },
      searchHeaderToggle(state) {
        state.searchHeaderVisible  = !state.searchHeaderVisible
      },
      login(state,user){
        state.user = user;
      },
      logout(state){
         state.user=null;
      },
      updateUser(state,user){
        state.user.name = user.name
        state.user.email = user.email
      },
      addcart(state,cart){
        state.cart = [...state.cart,...cart]
      },
      emptycart(state){
        state.cart=[];
      },
      removeFromCart(state,cart_id){
          state.cart = state.cart.filter(cart=> cart.id != cart_id);
      },
      updateToCart(state,cart_details){
        let index = state.cart.findIndex(cart=>cart.id == cart_details.cart_id);
        state.cart[index].quantity = cart_details.quantity;
      },
      addorders(state,orders){
        state.orders = [...orders,...state.orders]
      },
      removeFromOrders(state,order_id){
        state.orders = state.orders.filter(order=> order.id != order_id);
    },
    emptyorders(state){
      state.orders=[];
    },
      
}