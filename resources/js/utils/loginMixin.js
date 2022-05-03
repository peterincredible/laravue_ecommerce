let LoginMixin = {
    created(){
        console.log('created of mixings');
        if(!this.$store.state.user && localStorage['user']){
            let user = JSON.parse(localStorage.user);
            let cart = JSON.parse(localStorage.cart);
            this.$store.commit('login',user);
            this.$store.commit('addcart',cart);
        }
    }
}

export default LoginMixin;