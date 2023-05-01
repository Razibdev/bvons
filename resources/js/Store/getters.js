export const cartItemCount = (state) => {
        return state.cart.length;
};

export const cartTotalPrice = (state) => {
    let total = 0;
    if(state.cart.length > 0){
        state.cart.forEach(item => {
            if(item.user_type === 'GU'){
                total += item.product.user_price * item.quantity;

            }else{
                total += item.product.premium_price * item.quantity;
            }
        });
    }

    return total;
};

export  const  otherTotoalPrice = (state) =>{
    let total = 0;
    if(state.cart.length > 0) {
        state.cart.forEach(item => {

            total += item.product.user_price * item.quantity;

        });
    }
    return total;
};


export const CheckTrueOrFalse = (state) => {
    return state.checkCartProduct;
};




export const detailsOrderShowPrice = (state) => {
    let total = 0;
    state.detailsOrderShow.forEach(item => {

            total += item.product_price * item.product_quantity;

    });
    return total;
};


// dealer getters section

export const dealerCartItemCount = (state) => {
    return state.dealerCart.length;
};

export const dealerCartTotalPrice = (state) => {
    let total = 0;
    if(state.dealerCart.length > 0){
        state.dealerCart.forEach(item => {
            total += item.product.purchase_price * item.quantity;
        });
    }

    return total;
};


export const dealerDetailsOrderShowPrice = (state) => {
    let total = 0;
    state.dealerDetailsOrderShow.forEach(item => {

        total += item.price * item.quantity;

    });
    return total;
};
