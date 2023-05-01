import axios from 'axios';

// export const getProducts = ({ commit }) => {
//     axios.get('/api/products')
//         .then(res =>{
//             commit('SET_PRODUCTS', res.data.data);
//         })
// };


export const addProductToCart = ({ commit, dispatch }, {product, quantity, product_media, session_id}) => {
    commit('ADD_TO_CART', {product, quantity, product_media, session_id});
    dispatch('addNotification', {
        type: 'success',
        message: 'Product added to cart'
    });

    axios.post('/api/cart',{
        product_id: product.id,
        quantity,
        product_media,
        session_id
    });
};


export const getCartItems = ({ commit }) => {
    axios.get('/api/cart')
        .then(res => {
            commit('SET_CART',res.data );
        });
};

export const cartQuantityMinus = ({commit, state, dispatch}, {product, quantity}) =>{

    commit('CART_QUANTITY_MINUS', {product, quantity});
    dispatch('addNotification', {
        type: 'success',
        message: 'Product quantity updated to cart'
    });
    let productInCart = state.cart.find(item =>{
        return item.product.id === product.id;
    }).id;

    axios.post('/api/cart/quanity-minus/',{
        product_id: product.id,
        quantity,
        id : productInCart
    });
};


export const decreaseCartQtn = ({commit, dispatch}, item) =>{
    dispatch('addNotification', {
        type: 'success',
        message: 'Product quantity updated to cart'
    });
    axios.post('/api/cart/cart-quanity-minus/',{
        id: item.product.id,
    });
};

export const increaseCartQtn = ({commit, dispatch}, item) =>{
    dispatch('addNotification', {
        type: 'success',
        message: 'Product quantity updated to cart'
    });
    axios.post('/api/cart/cart-quanity-plus/',{
        id: item.product.id,
    });
};

export  const removeCartItem = ({commit, dispatch}, item) =>{
    dispatch('addNotification', {
        type: 'error',
        message: 'Product removed from cart'
    });
    axios.post('/api/cart/destroy',{
        id: item,
    });
};

// order action

export const orderComplete = ({commit, dispatch}, {info, city, total, cart}) =>{
    commit('ORDER_COMPLETE', {info, city, total, cart});
    dispatch('addNotification', {
        type: 'success',
        message: 'Order Completed SuccessFully'
    });
    axios.post('/api/order/complete',{
        info,
        city,
        total,
        cart
    });
};

export const cancelOrder = ({commit}, id) =>{
    axios.post('/api/order/cancel/'+id)
        .then(res => {
            commit('CANCEL_ORDER', res.data);
        });
};

export const detailsShowOrder = ({commit}, id) => {
  axios.post('/api/order/details/'+id)
      .then(res => {
          commit('DETAILS_SHOW_ORDER', res.data);
      })
};



export const getOrderList = ({commit}, id) => {

    axios.get('/api/order/list/'+id)
        .then(res => {
            commit('GET_ORDER_LIST', res.data);
        });
};



export const updateCartAuth = ({commit}, {session_id, user_id, phone}) => {
    axios.post('/api/cart/auth-update', {session_id, user_id, phone});
};


// action for district

export const district = ({ commit }) => {
    axios.get('/api/district')
        .then(res => {
            commit('GET_DISTRICT', res.data.data);
        })
};



// get social information
export const getAllSocial = ({commit}) => {
    axios.get('/api/social')
        .then(res => {
            commit('GET_ALL_SOCIAL', res.data);
        });
};

export const deletePost = ({commit}, id) => {
    commit('DELETE_POST_F');
    axios.post('/api/social/delete-post/'+id);
};

//auth user post

export const getAuthUserAllPost = ({commit}, {id}) => {
 axios.get('/api/social/auth-user-all-post/'+id)
     .then(res => {
               commit('GET_AUTH_USER_POST', res.data.data)
     });
};

export const createNewPost = ({commit}, {id, formData}) => {
 axios.post('api/social/auth-user-post/'+id, formData)
     .then(res => {
            commit('CREATE_USER_NEW_POST', res.data);
         // console.log(res.data);
     }).catch(error => console.log(error.response.data));
};

export  const  postEditUser = ({commit}, {id, formData}) =>{
  axios.post('/api/social/edit/post/'+id, formData);
};

export const updateUserPost = ({commit}, {id, formData}) => {
    axios.post('/api/social/auth-user-post-update/'+id, formData);
};

// like section
export const getSocialLikeReactUser = ({commit}, {post_id}) =>{
    axios.get('/api/social/like-react-user/'+post_id)
        .then(res => {
            // console.log(res.data);
            commit('GET_SOCIAL_REACT_USER', res.data);
        })
};



//comment section
// export  const  userCommentSubmit = ({commit, dispatch}, {user_id, post_id, body}) => {
//     axios.post('/api/social/user-per-post', {user_id, post_id, body})
//         .then(res => {
//             // console.log(res.data);
//             if(res.data.message){
//                 if(res.data.message === "Your are already comment this post!"){
//
//                     dispatch('addNotification', {
//                         type: 'error',
//                         message: 'Your are already comment this post!'
//                     });
//
//                 }else{
//                     dispatch('addNotification', {
//                         type: 'success',
//                         message: 'Comment Successfully Done!'
//                     });
//                     dispatch('addNotification', {
//                         type: 'error',
//                         message: res.data.message
//                     });
//
//                     commit('USER_COMMENT_SUBMIT', res.data.comment);
//
//                 }
//
//             }else{
//                 dispatch('addNotification', {
//                     type: 'success',
//                     message: 'Comment Successfully Done!'
//                 });
//                 commit('USER_COMMENT_SUBMIT', res.data.comment);
//
//             }
//
//         })
// };

export const getPostUserComment = ({commit}, {post_id}) => {
    axios.get('/api/social/user-post-comment/'+post_id)
        .then(res => {
            commit('GET_POST_USER_COMMENT', res.data);
        });
};
// export const newReplyCommentSubmit = ({commit, dispatch}, {user_id, post_id, comment_id, message}) => {
//     axios.post('/api/social/new-reply-comment/'+comment_id, {user_id, post_id, message})
//         .then(res => {
//             // console.log(res.data);
//             dispatch('addNotification', {
//                 type: 'success',
//                 message: 'Reply Successfully Done!'
//             });
//             commit('NEW_REPLY_COMMENT', res.data);
//         });
// };


export const getAllUser = ({commit}) => {
    axios.get('/api/get-all-users')
        .then(res => {
            commit('GET_ALL_USERS', res.data)
        });
};



// Dealer section

export const addDealerProductToCart = ({ commit, dispatch }, {product, quantity, product_media}) => {
    commit('ADD_DEALER_TO_CART', {product, quantity, product_media});
    dispatch('addNotification', {
        type: 'success',
        message: 'Product added to cart'
    });

    axios.post('/api/add-dealer-cart',{
        product: product,
        quantity,
        product_media
    });

};


export const getDealerCartItems = ({ commit }) => {
    axios.get('/api/get-dealer-cart')
        .then(res => {
            commit('SET_DEALER_CART',res.data );
        });
};



export const decreaseDealerCartQtn = ({commit, dispatch}, item) =>{
    dispatch('addNotification', {
        type: 'success',
        message: 'Product quantity updated to cart'
    });
    axios.post('/api/dealer-cart/cart-quanity-minus/',{
        id: item.id,
    });
};


export const increaseDealerCartQtn = ({commit, dispatch}, item) =>{
    dispatch('addNotification', {
        type: 'success',
        message: 'Product quantity updated to cart'
    });
    axios.post('/api/dealer-cart/cart-quanity-plus/',{
        id: item.id,
    });
};




export  const removeDealerCartItem = ({commit, dispatch}, item) =>{
    dispatch('addNotification', {
        type: 'error',
        message: 'Product removed from cart'
    });
    axios.post('/api/dealer-cart/destroy',{
        id: item,
    });
};


export const dealerOrderCompleteNow = ({commit, dispatch}, {address, phone, cart, total}) =>{

    // commit('ORDER_COMPLETE', {info, city, total, cart});
    dispatch('addNotification', {
        type: 'success',
        message: 'Order Completed SuccessFully'
    });
    axios.post('/api/dealer-order/complete',{
        address,
        phone,
        cart,
        total
    });
};

export const getDealerOrderList = ({commit}) => {

    axios.get('/api/get-dealer-order/list')
        .then(res => {
            commit('GET_DEALER_ORDER_LIST', res.data);
        });
};


export const dealerDetailsShowOrder = ({commit}, id) => {
    axios.get('/api/dealer-single-order/details/'+id)
        .then(res => {
            commit('DETAILS_SHOW_DEALER_ORDER', res.data);
        })
};


export const cancelDealerOrder = ({commit}, id) =>{
    axios.get('/api/dealer-order/cancel/'+id)
        .then(res => {
            commit('CANCEL_ORDER', res.data);
        });
};







//add notification
export  const addNotification = ({commit}, notification) =>{
  commit('PUSH_NOTIFICATION', notification);
};

export const removeNotification = ({commit}, notification) => {
  commit('REMOVE_NOTIFICATION', notification);
};

