import User from '../Helpers/User';

// export const SET_PRODUCTS = (state, products) => {
//     state.products = products;
// };


export const  ADD_TO_CART = (state, {product, quantity, product_media, session_id}) => {

    let productInCart = state.cart.find(item =>{
        return item.product.id === product.id && item.session_id === session_id;
    });
    if(productInCart){
        productInCart.quantity += quantity;
        return;
    }
    state.cart.push({
        product,
        quantity,
        product_media,
        session_id
    });
    state.checkCartProduct = true;
};







export const  SET_CART = (state, cartItems) => {
    state.cart = cartItems;
};

export const CART_QUANTITY_MINUS = (state, {product, quantity}) => {
    let productInCart = state.cart.find(item =>{
        return item.product.id === product.id;
    });
    if(productInCart){
        productInCart.quantity -= quantity;
        return;
    }
};

// order section mutations

export const ORDER_COMPLETE = (state, {info, city, total, cart}) =>{
    state.ownInfo = info;
    state.city = city;
    state.orderAmount = total;
    state.cartHistory =cart;
};

export const CANCEL_ORDER = (state, orderItem) => {
  state.orderList.find(item => {
     if(item.id === orderItem.id){
        return state.orderList;
     }
  });
};

export const DETAILS_SHOW_ORDER = (state, detailsOrder) =>{
    state.detailsOrderShow = detailsOrder;
};


export const GET_ORDER_LIST = (state, orderItems) => {
    state.orderList = orderItems;
};


//social mutations

export const GET_ALL_SOCIAL = (state, socialList) => {
    state.getAllSocial = socialList;
};

// auth user all post get

export const GET_AUTH_USER_POST = (state, getAuthUserPost) => {
    state.authUserAllPost = getAuthUserPost;
};

export const CREATE_USER_NEW_POST = (state, newAuthUserPost) => {

    // Echo.private('App.User.' + User.id())
    //     .notification((notification) => {
    //         state.authUserAllPost.unshift(notification.post);
    //     });
  state.authUserAllPost.unshift(newAuthUserPost);
};


export const DELETE_POST_F = (state) => {
 return state.getAllSocial;
};
// like section
export const GET_SOCIAL_REACT_USER = (state, getSocialUser) => {
    state.getSocialReactUser = getSocialUser;
};

// comment section

// export const USER_COMMENT_SUBMIT = (state, getComment) =>{
//     state.comment.push(getComment);
// };

export const GET_POST_USER_COMMENT = (state, getUserComment) => {
    state.comment = getUserComment;
};

export const NEW_REPLY_COMMENT =(state, newReplyComment) =>{
    state.comment = newReplyComment;
};

export  const GET_ALL_USERS = (state, allUser) => {
    state.getAllUser = allUser;
};




// Dealer Section


export const  ADD_DEALER_TO_CART = (state, {product, quantity, product_media}) => {

    let productInCart = state.dealerCart.find(item =>{
        return item.product.product_id === product.product_id;
    });
    if(productInCart){
        productInCart.quantity += 1;
        return;
    }
    state.dealerCart.push({
        product,
        quantity,
        product_media
    });
    state.checkCartProduct = true;
};


export const  SET_DEALER_CART = (state, cartItems) => {
    state.dealerCart = cartItems;
};

export const GET_DEALER_ORDER_LIST = (state, orderItems) => {
    state.dealerOrderList = orderItems;
};


export const DETAILS_SHOW_DEALER_ORDER = (state, detailsOrder) =>{
    state.dealerDetailsOrderShow = detailsOrder;
};














// district mutations

export  const  GET_DISTRICT = (state, districtItem) => {
    state.district = districtItem;
};

//notification show

export const PUSH_NOTIFICATION = (state, notification) =>{
    state.notifications.push({
        ...notification,
        id: (Math.random().toString(36) + Date.now().toString(26)).substr(2)
    });
};

export const REMOVE_NOTIFICATION = (state, notificationToRemove) =>{
    state.notifications = state.notifications.filter(notification => {
        return notification.id !== notificationToRemove.id
    })
};