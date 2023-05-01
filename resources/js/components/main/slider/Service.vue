<template>
    <section class="section">
        <v-layout row wrap>
            <v-flex xs12>
                <div style="width: 100%; display: block; align-items: center; ">
                    <h5 style="width: 100%;align-items: center;text-align: center; text-transform: uppercase;"> Our Services</h5>
                </div>

            </v-flex>
        </v-layout>
        <v-layout row wrap >


            <v-flex xs6 md2 style="overflow:hidden;" class="main-cards" v-for="(service, index) in services" :key="service.name">



                <div v-if="index === 0" @click="comingServiceSho(service.method)" >
                    <router-link :to="service.url" style="text-decoration: none;">
                    <v-card
                            class="mx-auto cards"
                            max-width="180"
                            outlined
                            style="margin-left: 15px !important; margin-right: 11px !important; margin-bottom: 1px !important;"
                    >

                        <v-list-item three-line >

                            <v-list-item-content style="padding: 30px 0">
                                <div class="text-overline mb-4" style="align-items: center; text-align: center">
                                    <span class="icon-font-css"><i class="icon-new-class" style="font-size: 30px" :class="service.icon"></i></span>

                                </div>
                                <v-list-item-title class="text-h5 mb-1 text-part" style="align-items: center; text-align: center">
                                   {{service.name}}
                                </v-list-item-title>

                            </v-list-item-content>

                        </v-list-item>
                    </v-card>
                    </router-link>
                </div>


                <div v-else-if="index === 3" @click="comingServiceSho(service.method)">
                    <div v-if="isAuth">
                        <div v-if="dealerCheck">
                            <router-link :to="service.url" style="text-decoration: none;">
                                <v-card
                                        class="mx-auto cards"
                                        max-width="180"
                                        outlined
                                        style="margin-left: 15px !important; margin-right: 11px !important; margin-bottom: 1px !important;"
                                >

                                    <v-list-item three-line >

                                        <v-list-item-content style="padding: 30px 0">
                                            <div class="text-overline mb-4" style="align-items: center; text-align: center">
                                                <span class="icon-font-css"><i class="icon-new-class" style="font-size: 30px" :class="service.icon"></i></span>

                                            </div>
                                            <v-list-item-title class="text-h5 mb-1 text-part" style="align-items: center; text-align: center">
                                                {{service.name}}
                                            </v-list-item-title>

                                        </v-list-item-content>

                                    </v-list-item>
                                </v-card>
                            </router-link>
                        </div>
                        <div v-else @click="bvonDealerForm()">
                                <v-card
                                        class="mx-auto cards"
                                        max-width="180"
                                        outlined
                                        style="margin-left: 15px !important; margin-right: 11px !important; margin-bottom: 1px !important;"

                                >

                                    <v-list-item three-line >

                                        <v-list-item-content style="padding: 30px 0">
                                            <div class="text-overline mb-4" style="align-items: center; text-align: center">
                                                <span class="icon-font-css"><i class="icon-new-class" style="font-size: 30px" :class="service.icon"></i></span>

                                            </div>
                                            <v-list-item-title class="text-h5 mb-1 text-part" style="align-items: center; text-align: center">
                                                {{service.name}}
                                            </v-list-item-title>

                                        </v-list-item-content>

                                    </v-list-item>
                                </v-card>
                        </div>
                    </div>
                    <div v-else  @click="bvonDealerAuthCheck">
                        <router-link to="#" style="text-decoration: none;">
                        <v-card

                                class="mx-auto cards"
                                max-width="180"
                                outlined
                                style="margin-left: 15px !important; margin-right: 11px !important; margin-bottom: 1px !important;"

                        >

                            <v-list-item three-line >

                                <v-list-item-content style="padding: 30px 0">
                                    <div class="text-overline mb-4" style="align-items: center; text-align: center">
                                        <span class="icon-font-css"><i class="icon-new-class" style="font-size: 30px" :class="service.icon"></i></span>

                                    </div>
                                    <v-list-item-title class="text-h5 mb-1 text-part" style="align-items: center; text-align: center">
                                        {{service.name}}
                                    </v-list-item-title>

                                </v-list-item-content>

                            </v-list-item>
                        </v-card>
                        </router-link>
                    </div>
                </div>


                <div v-else  @click="comingServiceSho(service.method)">
                    <router-link :to="service.url" style="text-decoration: none;" >
                        <v-card
                                class="mx-auto cards"
                                max-width="180"
                                outlined
                                style="margin-left: 15px !important; margin-right: 11px !important; margin-bottom: 1px !important;"
                        >

                            <v-list-item three-line >

                                <v-list-item-content style="padding: 30px 0">
                                    <div class="text-overline mb-4" style="align-items: center; text-align: center">
                                        <span class="icon-font-css"><i class="icon-new-class" style="font-size: 30px" :class="service.icon"></i></span>

                                    </div>
                                    <v-list-item-title class="text-h5 mb-1 text-part" style="align-items: center; text-align: center">
                                        {{service.name}}
                                    </v-list-item-title>

                                </v-list-item-content>

                            </v-list-item>
                        </v-card>
                    </router-link>
                </div>
            </v-flex>





        </v-layout>
    </section>
</template>





<script>
    export default {
        name: "Service",
        data(){
            return{
                services:[
                    {name: 'Bvon B-Doctor', url:'/bvon-doctor-service-view', icon:'fas fa-user-md', method: ''},
                    {name: 'Social Media', url:'/bvon-social', icon:'fas fa-icons', method: ''},
                    {name: 'E-commerce', url:'/bvon-ecommerce', icon:'fas fa-shopping-cart', method: ''},
                    {name: 'Bvon Shop', url:'/bvon-shop', icon:'fas fa-shopping-basket', method: ''},
                    {name: 'B-learning School', url:'#', icon:'fas fa-graduation-cap', method: 'school'},
                    {name: 'B-Pay', url:'#', icon:'fab fa-cc-amazon-pay', method: 'bpay'},

                    {name: 'Freelancing', url:'#', icon:'fas fa-chalkboard-teacher', method: 'freelancing'},
                    {name: 'Bvon Service', url:'#', icon:'fab fa-servicestack', method: 'bvonservice'},
                    {name: 'B-Food', url:'#', icon:'fas fa-utensils', method: 'bfood'},
                    {name: 'B-Ride', url:'#', icon:'fas fa-plane-arrival', method: 'b-ride'},
                    {name: 'B-Courier', url:'#', icon:'fas fa-baby-carriage', method: 'bcourier'},
                    {name: 'Blood Bank', url:'#', icon:'fas fa-clipboard-check', method: 'bloodbank'},
                    // {name: 'Charity', url:'#', icon:'fas fa-hands-helping'},
                    // {name: 'B-Bazar', url:'#', icon:'fas fa-shopping-basket'},
                    // {name: 'B-Quiz', url:'#', icon:'fas fa-puzzle-piece'},
                    // {name: 'B-Game', url:'#', icon:'fas fa-gamepad'},
                    // {name: 'B-Test', url:'#', icon:'fas fa-pen-square'},
                    // {name: 'Security Solutions', url:'#', icon:'far fa-cctv'},
                    // {name: 'Mobile Top Up', url:'#', icon:'fas fa-phone-office'},
                ],
                dealerCheck:User.dealer(),
                isAuth: User.loggedIn()
            }
        },
        methods:{
            bvonDealerAuthCheck(){
                this.$alert("Please Login Fast");
            },

            comingServiceSho(value){
                if(value != ''){
                    this.$alert("This Service Comming Soon......");
                }
                return false;
            }
        }
    }
</script>

<style scoped>

    .section{
        overflow: hidden;
        margin-top: 20px;
        margin-bottom: 40px;
    }

    .section h5{
        padding: 20px  0;
        padding-left: 12px;
        font-size: 30px;
        font-weight: 700;
    }

    .section .main-cards{
        margin-bottom: 10px;

    }

    .section .main-cards .cards{
        background-color: #468180;
        cursor: pointer;
        box-shadow: 0 0px 5px 0px #0000002e;
        margin-right: 1px;

    }

    .section .main-cards .cards::before{
        content: '';
        position: absolute;
        left:0;
        bottom:0;
        width:0;
        box-sizing: border-box;
        height: 0;
        border-bottom: 3px solid transparent;
        border-left: 3px solid transparent;
        transition: all .8s ease;
    }
    .section .main-cards .cards::after{
        content: '';
        position: absolute;
        right:0;
        top:0;
        width:0;
        box-sizing: border-box;
        height:0;
        border-top: 3px solid transparent;
        border-right: 3px solid transparent;
        transition: all .8s ease;
    }
    .section .main-cards:hover .cards::after,
    .section .main-cards:hover .cards::before{
        border-color: #0ecde7;
        width: 100% !important;
        height: 100% !important;
    }

    .section .main-cards .icon-font-css{
        width: 75px;
        height: 88px;
        padding: 20px 10px 10px 10px;
        border-radius: 50%;
        border: 1px solid #0ecde7;
        background-color: #0ecde7;
    }
    .section .main-cards .icon-font-css .icon-new-class{
        color: #ffffff;
    }
    .section .main-cards:hover .icon-font-css{
        width: 75px;
        height: 88px;
        background: #44ccebe0;
        padding: 20px 10px 10px 10px;
        border-radius: 50%;
        color: white;
    }

    .section .main-cards .text-part{
        text-transform: capitalize;
        font-size: 18px;
        line-height: 30px;
        margin-top: 15px;
        font-weight: 500;
        color: white;
    }


</style>

