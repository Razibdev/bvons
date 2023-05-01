<template>
    <section style="margin-bottom: 30px; width: 100%; overflow:hidden;">
        <loader v-if="isLoading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#ffffff" objectbg="#999793" opacity="100" disableScrolling="true" name="dots"></loader>

        <v-layout row wrap style="margin: 0; width: 100%;">

            <v-flex xs12 md12>

                <div class="text-right-product" @click="miniCartSideBar" style="width: 77px; right: 0; position: fixed; z-index: 1; text-align: center; top: 400px; background: transparent">
                    <div   >
                        <div class="text-right-top" >
                            <p><v-icon class="text-right-icon">mdi-bag-personal</v-icon></p>
                            <p class="text-right-item"> <span>{{cartItemCount}}</span> ITEMS</p>
                        </div>
                        <div class="text-right-bottom">
                            <span class="price-item-cart">TK</span><span>&nbsp; {{cartTotalPrice}}</span>
                        </div>
                    </div>

                </div>




            </v-flex>

            <v-flex md2 sm4 xs6 class="single-product" v-for="(product, index ) in products" :key="product.id">
                <div class="card">
                    <div class="cover">
                        <img :src="getImgUrl(product.media.product_image)" alt="" />
                        <div>
                            <h6 style="padding: 5px 0; height: 50px; margin-bottom: 0 !important;">{{product.product_name}}</h6>
                            <p style="margin-bottom: 0">{{product.product_size}}</p>
                            <p style="margin-bottom: 0.4rem"><span>TK</span> {{product.purchase_price}}</p>
                            <div class="selectinput">
                                <v-text-field  v-model="quantity[index]" :value="minimumQty(product.minimum_quantity, index)"  label="Qty" solo class="minimum-qunatity" style="padding:0 50px"></v-text-field>
                            </div>
                        </div>
                    </div>
                    <div>
                        <v-btn style="background-color: #4FA446; display: block; width: 100%; " @click="addToDealercard(product.minimum_quantity, product, product.media.product_image, index)">Add to cart</v-btn>
                    </div>
                </div>
            </v-flex>


            <div style="height: 55px; width: 100%;" v-if="products.length" v-observe-visibility="handleScrollToBottom"></div>
        </v-layout>
            <dealer-mini-cart></dealer-mini-cart>
    </section>
</template>

<script>
    import DealerMiniCart from '../Cart/DealerMiniCart'
    export default {
        name: "BvonShop",
        data(){
            return{
                products:[],
                lastPage:1,
                page:1,
                quantity:[],
                isLoading:true

            }
        },
        components:{
            DealerMiniCart
        },
        methods:{

            miniCartSideBar(){
                EventBus.$emit('dealerMiniCart');
            },

            minimumQty(min, index){
                if (this.quantity[index] === undefined) {
                    this.quantity[index] = min;
                }
               else {
                    this.quantity[index] = this.quantity[index];
                }

            },

            addToDealercard(min, product, img, index){
                let qty = parseInt(this.quantity[index]);

              if(qty >= min){

                  this.$store.dispatch('addDealerProductToCart', {
                      product: product,
                      quantity: qty,
                      product_media: img,
                  });

              }  else{


                  // if(res.data.type === 'success') {
                  //     this.$store.dispatch('addNotification', {
                  //         type: 'success',
                  //         message: res.data.message
                  //     });
                  //     EventBus.$emit('withdrawRequest')
                  //
                  // }else{
                  //     this.$store.dispatch('addNotification', {
                  //         type: 'error',
                  //         message: res.data.message
                  //     });
                  // }



                  this.$store.dispatch('addNotification', {
                      type: 'error',
                      message: 'Increase more quantity for this product at least '+min +' qty'
                  });

              }
            },












            getImgUrl(image){
                return '/storage/'+image;
            },
            async fetch(){
                let product = await axios.get(`/api/dealer-products?page=${this.page}`);
                console.log(product.data.data);
                this.products.push(...product.data.data);
                this.lastPage = product.data.last_page;

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
        },
        created() {
            this.fetch();
        },

        computed:{

            cartItemCount(){
                return this.$store.getters.dealerCartItemCount;
            },

            cartTotalPrice(){
                return this.$store.getters.dealerCartTotalPrice;
            }
        }
    }
</script>


<style lang="scss" scoped>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");



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








    .single-product{
        padding-right: 10px;
        margin-bottom: 20px;
    }

    .single-product:nth-child(6n+7) {
        padding-right:0;
    }
    .card {
        font-family: "Inter", sans-serif;
        width: 220px;
        max-width: 100%;
        /*border: solid 1px green;*/
        border-radius: 0.4rem;
        text-align: center;
        /*overflow: hidden;*/
        /*margin-right: 10px;*/
        box-shadow: 0 0 3px #b2c1cf;
    }


    .cover {
        /*overflow: hidden;*/
        margin: 0.2rem;
    }
    img {
        text-align: center;
        width: 170px;
        height: 140px;
    }
</style>

<style lang="sass">
    .selectinput
        padding-top:0 !important
        margin-top:0 !important
        .v-input__control
            .v-text-field__details
                display: none !important

</style>