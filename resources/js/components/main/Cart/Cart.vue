<template>
    <div>
        <v-form @submit.prevent="orderComplete"  v-model="valid" >
         <v-layout row wrap>
            <v-flex xs12 md8 class="mr-10">
                <v-card
                        class="mx-auto"
                >
                    <v-card-text>
                       <h3 class="information-title">Delivery Information</h3>
                       <p class="information-title-sub">bvon.app দিচ্ছে সর্বনিম্ন ৩০ মিনিট থেকে সর্বোচ্চ ২৪ ঘন্টায় ডেলিভারী</p>


                        <v-row style="margin-top: 10px">

                            <v-col
                                    cols="12"
                                    sm="6"
                            >
                                <v-text-field
                                        label="Name"
                                        single-line
                                        solo
                                        :rules="nameRules"
                                        :value="user"
                                        v-model="form.name"
                                        required
                                ></v-text-field>
                            </v-col>



                            <v-col
                                    cols="12"
                                    sm="6"
                            >
                                <v-text-field
                                        label="Mobile"
                                        single-line
                                        solo
                                        :rules="phoneRules"
                                        :value="phone"
                                        v-model="form.phone"
                                        required
                                ></v-text-field>
                            </v-col>

                            <v-col
                                    cols="12"
                                    sm="6"
                            >
                                <v-select
                                        :items="district"
                                        solo

                                        item-text="name"
                                        item-value="id"
                                        label="City"
                                        v-model="selectDistrict"
                                ></v-select>
                            </v-col>



                            <v-col
                                    cols="12"
                                    sm="6"
                            >
                                <v-select
                                        :items="area"
                                        solo
                                        item-text="name"
                                        item-value="id"
                                        label="Area"
                                        v-model="form.area"
                                ></v-select>
                            </v-col>



                            <v-col
                                    cols="12"
                                    sm="12"
                            >
                                <v-text-field
                                        label="Address"
                                        single-line
                                        :rules="addressRules"
                                        :value="address"
                                        solo
                                        v-model="form.full_address"
                                        required
                                ></v-text-field>
                            </v-col>


                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="12">
                                <v-row>
                                    <v-col sm="6" cols="12">
                                        <h3 style="font-size: 16px;">Preferred Delivery Timings (Optional)</h3>
                                    </v-col>
                                    <v-col sm="6" cols="12">
                                        <h3 style="font-size: 16px;" >When would you like your Express Delivery Time?(Optional)</h3>
                                    </v-col>
                                </v-row>
                            </v-col>

                            <v-col
                                    cols="12"
                                    sm="6"
                            >
                                <v-text-field
                                        label="date"
                                        single-line
                                        solo
                                        type="date"
                                        v-model="form.date"
                                ></v-text-field>
                            </v-col>


                            <v-col
                                    cols="12"
                                    sm="6"
                            >
                                <v-select
                                        :items="items"
                                        solo
                                        label="Time"
                                        item-value="id"
                                        item-text="name"
                                        v-model="form.time"
                                ></v-select>
                            </v-col>

                        </v-row>

                    </v-card-text>

                </v-card>

            </v-flex>
            <!--<v-flex class="d-none d-sm-flex" md1></v-flex>-->
            <v-flex xs12 md4>
                <v-card
                        class="mx-auto"
                >
                    <v-card-text>
                       <h3 class="order-sammary_title">Order Summary</h3>
                        <v-divider></v-divider>
                        <h5 class="product-total-title">Products Total ( {{cartItemCount}} )</h5>
                        <div class="order_summery_second">
                            <ul>
                                <li v-for=" item in cart" :key="item.id" v-if="userType !== 'GU'">{{item.product_name}} <span>Tk. {{item.product.premium_price}}</span></li>
                                <li v-for=" item in cart" :key="item.id" v-else>{{item.product_name}} <span>Tk. {{item.product.user_price}}</span></li>
                            </ul>
                        </div>
                        <div class="order_summery_second">
                            <ul>
                                <li class="order_summery_third">Sub-total <span>Tk. {{cartTotalPrice}}</span></li>
                            </ul>
                        </div>


                        <div class="order_summery_second">
                            <ul>
                                <li>Discount  <span>Tk. 00.00</span></li>
                                <li>Shipping Cost  <span>Tk. 00.00</span></li>
                            </ul>
                        </div>
                        <v-divider></v-divider>

                        <div class="order_summery_second order_summer_total">
                            <ul>
                                <li class="order_summery_third">Total: <span>Tk. {{cartTotalPrice}}</span></li>
                            </ul>
                        </div>

                        <v-card
                                class="mx-auto payment-main-cart"
                                max-width="344"
                                outlined
                        >
                            <h5>Payment</h5>

                            <v-radio-group
                                    v-model="form.payment"
                                    mandatory
                            >
                                <v-radio
                                        label="Cash On Delivery"
                                        value="cash"
                                ></v-radio>
                                <v-radio
                                        label="Online Payment"
                                        value="online"
                                ></v-radio>
                            </v-radio-group>

                            <!--<div class="radio-group">-->
                                <!--<span><input type="radio" id="payment"  v-model="form.payment"  value="cash" checked> Cash On Delivery</span><br>-->

                                <!--<span><input type="radio" id="payment1" v-model="form.payment" value="online"> Online Payment</span>-->
                            <!--</div>-->

                            <v-row
                                   wrap
                            >
                                <v-col cols="8" xs="8">
                                    <v-text-field
                                            label="Enter Coupon Code"
                                            single-line
                                            solo
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="4" xs="4">
                                    <v-btn class="coupon-btn"  depressed>
                                        Submit
                                    </v-btn>
                                </v-col>

                            </v-row>
                        </v-card>
                        <span v-if="cartTotalPrice > 0">
                        <v-row >
                                <v-btn v-if="own" type="submit" class="place_order_btn_final"  :disabled="!valid"  @click="validate">Place Order</v-btn>

                        </v-row>
                        </span>
                        <span v-else>
                             <v-row >
                                <v-btn class="place_order_btn_final"    @click="totalCartAmountNotZero">Place Order</v-btn>
                             </v-row >
                            </span>

                        <v-row>
                            <router-link v-if="userType !== 'GU'" to="/shopping-other-cart-list" class="place_order_btn_finals">
                                <p>Order For Others</p>
                            </router-link>
                        </v-row>

                    </v-card-text>

                </v-card>
            </v-flex>
        </v-layout>
        </v-form>
    </div>
</template>

<script>
    export default {
        name: "Cart.vue",
        data: () => ({
            date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            menu: false,
            items: [
                {name:'9.00 am - 8.00pm', id:1},
                {name:'9.00 am - 8.00pm', id:2}
                ],
            radios: 1,
            area: [],
            selectDistrict: '',
            form:{
                name: User.user(),
                phone: User.phone(),
                full_address: User.address(),
                date: new Date(),
                time: null,
                area:null,
                payment:null,
                id: User.id(),
                type:null
            },
            valid: true,
            nameRules: [
                v => !!v || 'Name is required',
            ],
            phoneRules: [
                v => !!v || 'Phone is required',
            ],

            addressRules: [
                v => !!v || 'Address is required',
            ]

        }),
        watch : {
            selectDistrict : function(value){
                axios.get('/api/area?district_id='+this.selectDistrict)
                    .then(res =>{
                        this.area = res.data.data;
                    });
            }
        },

        methods:{
            totalCartAmountNotZero(){
                this.$alert("No product added to cart");
            },

            orderComplete(){
               this.$store.dispatch('orderComplete', {
                   info : this.form,
                   city: this.selectDistrict,
                   total : this.$store.getters.cartTotalPrice,
                   cart: this.$store.state.cart
               });
                this.$router.push({name:'order-list'});
                this.$store.dispatch('getOrderList', User.id());
            },

            validate () {
                this.$refs.form.validate()
            },
        },

        computed: {
            user(){
              return User.user();
            },

            userType(){
                return User.user_type();
            },

            phone(){
                return User.phone();
            },

            address(){
              return User.address();
            },

            own(){
                return User.loggedIn();
            },


            cart(){
                return this.$store.state.cart;
            },

            cartTotalPrice(){
                return this.$store.getters.cartTotalPrice;
            },

            cartItemCount(){
                return this.$store.getters.cartItemCount;
            },

            district(){
                return this.$store.state.district;
            }

        },
        mounted() {
            this.$store.dispatch('getCartItems');
            this.$store.dispatch('district');
            // console.log(User.address());
        }
    }
</script>

<style lang="scss" scoped>
    .information-title{
        font-size: 24px;
        font-weight: 600;
        color: #dc3545;
    }

    .information-title-sub{
        font-size: 14px;
        font-weight: bold;
    }

    .order-sammary_title{
        font-size: 24px;
        font-weight: 600;
        color: #dc3545;
    }

    .product-total-title{
        font-size: 18px;
        font-weight: 400;
        color:#111
    }

    .order_summery_second{
        ul{
            list-style: none;
            li{
                width: 100%;
                font-size: 15px;
                span{
                    float: right;
                }

                &.order_summery_third{
                    font-weight: 600;
                    font-size: 17px;
                    color: #111;
                }
            }

        }
    }



    .payment-main-cart{
        padding: 10px;
        background: #F2F2F2;
        h5{
            font-weight: 400;
            font-size: 18px;
            color: #111;
        }

        .radio-group{
            margin-bottom: 20px;

        }

        .coupon-btn{
            background: teal;
            height: 49px;
            color: white;
            margin-left: -28px;
        }
    }
.place_order_btn_final{
    height: 48px;
    min-width: 64px;
    padding: 0 16px;
    width: 87%;
    margin: 30px auto 20px;
    background-color: #dc3545 !important;
    color: #fff;
}
.place_order_btn_finals{
    height: 48px;
    min-width: 64px;
    padding: 0 16px;
    width: 87%;
    margin: 0 auto 20px;
    background-color: #9e3c45 !important;
    color: #fff;

    p{
        text-align: center;
        text-decoration: none;
        align-items: center;
        height: 48px;
        margin-top: 12px;
    }
    &:hover{
        text-decoration:none;
    }
}







</style>

<style lang="sass" scoped>
    .v-picker__title
     background-color: #0C9A9A !important

    .v-btn--active
      color: #0C9A9A !important
      background: #0C9A9A !important
      &:before
       color: #0C9A9A !important
       background: #0C9A9A !important

</style>