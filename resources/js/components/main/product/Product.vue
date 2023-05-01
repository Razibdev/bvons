<template>
    <div class="main-product" style="overflow-x: hidden; position: relative;" >
        <loader v-if="isLoading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#ffffff" objectbg="#999793" opacity="100" disableScrolling="true" name="dots"></loader>

        <v-layout row wrap  >
            <v-flex xs12 md12>
                <!--<div class="product-title">-->
                    <!--Product-->
                <!--</div>-->

                <div class="text-right-product" @click="miniCartSideBar">
                    <div   >
                        <div class="text-right-top">
                            <p><v-icon class="text-right-icon">mdi-bag-personal</v-icon></p>
                            <p class="text-right-item"> <span>{{cartItemCount}}</span> ITEMS</p>
                        </div>
                        <div class="text-right-bottom">
                            <span class="price-item-cart">TK</span><span>&nbsp; {{cartTotalPrice}}</span>
                        </div>
                    </div>

                </div>


            </v-flex>

            <v-layout row wrap class="all-product-main-show">

                <v-flex xs6 sm3 md2 class="single-product-main-show" v-for="(product, index) in products" :key="product.id">

                    <v-card
                        class="mx-auto single-product-single"
                        max-width="250"
                >
                        <v-hover v-slot="{ hover }">

                        <div>

                                <v-img v-if="product.product_media.product_image"
                                        :src="getImgUrl(product.product_media.product_image)"
                                        height="200px"
                                        width="198px"
                                >

                                </v-img>

                                <v-card-title class="text-center"  style="height: 96px; font-size: 18px;">
                                   {{product.product_name}}
                                </v-card-title>

                                <v-card-subtitle class="text-center">
                                    {{product.product_size[0]}}
                                </v-card-subtitle>
                                <h4  v-if="!hover" class="text-center">
                                   TK {{product.user_price}}
                                </h4>

                                <v-expand-transition>
                                <div
                                        v-if="hover"
                                        class="transition-fast-in-fast-out red darken-2 v-card--reveal text-h2 white--text"
                                        style="height: 100%; text-align: center; background-color: #0b0808 !important;"

                                >

                                    <p id="header" style="padding-top: 5px; font-size: 26px; color: #ffffff;" v-if="trueOrFalse(product)">{{singleCartItemPrice(product)}}</p>
                                    <v-row no-gutters dense v-if="trueOrFalse(product)" style="margin-top: 100px;">
                                        <v-col
                                                cols="sm"
                                                width="25%"
                                        >
                                            <v-card
                                                    class="pa-2"
                                                    outlined
                                                    tile
                                                    style="background: transparent; color: #fff;"

                                            >


                                                <v-btn @click="decreasQty(product)" icon width="25%"   style="background: transparent; color: #fff; font-size: 32px; border: 1px solid #ddd; padding:20px;"
                                                >
                                                    <v-icon>mdi-minus</v-icon>

                                                </v-btn>


                                            </v-card>
                                        </v-col>

                                        <v-col
                                                cols="sm"
                                                width="50%"
                                        >
                                            <v-card
                                                    class="pa-2"
                                                    outlined
                                                    tile
                                                    dense
                                                    style="background: transparent; color: #fff;"

                                            >
                                                <v-btn icon width="50%" style="background: transparent; color: rgb(218 62 15); font-size: 32px;"  @click="addToCart(product, product.product_media[0].product_image)" v-html="singleCartItem(product)">
                                                    in Bag
                                                </v-btn>
                                            </v-card>
                                        </v-col>

                                        <v-col
                                                cols="sm"
                                                width="25%"
                                        >
                                            <v-card
                                                    class="pa-2"
                                                    outlined
                                                    tile
                                                    style="background: transparent; color: #fff;"
                                            >
                                                <v-btn icon @click="addToCart(product, product.product_media.product_image)" width="25%"  style="background: transparent; color: #fff; font-size: 32px; border: 1px solid #ddd; padding:20px;">
                                                    <v-icon>mdi-plus</v-icon>

                                                </v-btn>

                                            </v-card>
                                        </v-col>
                                    </v-row>

                                    <div class="content" @click="addToCart(product, product.product_media.product_image)"  v-else>Add to <br> Shopping <br> Bag</div>

                                </div>

                            </v-expand-transition>


                                <div class="text-center" v-show="hover">
                                        <v-dialog
                                                v-model="removeTagDialogs[product.id]"
                                                width="980"
                                               style="overflow: hidden"
                                                height="auto"
                                        >
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn
                                                    color="red lighten-2"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    style="width: 100%; margin-top: -2px;"

                                            >
                                                Details
                                            </v-btn>
                                            </template>

                                            <v-card style="overflow: hidden">
                                                <v-card-text style="overflow:hidden">
                                                    <v-layout row wrap >
                                                        <v-flex xs12 md6>
                                                            <div class="content-zoom">
                                                                <image-zoom
                                                                        :regular="getImgUrl(product.product_media.product_image)"
                                                                        :zoom="getImgUrl(product.product_media.product_image)"
                                                                        :zoom-amount="3"
                                                                        img-class="img-fluid"
                                                                        alt="Sky"
                                                                        show-message-touch = false
                                                                        show-message = false
                                                                        hover-message
                                                                        style="height: 400px"

                                                                >
                                                                </image-zoom>
                                                            </div>

                                                        </v-flex>
                                                        <v-flex xs12 md6>
                                                            <span><v-icon @click="closeProductDetails(product.id)" style="float: right; color: #000; margin-top: 26px; cursor:pointer; ">mdi-close</v-icon></span>

                                                            <div class="product-details">
                                                                <h3>Product Name: {{product.product_name}}</h3>
                                                                <h5>Brand Name: {{product.brand.name}}</h5>
                                                                <h5>Category Name: {{product.category.name}}</h5>
                                                                <div>
                                                                    <h6>Price: Tk {{product.premium_price}}</h6>
                                                                    <p>General Price here Tk {{product.user_price}}</p>
                                                                </div>

                                                                <v-flex row wrap>
                                                                    <v-col
                                                                            class="d-flex"
                                                                            cols="12"
                                                                            sm="6"
                                                                    >
                                                                        <select name="form" v-model="quantity" id="" style="border: 1px solid; padding: 13px; width: 200px;">
                                                                            <option>choose quantity</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>

                                                                    </v-col>

                                                                    <v-col
                                                                            class="d-flex"
                                                                            cols="12"
                                                                            sm="6"
                                                                    >
                                                                        <v-btn
                                                                                dark

                                                                               style="background: teal; height: 48px;"
                                                                                @click="addToCartDetails(product, product.product_media.product_image)"
                                                                        >
                                                                            Add To Cart
                                                                        </v-btn>

                                                                    </v-col>
                                                                </v-flex>

                                                            </div>
                                                        </v-flex>
                                                    </v-layout>
                                                </v-card-text>

                                                <v-divider></v-divider>

                                               <v-card-text>
                                                   <v-layout row wrap>
                                                       <v-flex xs12 md8>
                                                           <div class="product_details_left_divider">
                                                               <ul>
                                                                   <li><v-icon>mdi-truck-delivery</v-icon> <span>1 Hour Delivery</span></li>
                                                                   <li> <v-icon>mdi-cash-check</v-icon> <span>Cash On Delivery</span></li>
                                                               </ul>

                                                           </div>

                                                       </v-flex>
                                                       <v-flex xs12 md4>
                                                           <div class="product_details_right_divider">
                                                               <ul>
                                                                   <li>Pay With</li>
                                                                   <li><img src="frontend/img/visa.png" width="150" alt=""></li>
                                                                   <li><img src="frontend/img/bikash.png" width="100" alt=""></li>
                                                                   <li><img src="frontend/img/cash.jpg" width="100" alt=""></li>
                                                               </ul>

                                                           </div>

                                                       </v-flex>
                                                   </v-layout>

                                                   <v-layout row wrap>
                                                       <v-flex xs12 md12>
                                                        <div class="product_details_wrapper">
                                                           <v-layout row wrap>
                                                               <v-flex xs12 md8>
                                                                   <div class="product_details_detail">
                                                                       <div class="product_details_details_left_top">
                                                                           <h3>Bvon</h3>

                                                                           <p v-html="product.description"></p>
                                                                       </div>
                                                                       <div class="product_details_details_left_buttom">
                                                                           <div class="product_details_left_buttom_three">
                                                                               <h3>Customer Service</h3>
                                                                               <ul>
                                                                                   <li><a href="#">Contact Us</a></li>
                                                                                   <li><a href="#">FAQ</a></li>
                                                                               </ul>
                                                                           </div>

                                                                           <div class="product_details_left_buttom_three">
                                                                               <h3>About Bvon</h3>
                                                                               <ul>
                                                                                   <li><a href="#">Privacy Policy</a></li>
                                                                                   <li><a href="#">Terms of Use</a></li>
                                                                               </ul>
                                                                           </div>

                                                                           <div class="product_details_left_buttom_three">
                                                                               <h3>For Business</h3>
                                                                               <ul>
                                                                                   <li><a href="#">Corporate</a></li>
                                                                               </ul>
                                                                           </div>
                                                                       </div>

                                                                   </div>



                                                               </v-flex>
                                                               <v-divider vertical
                                                               >

                                                               </v-divider>
                                                               <v-flex xs12 md4>
                                                                   <div class="product_details_left_buttom_wrapper">

                                                                   <v-flex xs12 md12>
                                                                       <div class="product_details_left_buttom_right">
                                                                           <ul>
                                                                               <li><img src="frontend/img/android.png" alt=""></li>
                                                                               <li><img src="frontend/img/iphone.png" alt=""></li>
                                                                           </ul>
                                                                       </div>
                                                                   </v-flex>
                                                                   <v-flex xs12 md12>
                                                                       <div class="product_details_left_buttom_buttom">
                                                                           <h4></h4>
                                                                           <h4>or emailsupport@bvon.app</h4>

                                                                           <ul>
                                                                               <li><img src="frontend/img/facebook.png" alt=""></li>
                                                                               <li><img src="frontend/img/youtube.png" alt=""></li>
                                                                               <li><img src="frontend/img/twitter.png" alt=""></li>
                                                                               <li><img src="frontend/img/instragram.png" alt=""></li>
                                                                           </ul>
                                                                       </div>

                                                                   </v-flex>
                                                                   </div>

                                                               </v-flex>

                                                           </v-layout>
                                                        </div>
                                                       </v-flex>

                                                   </v-layout>
                                               </v-card-text>
                                            </v-card>
                                        </v-dialog>
                                    </div>


                        </div>


                        </v-hover>
                        <div ></div>


                    <div class="text-center">

                        <v-row no-gutters dense v-if="trueOrFalse(product)">
                            <v-col
                                    cols="sm"
                                    width="25%"
                            >
                                <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                        style="background: #4FA446; color: #fff;"

                                >


                                    <v-btn @click="decreasQty(product)" icon width="25%" style="background: #4FA446; color: #fff;"
                                    >
                                        <v-icon>mdi-minus</v-icon>

                                    </v-btn>


                                </v-card>
                            </v-col>

                            <v-col
                                    cols="sm"
                                    width="50%"
                            >
                                <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                        dense
                                        style="background: #4FA446; color: #fff;"

                                >
                                    <v-btn icon width="50%" style="background: #4FA446; color: #fff;"  @click="addToCart(product, product.product_media.product_image)" v-html="singleCartItem(product)">
                                        in Bag
                                    </v-btn>
                                </v-card>
                            </v-col>

                            <v-col
                                    cols="sm"
                                    width="25%"
                            >
                                <v-card
                                        class="pa-2"
                                        outlined
                                        tile
                                        style="background: #4FA446; color: #fff;"
                                >
                                    <v-btn icon @click="addToCart(product, product.product_media.product_image)" width="25%"  style="background: #4FA446; color: #fff;">
                                        <v-icon>mdi-plus</v-icon>

                                    </v-btn>

                                </v-card>
                            </v-col>
                        </v-row>

                        <v-btn
                                v-else
                                class="ma-3"
                                outlined
                                style="width:100%; background: #4FA446; color: #fff;"
                                @click="addToCart(product, product.product_media.product_image)" >
                            Add To Cart
                        </v-btn>

                    </div>

                </v-card>


                </v-flex>

                <div style="height: 55px; width: 100%;" v-if="products.length" v-observe-visibility="handleScrollToBottom"></div>

            </v-layout>
        </v-layout>

    <mini-cart></mini-cart>
    </div>

</template>
<script>
    import imageZoom from 'vue-image-zoomer';
    import MiniCart from '../Cart/MiniCart'
    import VueCookies from 'vue-cookies'
    export default {
        name: "Product",
        data: () => ({
            quantity : 1,
            removeTagDialogs: {},
            page: 1,
            lastPage:1,
            products:[],
            show: false,
            isLoading: true,
            bagshowhide:false,
            hover : false,
            navigation: {
                shown: false,
                width: 350,
                borderSize: 3
            },

        }),

        created(){

            EventBus.$emit('showDealerOrNot');

            // window.addEventListener('scroll', this.handleScroll);

            // $(window).scroll(function () {
            //     this.showCartBtn = true;
            //     //You've scrolled this much:
            //     let position = $(window).scrollTop();
            //     // console.log(position);
            //     if(position >= 1400){
            //
            //     }
            // });

            // setTimeout(() => {
                this.fetch();
            // }, 1500);
            // this.$store.dispatch('getProducts');
            this.checkSession();
        },

        // destroyed () {
        //     window.removeEventListener('scroll', this.handleScroll);
        // },



        methods: {
            miniCartSideBar(){
              EventBus.$emit('miniCartPopUp');
            },
            getImgUrl(image){
              return '/storage/'+image;
            },

            // handleScroll (event) {
            //
            //
            //     if(window.scrollY >= 1200){
            //         this.showCartBtn = true;
            //     }else if(window.scrollY < 1200){
            //         this.showCartBtn = false;
            //     }
            //     // console.log(window.scrollY);
            //     // this.showCartBtn = true;
            //
            //
            //
            //
            //    // console.log(event);
            // },

            // cartMethod(){
            //     this.bagshowhide = true;
            // },


            closeProductDetails(id){
                this.removeTagDialogs[id] = false;
            },

            async fetch(){
                let product = await axios.get(`/api/products?page=${this.page}`);
                this.products.push(...product.data.data);
                this.lastPage = product.data.meta.last_page;
                if(product){
                    this.isLoading = false;
                }

                //
                // this.products.forEach(item => {
                //     Array.isArray(this.$store.state.id, item.product.id)
                //     item.push()
                // });

            },

            handleScrollToBottom(isVisible){
                if(!isVisible) {return}
                if(this.page >= this.lastPage){return}
                this.page++;
                this.fetch();
            },

            addToCart(product, img){
                this.$store.state.checkCartProduct = true;
                this.$store.dispatch('addProductToCart', {
                    product: product,
                    quantity:1,
                    product_media: img,
                    session_id: this.checkSession()
                });
                this.singleCartItemPrice(product);

            },

            addToCartDetails(product, img){
                this.$store.dispatch('addProductToCart', {
                    product: product,
                    quantity: this.quantity,
                    product_media: img,
                    session_id: this.checkSession()
                });
                this.singleCartItemPrice(product);
            },

            decreasQty(product){

                this.$store.state.cart.find(item => {
                    if(item.product.id === product.id){
                        if(item.quantity == 1){
                            this.$store.state.cart.splice(this.$store.state.cart.indexOf(item), 1);
                            this.$store.dispatch('removeCartItem', item.product.id);
                        }else{
                            this.$store.dispatch('cartQuantityMinus',{
                                product:product,
                                quantity: 1
                            });
                        }
                    }
                });

            },

            // checkSession(){
            //     if(localStorage.getItem('session_id')){
            //         return localStorage.getItem('session_id');
            //     }else{
            //          localStorage.setItem('session_id', this.getRandomNumberBetween(111111111,999999999999));
            //        return localStorage.getItem('session_id');
            //     },
            //
            //
            // },

            checkSession(){
                let cookie = VueCookies.get('session_id');
                if(cookie){
                    return cookie;
                }else{
                    VueCookies.set('session_id' , this.getRandomNumberBetween(111111111,999999999999), "30d");
                    return  VueCookies.get('session_id');
                }
            },

            getRandomNumberBetween(min,max){
                return Math.floor(Math.random()*(max-min+1)+min);
            },

            trueOrFalse(product){
                return this.$store.state.cart.find(item => {
                    if(item.product.id === product.id){
                        return true;
                    }
                });
            },

            singleCartItem(product){
                return this.$store.state.cart.find(item => {
                    if(item.product.id === product.id){
                        return true;
                    }
                }).quantity;
            },



            singleCartItemPrice(product){
                return this.$store.state.cart.find(item => {
                    if(item.product.id === product.id){
                        return true;
                    }
                }).quantity * this.$store.state.cart.find(item => {
                    if(item.product.id === product.id){
                        return true;
                    }
                }).product.user_price;
            },
    },

        mounted() {


        },
        components:{
            imageZoom,
            MiniCart
        },

        // watch:{
        //     showCartBtn : function(value){
        //         $(window).scroll(function () {
        //             //You've scrolled this much:
        //             let position = $(window).scrollTop();
        //             if(position >= 1400){
        //                 console.log(position);
        //
        //                 return true;
        //             }
        //
        //         });
        //     }
        // },

        computed: {
            // products(){
            //     return this.$store.state.products;
            // },


            userType(){
              return User.user_type();
            },



            cartTotalPrice(){
                return this.$store.getters.cartTotalPrice;
            },

            cartItemCount(){
                return this.$store.getters.cartItemCount;
            },
            direction() {
                return this.navigation.shown === false ? "Open" : "Closed";
            },

        }
    }
</script>


<style lang="scss" scoped>

    .product_details_left_divider{
        width: 100%;
        ul{
            list-style: none;
            height: 40px;
            li{
                float: left;
                width: 147px;
                i{
                    color: #373618b5;
                    font-size: 25px;
                }
            }
        }
    }

    .product_details_right_divider{
        width: 100%;
        ul{
            list-style: none;
            height: 40px;
            width: 100%;
            li{
                float: left;
                width: 25%;
                font-size: 15px;
                line-height: 40px;
                img{
                    width: 90%;
                    height: 40px;
                }
            }
        }
    }
    .product_details_wrapper{
        margin-top: 5px;
    }
    .product_details_detail{
        padding-left: 15px;
    }
    .product_details_left_buttom_wrapper{
        padding-left: 15px;
    }

    .product_details_details_left_buttom{
        margin-top: 20px;
        width: 100%;
        .product_details_left_buttom_three{
            width: 200px;
            float: left;
            h3{
                font-size: 21px;
            }

            ul{
                list-style: none;
                li{
                    padding:4px 0;
                    a{
                        text-decoration:none;
                        color: #373618b5;
                    }
                }
            }

        }

    }

    .product_details_left_buttom_right{
        width: 100%;
        overflow: hidden;
        ul{
            list-style:none;
            li{
                width: 50%;
                float:left;
                
                img{
                    width: 118px;
                    height: 40px;
                    cursor: pointer;
                }
            }
        }
    }

    .v-dialog{
        overflow: hidden !important;
    }

    .product_details_left_buttom_buttom{
        width: 100%;
        margin-top: 10px;

        ul{
            list-style: none;
            overflow: hidden;
            margin-bottom: 15px;

            li{
               float:left;
                cursor:pointer;
                img{
                    width: 40px;
                    height: 40px;
                }
            }
        }
    }






</style>

<style>

   .content-zoom{
        width: 100%;
    }

   .content-zoom .pictures{
        width: 10%;
       height: 420px;
    }

   .content-zoom .picture{
        width: 72%;
    }


    .content-zoom {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        float: left;
        height: 420px;
        background-color: #ffffff;
        margin-right: 10px;
        margin-top: 10px;
    }

    .content-zoom div {
        margin: 10px;
    }

    .pictures {
        width: 64px;
    }

    .pictures img{
        margin-bottom: 6px;
        width: 60px;
        height: 60px;
        cursor: pointer;
    }

    .picture {
        position: relative;
        width: 100%;
        height: 420px;
    }

    .picture img {
        width: 100%;
    }

    .img-active {
        box-shadow: 0 0 10px #fc2133, 0 0 10px #fc2133, 0 0 10px #fc2133;
    }

    .rect {
        position: absolute;
        margin: 0px !important;
        padding: 0;
        width: 200px;
        height: 150px;
        background-color: #78787c4d;
        transform: translate(-50%, -50%);
        pointer-events: none;
        opacity: 0;
    }



    .zoom {
        position: absolute;
        top: 160px;
        left: 805px;
        box-shadow: 5px 5px 5px rgb(24, 24, 24);
        opacity: 0;
        overflow: auto;
        z-index: 20;
        display: none;
    }

    .rect-active {
        opacity: 1;
        /* display: none; */
    }

    .rect-no-razib{
        display: none;
    }

    .product-details{
        padding: 20px;
        color: #414242;
        margin-top: 20px;
    }




</style>

<style>
    .v-card--reveal {
        align-items: center;
        bottom: 0;
        justify-content: center;
        opacity: .5;
        position: absolute;
        width: 100%;
        background: #0b0808;
        cursor:pointer;
    }

    .v-responsive__content {
        flex: 243 0 0px !important;
        max-width: 100%;
        cursor:pointer
    }

    #header {
        top: 0;
        left: 0;
        right: 0;
        height: 25px;
        color: #fff;
    }
    #footer {
        bottom: 0;
        left: 0;
        right: 0;
        height: 25px;
        color: #fff;
    }
    .content {

        left: 0;
        right: 0;
        height: 200px;
        overflow: hidden;
        color: #fff;
        top: 100px;
        margin-top:100px;
        font-size: 26px;
    }

    .text-right-product{
        width: 75px;
        height: 100px;
        right: 0;
        background-color: red;
        text-align: right;
        display: inline-block;
        float: right;
        top: 40%;
        position: fixed;
        box-shadow: -3px 3px 3px #dddddd;
        cursor:pointer;
        overflow: hidden;
        z-index:1;
    }

    
    .text-right-top{
        width: 75px;
        height: 50px;
        background-color: #55584D;
    }
    
    .text-right-bottom{
        width: 75px;
        height: 50px;
        background-color: #F5FCEB;
        text-align: center;


    }
    .price-item-cart{
        width: 75px;
        display:block;
    }
    .text-right-bottom span{
        margin-right: 1px;
    }

    .text-right-top p{
        padding: 0;
        margin: 0;
        text-align:center;
    }
    .text-right-top p .text-right-icon{
        text-align: center;
    }
    .text-right-top p.text-right-item{
        color: #fff;
    }






</style>

<style lang="scss" scoped>
    .main-product{
        margin: 20px 0;
        padding: 0 15px;
        overflow:hidden;
        .product-title{
            font-size:18px;
            font-weight:600;
            color: #272727;
            margin-bottom: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
        }
        .all-product-main-show .single-product-main-show{
            margin-bottom: 15px;
            overflow: hidden;
            .single-product-single{
                margin: 0 5px;
            }
        }

        .product-add-cart-actions{
            text-align: center;
            overflow: hidden;
        }

        .product-price{
            text-align: center;
        }
    }

    .v-navigation-drawer__border{
       display:none !important;
    }


</style>
<style lang="sass" scope>
    .v-navigation-drawer__border
        display: none
    .text-right-side-bar-icon
      right: 0
      position: fixed


</style>