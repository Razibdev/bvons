<template>
    <div>
        <!--<v-app class="side-bar-main-right" style="width: 100%;">-->
        <!--<div style="justify-items: right; width: 100%; float: right;"><v-icon class="text-right-side-bar-icon">mdi-chevron-right</v-icon></div>-->

        <v-navigation-drawer class="nagiation-side-bar-righ" ref="drawer" app right hide-overlay :width="navigation.width" v-model="navigation.shown">
            <div id="side-bar-main-part">
                <div id="side-bar-top-part">
                    <span class="text-right-left-arraw" @click="hideRightSideBar"></span>
                    <v-toolbar color="primary">
                        <v-toolbar-title class="headline text-uppercase">
                            <div class="main-side-bar"><p><v-icon >mdi-bag-personal</v-icon> {{cartItemCount}} ITEMS</p> <p @click="hideRightSideBar">Close</p></div>
                        </v-toolbar-title>
                    </v-toolbar>

                    <v-list dense>
                        <v-subheader>REPORTS</v-subheader>
                        <v-list-item-group
                                color="black"
                        >
                            <v-list-item
                                    v-for="(item, i) in dealerCart"
                                    :key="i"
                            >

                                <v-list-item-icon >
                                    <v-list-item-title>{{i+1}}</v-list-item-title>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title><img width="65" height="30" :src="getImgUrl(item.product_media)" alt=""></v-list-item-title>
                                </v-list-item-content>

                                <v-list-item-content>
                                    <v-list-item-title  style="text-align: center;" >{{item.product.purchase_price}}</v-list-item-title>
                                </v-list-item-content>


                                <v-list-item-content>
                                    <v-list-item-title style="text-align: center;"><v-icon style="color: #0a0a0a; z-index: 20;" @click="decreaseDealerCartQtn(item)">mdi-chevron-left</v-icon>  {{item.quantity}} <v-icon style="color: #0a0a0a; z-index: 20;" @click="increaseDealerCartQty(item)">mdi-chevron-right</v-icon></v-list-item-title>
                                </v-list-item-content>

                                <v-list-item-icon >
                                    <v-icon color="black" style="color: #0a0a0a;" @click="removeDealerCartItem(item)" > mdi-delete &nbsp;</v-icon>
                                </v-list-item-icon>

                            </v-list-item>
                        </v-list-item-group>
                    </v-list>

                </div>

                <div id="side-bar-bottom-part" style="margin-bottom: -46px;">
                    <div class="button-payment-option">
                        <div class="button-payment-left">
                            <div v-if="own">
                                <div v-if="cartItemCount > 0" >
                                    <v-btn class="router-link auth-router-link-ok" @click="updateCartAuth">Place Order</v-btn>

                                </div>

                                <div v-else>
                                    <v-btn class="router-link auth-router-link-ok" @click="NotProductAddToCart">Place Order</v-btn>

                                </div>

                            </div>
                            <div v-else>
                                <button class="router-link" @click="loginForm">Place Order</button>

                            </div>

                        </div>
                        <div class="button-payment-right">
                            TK {{cartTotalPrice}}
                        </div>
                    </div>
                </div>
            </div>

        </v-navigation-drawer>


        <div class="text-center">
            <v-dialog
                    v-model="dealer_order_check"
                    width="400"
            >
                <v-card>
                    <v-card-title  class="text-h5 grey lighten-2" style="background-color: teal; color: #fff">
                        Dealer Change
                    </v-card-title>
                    <v-form @submit.prevent="dealerOrderCompleteNow" method="post">

                        <v-card-text>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Phone Number"
                                        placeholder="Phone Number"
                                        solo
                                        v-model="phone"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Full Address"
                                        placeholder="Full Address"
                                        solo
                                        v-model="address"
                                ></v-text-field>
                            </v-col>

                        </v-card-text>

                        <!--<v-divider></v-divider>-->

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                    color="primary"
                                    style="background-color: teal; color: #fff;"
                                    type="submit"
                                    text
                                    @click="dealer_order_check = false"
                            >
                                Order Confirm
                            </v-btn>
                        </v-card-actions>

                    </v-form>
                </v-card>
            </v-dialog>
        </div>

        <!--</v-app>-->
    </div>
</template>

<script>
    export default {
        name: "DealerMiniCart",
        data(){
            return{
                dealer_order_check:false,
                phone: User.phone(),
                address: User.address(),
                navigation: {
                    shown: false,
                    width: 350,
                    borderSize: 3
                },
            }
        },

        computed:{

            dealerCart(){
                return this.$store.state.dealerCart;
            },

            cartTotalPrice(){
                return this.$store.getters.dealerCartTotalPrice;
            },

            cartItemCount(){
                return this.$store.getters.dealerCartItemCount;
            },

            own(){
                return User.loggedIn();
            },
            userType(){
                return User.user_type();
            }
        },

        created() {
            EventBus.$on('dealerMiniCart', () =>{
                this.navigation.shown = !this.navigation.shown;
            });

            EventBus.$on('showCartBtnIfCart', () =>{
                this.navigation.shown = !this.navigation.shown;
            });
        },

        methods:{


            dealerOrderCompleteNow(){
                let address = this.address;
                let phone = this.phone;
                let cart = this.$store.state.dealerCart;
                let total = this.$store.getters.dealerCartTotalPrice;
                this.$store.dispatch('dealerOrderCompleteNow', { address, phone, cart, total});
                this.$router.push('/bvon-shop-order-list')


            },

            getImgUrl(image){
                return '/storage/'+image;
            },

            decreaseDealerCartQtn(item){

                item.quantity--;
                if(item.quantity < item.product.minimum_quantity){
                    this.$store.state.dealerCart.splice(this.$store.state.dealerCart.indexOf(item), 1);
                    this.$store.dispatch('removeDealerCartItem', item.id);
                }else{
                    this.$store.dispatch('decreaseDealerCartQtn', item);
                }
            },

            increaseDealerCartQty(item){
                item.quantity++;
                this.$store.dispatch('increaseDealerCartQtn', item);
            },

            removeDealerCartItem(item){
                this.$store.state.dealerCart.splice(this.$store.state.dealerCart.indexOf(item), 1);
                this.$store.dispatch('removeDealerCartItem', item.id);
            },

            hideRightSideBar(){
                this.navigation.shown = false;
            },

            setBorderWidth() {
                let i = this.$refs.drawer.$el.querySelector(
                    ".v-navigation-drawer__border"
                );
                i.style.width = this.navigation.borderSize + "px";
                i.style.cursor = "ew-resize";
                i.style.backgroundColor = "red";
            },
            setEvents() {
                const minSize = this.navigation.borderSize;
                const el = this.$refs.drawer.$el;
                const drawerBorder = el.querySelector(".v-navigation-drawer__border");
                const vm = this;
                const direction = el.classList.contains("v-navigation-drawer--right")
                    ? "right"
                    : "left";

                function resize(e) {
                    document.body.style.cursor = "ew-resize";
                    let f =
                        direction === "right"
                            ? document.body.scrollWidth - e.clientX
                            : e.clientX;
                    el.style.width = f + "px";
                }

                drawerBorder.addEventListener(
                    "mousedown",
                    (e) => {
                        if (e.offsetX < minSize) {
                            el.style.transition = "initial";
                            document.addEventListener("mousemove", resize, false);
                        }
                    },
                    false
                );

                document.addEventListener(
                    "mouseup",
                    () => {
                        el.style.transition = "";
                        this.navigation.width = el.style.width;
                        document.body.style.cursor = "";
                        document.removeEventListener("mousemove", resize, false);
                    },
                    false
                );
            },


            getRandomNumberBetween(min,max){
                return Math.floor(Math.random()*(max-min+1)+min);
            },

            loginForm(){
                EventBus.$emit('loginOpen');
            },
            updateCartAuth(){

                this.dealer_order_check = true;


            },

            NotProductAddToCart() {
                this.$alert("No product added to cart");
            }
        },

        mounted() {
            this.setBorderWidth();
            this.setEvents();
            this.$store.dispatch('getDealerCartItems');
        }
    }
</script>

<style scoped>
    .nagiation-side-bar-righ{
        box-shadow: -3px 0 2px #dddddd;
        z-index: 20;
        overflow: hidden;
    }

    .nagiation-side-bar-righ #side-bar-main-part{
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }


    #side-bar-top-part, #side-bar-bottom-part{
        position:absolute;
    }

    #side-bar-top-part{
        top: 0;
        width: 100%;
        position: absolute;
        overflow: scroll;
        height: 95%;
    }

    #side-bar-bottom-part{
        display: block;
        height: 100px;
        width: 320px;
        bottom: 0;
        margin-left: 15px;
        margin-bottom: -8px;
        z-index: 20;
    }


    .nagiation-side-bar-righ span.text-right-left-arraw::before{
        content: "\003E";
        width: 25px;
        height: 30px;
        color: white;
        padding: 5px;
        background: gray;
        position: fixed;
        top: 50%;
        cursor:pointer;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        left: -3px;
        z-index: 20;

    }

    .main-side-bar{
        width: 350px;
    }
    .main-side-bar p{
        width:  50%;
        float: left;
        color: black;
        padding-left: 10px;
        font-size:15px;
    }

    .main-side-bar p:last-child{
        float: right;
        width:15%;
        right:0;
        padding: 5px;
        background: #ddd;
        border: 1px solid;
        font-size: 11px;
        cursor:pointer;
        margin-right: 35px;
    }
    .main-side-bar p:last-child:hover{
        background: #BDBABA;
        color: #fff;
        border: 1px solid #0a0a0a;
    }
    .main-side-bar p i.mdi-bag-personal{
        color: #000;
        font-size: 23px;
    }

    .button-payment-option{
        width: 100%;
        height: 40px;
        bottom: 0;
        cursor:pointer;
    }

    .button-payment-option .button-payment-left{
        width: 70%;
        height: 40px;
        float: left;
        text-align:center;
        padding: 15px;
        background: #FF8182;

    }

    .button-payment-option .button-payment-right{
        width: 30%;
        height: 40px;
        float: right;
        background: #E04F54;
        padding: 10px 0;
    }

    .auth-router-link-ok{
        background: transparent !important;
        margin-top: -13px;
    }
</style>