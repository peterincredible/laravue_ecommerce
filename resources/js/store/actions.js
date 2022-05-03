import axios from "../utils/myaxios";
export default {
    async removeCart({commit},cart_id){
        commit('removeFromCart',cart_id);
        let cart = localStorage['cart']? JSON.parse(localStorage['cart']):[];
        cart = cart.filter(cart=> cart.id != cart_id);
        localStorage['cart'] = JSON.stringify(cart);
        await axios.delete('/api/cart/'+cart_id);
        
    },
    async updateCart({commit},cart_details){
       // console.log('cart details on updatecart actions');
        // console.dir(cart_details);
        // let index = state.cart.findIndex(cart=>cart.id == cart_details.cart_id);

        //this update the localstorage cart array
        let cart=JSON.parse(localStorage['cart']);
        let local_index = cart.findIndex(cart=>cart.id == cart_details.cart_id);
        cart[local_index].quantity = cart_details.quantity;
        localStorage['cart'] = JSON.stringify(cart);



        //this update quantity on the database
        cart_details = {...cart_details,_method:'put'}
        await axios.put('/api/cart/'+cart_details.cart_id,cart_details);
        // console.log('making put request');
        // console.dir(data);


        //this update quantity on the state
        commit('updateToCart',cart_details);
    }
}