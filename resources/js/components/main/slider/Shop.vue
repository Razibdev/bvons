<template>
    <div>
        <v-layout row wrap style="z-index: -1">
            <v-flex xs12 sm12 md12>
            <div class="main-shop">
                <div class="shop-title">Our Shop</div>
                <swiper class="swiper" :options="swiperOption" ref="swiper">
                    <swiper-slide v-for="shop in shops" :key="shop.id">
                        <img :src=" getImgUrl(shop.shop_image)" alt="" height="60" width="65">
                        <h4>{{shop.shop_name}}</h4>
                    </swiper-slide>
                    <template v-slot:button-prev>
                        <div class="swiper-button-prev" style="color: #000; right: 30px; left: auto; top:3%;"
                             @click="$refs.swiper.swiperInstance.slidePrev()"></div>
                    </template>
                    <template v-slot:button-next>
                        <div class="swiper-button-next" style="color: #000; top:3%;"
                             @click="$refs.swiper.swiperInstance.slideNext()"></div>
                    </template>
                </swiper>
            </div>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
    import 'swiper/css/swiper.css'

    export default {
        data() {
            return {
                shops:[],
                swiperOption: {
                    slidesPerView: 3,
                    slidesPerColumn: 2,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },

                    breakpoints: {
                        1024: {
                            slidesPerView: 6,
                            spaceBetween: 30
                        },
                        768: {
                            slidesPerView: 6,
                            spaceBetween: 30
                        },
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        320: {
                            slidesPerView: 2,
                            spaceBetween: 10
                        }
                    }
                }
            }
        },
        components: {
            Swiper,
            SwiperSlide
        },
        created(){
            axios.get('/api/shops')
                .then(res =>{
                    this.shops = res.data.data
                } )
                .catch(error => console.log(error.response.data))
        },
        methods:{
            getImgUrl(pic) {
                return '/storage/'+pic;
            }
        }

    }
</script>

<style lang="scss" scoped>
    @import './base.scss';

    .main-shop{
        margin: 35px 0;

        .shop-title{
            font-size:18px;
            font-weight:600;
            color: #272727;
            margin-bottom: 10px;
            padding-left: 15px;
        }

        .swiper{
            .swiper-pagination{
                margin-bottom: -17px !important;
            }
        }
    }

    .swiper {
        height: 323px;
        margin-left: auto;
        margin-right: auto;

        .swiper-slide {
            height: 200px;
        }
    }

    .swiper-button-prev::after, .swiper-button-next::after{
        font-size: 20px;
    }



</style>

<style lang="sass" scoped>
    .swiper
      .swiper-slide
        height: 146px !important
</style>