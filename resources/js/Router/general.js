import Main from '../components/main/Main'
import Register from '../components/Auth/Register';
import LogOut from '../components/Auth/LogOut';
import Cart from '../components/main/Cart/Cart'
import OtherCart from '../components/main/Cart/OtherCart'
import Orderlist from '../components/main/Cart/order/OrderList'
import  Social from '../components/main/social/Social'
import SocialMainProfile from '../components/main/social/UserProfile'
import SocialAbout from '../components/main/social/About'
import UserSocialSingle from '../components/main/social/UserSocialSingleView'
// bvon shop
import  BvonShop from '../components/main/Shop/BvonShop'
import  DealerOrderList from '../components/main/Cart/order/DealerOrderList'
import Product from '../components/main/product/Product'
import BpayService from '../components/main/Bpay/BpayService'

const routes = [
    //main app here
    //Auth router here
    { path: '/', component: Main, name:'home' },

    { path: '/register', component: Register },
    { path: '/logout', component: LogOut },
    { path: '/shopping-cart-list', component: Cart, name:'cart-page' },
    { path: '/shopping-other-cart-list', component: OtherCart },
    { path: '/user-order-list', name:'order-list', component: Orderlist },
    { path: '/bvon-social', component: Social },
    { path: '/bvon-social-main-profile', component: SocialMainProfile },
    { path: '/bvon-social-main-profile/:id', component: UserSocialSingle, name: 'vue-social-main-sprofile' },
    { path: '/bvon-social-about', component: SocialAbout },
    //bvon shop
    { path: '/bvon-shop', component: BvonShop },
    { path: '/bvon-shop-order-list', component: DealerOrderList },
    { path: '/bvon-ecommerce', component: Product },
    { path: '/bvon-bpay-service', component: BpayService },


];
export  default routes;