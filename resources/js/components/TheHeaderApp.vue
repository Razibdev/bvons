<template>
    <section class="header-wrapper">
        <div class="main-header">
            <div class="header-left">
                <router-link to="/">
                    <img width="200px" height="65px" src="frontend/image/logo.png" alt="">
                </router-link>
            </div>
            <div class="header-right">
                <div class="d-none d-sm-flex">
                    <div class="right-header-single">
                        <ul class="right-left-ul">
                            <li><span class="right-header-icon"><i class="fas fa-envelope"></i></span></li>
                            <li><span>Email: </span> <span>bvononline@gmail.com</span></li>
                        </ul>
                    </div>

                    <div class="right-header-singles" >
                        <a href="tel:+8801788999966">
                            <ul>
                                <li><span class="right-header-icon"> <i class="fas fa-phone-alt"></i></span></li>
                                <li><span>Emergency</span> <span> +8801788999966</span></li>
                            </ul>
                        </a>
                    </div>

                    <div class="right-header-singles" >
                        <a href="#">
                            <ul>
                                <li><span class="right-header-icon"> <i class="fas fa-map-marker-alt"></i></span></li>
                                <li style="margin-top: -10px"><span>House #13(2nd Floor), Road #2, Sector #6 Uttara, Dhaka-1230</span></li>
                            </ul>
                        </a>
                    </div>
                </div>
                <div class="d-flex d-sm-none">
                    <span class="main-header-right-icon" @click="firstNavbarActiveNow"><i class="fas fa-user-cog top-right-icon"></i></span>
                    <ul class="first-navbar-mobile-view" :class="{'first-navar-active': firstNavbarActive}">
                        <li v-for="(service,index) in services" :key="service.name" @click="comingServiceSho(service.method)">
                            <div v-if="index === 0">
                                <router-link :to="service.url"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</router-link>
                            </div>

                            <div v-else-if="index === 3">
                                <div v-if="isAuth">
                                    <div v-if="dealer">
                                        <router-link :to="service.url"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</router-link>
                                    </div>
                                    <div v-else>
                                        <a href="#" @click="bvonDealerForm()" ><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</a>

                                    </div>
                                </div>
                                <div v-else>
                                    <a href="#" @click="bvonDealerAuthCheck"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</a>
                                </div>
                            </div>
                            <div v-else>
                                <router-link :to="service.url"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</router-link>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="second-header">

            <div class="left-second-header">
                <span @click="activeNavBarNow" class="d-flex d-sm-none"><i  class="fas fa-bars font-icon-second-header"></i></span>

                <ul :class="{'second-navar-active' : showNavIcon}" >
                    <li><a href="#">About Us</a></li>
                    <li class="d-none d-sm-flex">
                        <a href="#">Our Service</a>
                        <ul>
                            <li v-for="(service, index) in services" :key="service.name" @click="comingServiceSho(service.method)">
                                <div v-if="index === 0">
                                    <router-link :to="service.url"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</router-link>
                                </div>

                                <div v-else-if="index === 3">
                                    <div v-if="isAuth">
                                        <div v-if="dealer">
                                            <router-link :to="service.url"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</router-link>
                                        </div>
                                        <div v-else>
                                            <a href="#" @click="bvonDealerForm()" ><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</a>

                                        </div>
                                    </div>
                                    <div v-else>
                                      <a href="#" @click="bvonDealerAuthCheck"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</a>
                                    </div>
                                </div>
                                <div v-else>
                                    <router-link :to="service.url"><span><i class="service-icon" :class="service.icon"></i></span> {{service.name}}</router-link>
                                </div>

                            </li>

                        </ul>
                   </li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li>&nbsp;<a href="#">Carrier</a></li>
                </ul>

            </div>

            <div class="right-second-header">
                <ul>
                    <li v-if="!isAuth"><a href="#"><popup-login></popup-login></a></li>
                    <li v-if="isAuth">
                        <v-menu
                                v-if="inwidth"
                            left
                            bottom
                            content-class="profile_section_header_nav"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <p
                                    color="primary"
                                    v-bind="attrs"
                                    v-on="on"
                                    text
                                    style="font-size: 17px !important; color: #fff !important;margin-right: 27px;height: 23px;"
                            >
                                Profile
                            </p>
                        </template>
                        <v-list style="background: #018EA9">
                            <v-list-item>
                                <v-list-item-title style="text-align: center"><v-avatar
                                        color="orange"
                                        size="62"
                                >
                                    <img v-if="authInfo.profile_pic" :src="imageUrl(authInfo)" alt="">
                                    <img v-else src="css/frontend/img/logo.png" alt="">
                                </v-avatar></v-list-item-title>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-title style="color: #ffffff;"><span>{{authInfo.name}}</span></v-list-item-title>

                            </v-list-item>
                            <v-list-item v-if="authInfo.referral_id">
                                <v-list-item-title  style="color: #ffffff;"><span>{{authInfo.referral_id}}</span> <span aria-label="verified" data-balloon-pos="right"><v-icon style="color: rgb(7 245 135);">mdi-check-circle</v-icon></span></v-list-item-title>

                            </v-list-item>
                            <v-list-item
                                    style="box-shadow: 2px 2px 3px #ffffff;"
                                    v-for="(item, index) in items"
                                    :key="item.title"
                            >
                                <div v-if="index === 1">
                                    <v-list-item-title><router-link :to="item.url" target="_blank" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;" ><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</router-link></v-list-item-title>

                                </div>

                                <div v-else-if="index === 7">
                                    <v-list-item-title @click="dealer_change_method" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                </div>


                                <div v-else-if="index === 10">
                                    <v-list-item-title @click="username_change = true" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                </div>

                                <div v-else-if="index === 11">
                                    <v-list-item-title @click="applyForIDCartNow" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                </div>
                                <div v-else-if="index === 12">
                                    <v-list-item-title @click="copyTestingCode" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                </div>


                                <div v-else >
                                    <v-list-item-title><router-link style=" cursor: pointer !important; color: #ffffff; text-decoration: none;" :to="item.url"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</router-link></v-list-item-title>
                                </div>
                            </v-list-item>

                            <v-list-item style="box-shadow: 2px 2px 3px #ffffff;">
                                <v-list-item-title style=" cursor: pointer !important; color: #ffffff; text-decoration: none;" @click="dialog = true"><v-icon style="color: #ffffff;"> mdi-shield-account</v-icon> Apply Premium User</v-list-item-title>

                            </v-list-item>


                            <v-list-item >
                                <router-link to="/logout" style="color: #ffffff; text-decoration: none;">
                                    <v-icon style="color: #ffffff;">mdi-logout</v-icon> Logout
                                </router-link>
                            </v-list-item>
                        </v-list>

                        <input type="hidden" id="testing-code" :value="testingCode">

                    </v-menu>
                        <v-menu
                                v-else-if="showNavbar"
                                left
                                bottom
                                content-class="profile_section_header"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <p
                                        color="primary"
                                        v-bind="attrs"
                                        v-on="on"
                                        text
                                        style="font-size: 17px !important; color: #fff !important;margin-right: 27px;height: 23px;"
                                >
                                    Profile
                                </p>
                            </template>
                            <v-list style="background: #018EA9">
                                <v-list-item>
                                    <v-list-item-title style="text-align: center"><v-avatar
                                            color="orange"
                                            size="62"
                                    >
                                        <img v-if="authInfo.profile_pic" :src="imageUrl(authInfo)" alt="">
                                        <img v-else src="css/frontend/img/logo.png" alt="">
                                    </v-avatar></v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title style="color: #ffffff;"><span>{{authInfo.name}}</span></v-list-item-title>

                                </v-list-item>
                                <v-list-item v-if="authInfo.referral_id">
                                    <v-list-item-title  style="color: #ffffff;"><span>{{authInfo.referral_id}}</span> <span aria-label="verified" data-balloon-pos="right"><v-icon style="color: rgb(7 245 135);">mdi-check-circle</v-icon></span></v-list-item-title>

                                </v-list-item>
                                <v-list-item
                                        style="box-shadow: 2px 2px 3px #ffffff;"
                                        v-for="(item, index) in items"
                                        :key="item.title"
                                >
                                    <div v-if="index === 1">
                                        <v-list-item-title><router-link :to="item.url" target="_blank" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;" ><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</router-link></v-list-item-title>

                                    </div>

                                    <div v-else-if="index === 7">
                                        <v-list-item-title @click="dealer_change_method" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                    </div>


                                    <div v-else-if="index === 10">
                                        <v-list-item-title @click="username_change = true" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                    </div>

                                    <div v-else-if="index === 11">
                                        <v-list-item-title @click="applyForIDCartNow" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                    </div>
                                    <div v-else-if="index === 12">
                                        <v-list-item-title @click="copyTestingCode" style=" cursor: pointer !important; color: #ffffff; text-decoration: none;"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                    </div>


                                    <div v-else >
                                        <v-list-item-title><router-link style=" cursor: pointer !important; color: #ffffff; text-decoration: none;" :to="item.url"><v-icon style="color: #ffffff;">{{item.icon}}</v-icon> {{ item.title }}</router-link></v-list-item-title>
                                    </div>
                                </v-list-item>

                                <v-list-item style="box-shadow: 2px 2px 3px #ffffff;">
                                    <v-list-item-title style=" cursor: pointer !important; color: #ffffff; text-decoration: none;" @click="dialog = true"><v-icon style="color: #ffffff;"> mdi-shield-account</v-icon> Apply Premium User</v-list-item-title>

                                </v-list-item>


                                <v-list-item >
                                    <router-link to="/logout" style="color: #ffffff; text-decoration: none;">
                                        <v-icon style="color: #ffffff;">mdi-logout</v-icon> Logout
                                    </router-link>
                                </v-list-item>
                            </v-list>

                            <input type="hidden" id="testing-code" :value="testingCode">

                        </v-menu>
                    </li>
                </ul>
            </div>
        </div>



        <div class="text-center">
            <v-dialog
                    v-model="username_change"
                    width="500"
            >
                <v-card>
                    <v-card-title  class="text-h5 grey lighten-2" style="background-color: teal; color: #fff">
                        Username Change
                    </v-card-title>
                    <v-form @submit.prevent="applyChangeUserName" method="post">

                        <v-card-text>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Enter User Name"
                                        placeholder="Enter User Name"
                                        solo
                                        v-model="change.username"
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
                                    @click="username_change = false"
                            >
                                Confirm
                            </v-btn>
                        </v-card-actions>

                    </v-form>
                </v-card>
            </v-dialog>
        </div>







        <div class="text-center">
            <v-dialog
                    v-model="dialog"
                    width="500"
            >
                <v-card>
                    <v-card-title  class="text-h5 grey lighten-2" style="background-color: teal; color: #fff">
                        Apply for Premium User
                    </v-card-title>
                    <v-form @submit.prevent="applyPremiumUser" method="post">

                        <v-card-text>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Referral Account NO (Optional)"
                                        placeholder="Referral Account NO (Optional)"
                                        solo
                                        v-model="form.account"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Pin Code"
                                        placeholder="Pin Code"
                                        solo
                                        v-model="form.pincode"
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
                                    @click="dialog = false"
                            >
                                Confirm
                            </v-btn>
                        </v-card-actions>

                    </v-form>
                </v-card>
            </v-dialog>
        </div>



        <div class="text-center">
            <v-dialog
                    v-model="dealer_change"
                    width="500"
            >
                <v-card>
                    <v-card-title  class="text-h5 grey lighten-2" style="background-color: teal; color: #fff">
                        Dealer Change
                    </v-card-title>
                    <v-form @submit.prevent="changeDealerOwn" method="post">

                        <v-card-text>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-autocomplete
                                        v-model="dealer.user"
                                        :items="allDealer"
                                        dense
                                        label="Choose Dealer"
                                        :item-text = 'getFieldText'
                                        item-value="dealer_referral_id"
                                        solo
                                ></v-autocomplete>
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
                                    @click="dealer_change = false"
                            >
                                Confirm
                            </v-btn>
                        </v-card-actions>

                    </v-form>
                </v-card>
            </v-dialog>
        </div>



        <div class="text-center">
            <v-dialog
                    v-model="applyIdCart"
                    width="500"
            >
                <v-card>
                    <v-card-title  class="text-h5 grey lighten-2" style="background-color: teal; color: #fff">
                        Apply For Id Card
                    </v-card-title>
                    <v-form @submit.prevent="applyIdCarts" method="post" enctype="multipart/form-data" >

                        <v-card-text>

                            <v-col
                                    class="d-flex"
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >

                                <v-select
                                        class="applie-id-cart-class-now"
                                        :items="bloods"
                                        label="Enter Your Blood"
                                        item-text="name"
                                        item-value="name"
                                        v-model="idCard.blood"
                                        solo
                                ></v-select>

                            </v-col>

                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Enter Your Name"
                                        placeholder="Enter Your Name"
                                        class="applie-id-cart-class-now"
                                        solo
                                        v-model="idCard.name"
                                ></v-text-field>
                            </v-col>


                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Enter Your Email Address"
                                        placeholder="Enter Your Email Address"
                                        class="applie-id-cart-class-now"
                                        solo
                                        v-model="idCard.email"
                                ></v-text-field>
                            </v-col>




                            <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Enter Your Phone"
                                        class="applie-id-cart-class-now"
                                        placeholder="Enter Your Phone"
                                        solo
                                        v-model="idCard.phone"
                                ></v-text-field>
                            </v-col>




                            <v-col cols="12">
                                <div class='file-input'>
                                    <input type='file' @change="onFileChange"  required  >
                                    <span class='label' style="font-weight: 400" >Upload Photo</span>
                                    <span class='button'></span>
                                </div>
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

                            >
                                Confirm
                            </v-btn>
                        </v-card-actions>

                    </v-form>
                </v-card>
            </v-dialog>
        </div>



        <section>
            <template>

                <v-row justify="center">

                    <v-dialog v-model="dealerChecks" persistent max-width="400px">
                        <v-card>
                            <v-form  @submit.prevent="applyForDealer" method="post" enctype="multipart/form-data" >
                                <v-card-title  class="text-h5 grey lighten-2" style="background-color: teal; color: #fff">
                                    Apply For Dealer
                                </v-card-title>
                                <v-card-text>
                                    <template v-slot:activator="{ on, attrs }">

                                    </template>

                                    <div class="selectinput">
                                        <div class="main">

                                            <v-layout row wrap>
                                                <v-flex class="form">

                                                    <v-col class="d-flex dealer-apply-now" cols="12" sm="12">
                                                        <v-select
                                                                label="Select Zone"
                                                                :items="zone"
                                                                solo
                                                                dense
                                                                item-text="name"
                                                                item-value="id"
                                                                v-model="selectZone"
                                                        ></v-select>
                                                    </v-col>

                                                    <v-col class="d-flex select dealer-apply-now" cols="12" sm="12">
                                                        <v-select
                                                                label="Select District"
                                                                :items="district"
                                                                solo
                                                                dense
                                                                item-text="name"
                                                                item-value="id"
                                                                v-model="selectDistrict"
                                                        ></v-select>
                                                    </v-col>

                                                    <v-col class="d-flex select dealer-apply-now" cols="12" sm="12">
                                                        <v-select
                                                                label="Select Thana"
                                                                :items="thana"
                                                                solo
                                                                dense
                                                                item-text="name"
                                                                item-value="id"
                                                                v-model="thanas"
                                                        ></v-select>
                                                    </v-col>

                                                    <v-col class="d-flex select dealer-apply-now" cols="12" sm="12">
                                                        <v-select
                                                                label="Select Village"
                                                                :items="villages"
                                                                solo
                                                                dense
                                                                item-text="name"
                                                                item-value="id"
                                                                v-model="village"
                                                        ></v-select>
                                                        <!--<v-text-field-->
                                                        <!--label="Enter Village"-->
                                                        <!--single-line-->
                                                        <!--solo-->
                                                        <!--type="text"-->
                                                        <!--v-model="village"-->
                                                        <!--&gt;</v-text-field>-->
                                                    </v-col>

                                                    <v-col class="d-flex select dealer-apply-now" cols="12" sm="12">
                                                        <div class='file-input'>
                                                            <input type='file' @change="onFileChange1" >
                                                            <span class='label' style="font-weight: 400" >Upload Your Photo</span>
                                                        </div>
                                                    </v-col>
                                                    <v-col class="d-flex select dealer-apply-now" cols="12" sm="12">
                                                        <div class='file-input'>
                                                            <input type='file' @change="onFileChange2" >
                                                            <span class='label' style="font-weight: 400" >Upload NID Front Pic</span>
                                                        </div>
                                                    </v-col>
                                                    <v-col class="d-flex select dealer-apply-now" cols="12" sm="12">
                                                        <div class='file-input'>
                                                            <input type='file' @change="onFileChange3" >
                                                            <span class='label' style="font-weight: 400" >Upload NID Back Side Pic</span>

                                                        </div>
                                                    </v-col>
                                                    <v-col class="d-flex select dealer-apply-now" cols="12" sm="12">
                                                        <div class='file-input'>
                                                            <input type='file' @change="onFileChange4" >
                                                            <span class='label' style="font-weight: 400" >Upload Latest Education Certificate Pic</span>
                                                        </div>
                                                    </v-col>
                                                </v-flex>
                                            </v-layout>

                                        </div>
                                    </div>
                                    <v-card-actions>

                                        <v-btn color="blue darken-1" text @click="dealerChecks = false">
                                            Close
                                        </v-btn>
                                        <v-spacer></v-spacer>
                                        <v-btn color="blue darken-1" type="submit" text @click="dealerChecks = false">
                                            Submit
                                        </v-btn>
                                    </v-card-actions>
                                </v-card-text>

                            </v-form>

                        </v-card>



                    </v-dialog>
                </v-row>
            </template>
            <div></div>
        </section>



    </section>
</template>



<script>

    import PopupLogin from './Auth/Login';
    import  mdiAccount  from '@mdi/js'
    export default {
        name: "TheHeaderApp",

        components:{
            PopupLogin
        },
        data(){
            return{
                showNavIcon:false,
                firstNavbarActive:false,

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

                dealerChecks:false,
                dealer: User.dealer(),
                bloods:[
                    {name: 'O+'},
                    {name: 'O-'},
                    {name: 'A+'},
                    {name: 'A-'},
                    {name: 'B+'},
                    {name: 'B-'},
                    {name: 'AB+'},
                    {name: 'AB-'},
                    {name: 'Unknown'},
                ],

                authInfo:'',
                idCard:{
                    name: User.user() ? User.user() : '',
                    email: User.email() ? User.email() : '',
                    phone: User.phone() ? User.phone() : '',
                    blood: User.blood() ? User.blood() : ''
                },

                media:null,
                applyIdCart:false,
                testingCode: null,
                dialog:false,
                dealer:{
                    user:null
                },
                username_change:false,
                dealer_change:false,
                mini: false,
                menu: false,
                searchClosed: true,
                logoClose: false,
                search: null,
                drawer: false,
                tab: null,
                inwidth: null,
                x: null,
                MobileNav: null,
                showNavbar:null,
                isAuth: User.loggedIn(),
                form:{
                    pincode:null,
                    account:null,
                    user_id: User.id()
                },
                change:{
                    username:null
                },

                items: [
                    {title: 'My Profile', url:'/bvon-social-main-profile', icon:'mdi-face-man-profile'},
                    {title: 'Account', url:'/dealer/account', icon:'mdi-account'},
                    {title: 'E-wallet', url:'/bvon-wallet', icon:'mdi-wallet'},
                    {title: 'Shopping Wallet', url:'/bvon-shopping-wallet', icon:'mdi-wallet-travel'},
                    {title: 'Merchant Wallet', url:'/bvon-merchant-wallet', icon:'mdi-wallet-membership'},
                    {title: 'Order Details', url:'/user-order-list', icon:'mdi-border-all'},
                    {title: 'Page Post', url:'#', icon:'mdi-post'},
                    {title: 'Dealer Change', url:'#', icon:'mdi-swap-horizontal'},
                    {title: 'Dealers', url:'#', icon:'mdi-handshake'},
                    {title: 'Employees Arena', url:'#', icon:'mdi-account-group'},
                    {title: 'Change Username', url:'#', icon:'mdi-account-switch'},
                    {title: 'Apply for ID Card', url:'#', icon:'mdi-card-account-details-outline'},
                    {title: 'Referral Url copy ', url:'#', icon:'mdi-copyright'},
                ],
                icons: {
                    mdiAccount
                },

                showmenumain:false,
                navigations:{},

                allDealer:'',
                findroute:'/',
                zone:[],
                district:[],
                thana:[],
                thanas:'',
                selectZone:'',
                selectDistrict:'',
                media1:null,
                media2:null,
                media3:null,
                media4:null,
                village:null,
                villages:[]
            }
        },

        watch:{
            selectZone : function(value){
                axios.get('/api/dealer-district?zone_id='+this.selectZone)
                    .then(res =>{
                        this.district = res.data.data;
                    });
            },

            selectDistrict : function(value){
                axios.get('/api/dealer-thana?district_id='+this.selectDistrict)
                    .then(res =>{
                        this.thana = res.data.data;
                    });
            },

            thanas : function (value) {
                axios.get('/api/dealer-village?thana_id='+this.selectDistrict)
                    .then(res =>{
                        // console.log(res.data);
                        this.villages = res.data;
                    });
            }
        },

        methods: {

            comingServiceSho(value){
                if(value != ''){
                    this.$alert("This Service Comming Soon......");
                }
                return false;
            },
            activeNavBarNow(){
                this.showNavIcon = !this.showNavIcon;
            },
            firstNavbarActiveNow(){
                this.firstNavbarActive = !this.firstNavbarActive;
            },
            onFileChange1(e){
                // console.log(e);
                this.media1 = e.target.files[0];
            },

            onFileChange2(e){
                this.media2 = e.target.files[0];
            },

            onFileChange3(e){
                this.media3 = e.target.files[0];
            },

            onFileChange4(e){
                this.media4 = e.target.files[0];
            },


            applyForDealer(){

                const formData = new FormData;
                formData.set('zone', this.selectZone);
                formData.set('district', this.selectDistrict);
                formData.set('thana', this.thanas);
                formData.set('village', this.village);
                formData.set('media1', this.media1);
                formData.set('media2', this.media2);
                formData.set('media3', this.media3);
                formData.set('media4', this.media4);


                axios.post('/api/bvon-dealer-apply', formData)
                    .then(res => {


                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });

                            window.location='/';

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    })
                    .catch(error => console.log(error.response.data));
            },


            showCartBtn(){
                EventBus.$emit('showCartBtnIfCart');
            },

            onFileChange(e){
                this.media = e.target.files[0];
            },
            applyIdCarts(){
                const formData = new FormData;
                formData.set('name', this.idCard.name);
                formData.set('phone', this.idCard.phone);
                formData.set('email', this.idCard.email);
                formData.set('blood', this.idCard.blood);
                formData.set('media', this.media);
                if(this.media != null || this.blood != null || this.email != null){
                    axios.post('/api/apply-for-id-card', formData)
                        .then(res => {

                            if(res.data.type === 'success') {
                                this.$store.dispatch('addNotification', {
                                    type: 'success',
                                    message: res.data.message
                                });
                                this.applyIdCart = false;

                            }else{
                                this.$store.dispatch('addNotification', {
                                    type: 'error',
                                    message: res.data.message
                                });
                            }

                        })
                        .catch(error => console.log(error.response.data));
                }else{
                    this.$store.dispatch('addNotification', {
                        type: 'error',
                        message: 'Image and email and blood is Required'
                    });
                }


            },
            applyForIDCartNow(){
                this.applyIdCart = true;
            },
            loginBvonDoctor(){
                this.$alert("Please Login Fast");
            },

            bvonDealerAuthCheck(){
                this.$alert("Please Login Fast");
            },



            copyTestingCode () {
                let testingCodeToCopy = document.querySelector('#testing-code');
                testingCodeToCopy.setAttribute('type', 'text');    // 不是 hidden 才能複製
                testingCodeToCopy.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    // alert('Testing code was copied ' + msg);
                } catch (err) {
                    // alert('Oops, unable to copy');
                }

                /* unselect the range */
                testingCodeToCopy.setAttribute('type', 'hidden');
                window.getSelection().removeAllRanges()
            },
            getFieldText (item)
            {
                return `${item.name} - ${item.dealer_referral_id}`
            },

            dealer_change_method(){
                this.dealer_change = true;
                axios.get('/api/get-all-dealer-fetch')
                    .then(res => {
                        this.allDealer = res.data;
                    })
                    .catch(error => console.log(error.response.data));
            },
            handle() {
                this.inwidth = window.innerWidth >= 990;
                this.showNavbar = window.innerWidth <= 990;

            },

            getNavigationData(){
                axios.get('/api/navigation')
                    .then(res => this.navigations = res.data.data)
                    .catch(error => console.log(error.response.data));
            },
            imageUrl(authInfo){
                return 'media/user/profile_pic/'+authInfo.id+'/'+authInfo.profile_pic;
            },
            changeDealerOwn(){
                axios.post('/api/change-dealer-own-if-need', this.dealer)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            EventBus.$emit('withdrawRequest')

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    }).catch(error => console.log(error.response.data))
            },

            applyPremiumUser(){
                axios.post('/api/apply-for-premium-user', this.form)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            EventBus.$emit('withdrawRequest')

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    }).catch(error => console.log(error.response.data))
            },

            applyChangeUserName(){
                axios.post('/api/apply-for-username-change', this.change)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            EventBus.$emit('withdrawRequest')

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    }).catch(error => console.log(error.response.data));
            },

            bvonDealerForm(){
                this.dealerChecks = true;

            },


            // bvonRouteCheck(id){
            //     if(id ==='/bvon-shop'){
            //         this.findroute = '/bvon-shop';
            //         // console.log('ok')
            //     }
            //     else{
            //         this.findroute = '/';
            //         // console.log('now');
            //     }
            // }





        },
        created() {
            axios.get('/api/dealer-zone-area')
                .then(res => {
                    this.zone = res.data;
                })
                .catch(error => console.log(error.response.data));



            // EventBus.$on('showDealerOrNot', () =>{
            //     this.bvonRouteCheck('ds');
            //     // console.log('newok');
            // });
            //

            this.handle();
            EventBus.$on('logout', () => {
                User.logOut();
            });

            axios.get(`/api/get-user-info/${User.id()}`)
                .then(res => {
                    this.authInfo = res.data;
                    // console.log(this.authInfo);
                    this.testingCode = 'https://bvon.app/referral-codes/'+ res.data.referral_id;

                })
                .catch(error => console.log( this.testingCode));
        },


        mounted() {
            // console.log(this.isAuth);
            // console.log(this.testingCode);

            setTimeout(() => { this.getNavigationData(); }, 1000);
        },



        computed:{
            // currentRoute(){
            //   return this.bvonRouteCheck();
            // },
            cartItemCount(){
                return this.$store.getters.cartItemCount;
            },

            dealerCartItemCount(){
                return this.$store.getters.dealerCartItemCount;
            },

            user_type(){
                return User.user_type();
            },

        }

    }
</script>
<style lang="scss" scoped>
.header-wrapper{
    z-index: 100;
}


.main-header{
    width: 100%;
    padding: 5px 0;
    height: 75px;
}

.main-header .header-left{
    width: 20%;
    float: left;
}

.main-header .header-right{
    width: 80%;
    float: right;
    margin-top: 18px;
    .first-navbar-mobile-view{
        list-style: none;
        margin-top: 52px;
        margin-left: -100px;
        background: #018EA9;
        position: absolute;
        z-index: 1;
        display: none;
        li{
            width: 200px;
            padding: 10px;
            a{
                text-decoration: none;
                color: #fff;
                font-size: 15px;

                span{
                    padding: 7px;
                    border: 1px solid #ffffff;
                    border-radius: 50%;
                    .service-icon{
                        color: #fff;
                        font-size: 18px;
                    }
                }
            }
        }
    }
}
.main-header .header-right .right-header-single{
    width: 33%;
    float: left;
    margin-top: 10px;

    .right-left-ul{
        list-style: none;
        li{
            float: left;
            width: 15%;

            &:last-child{
                width: 85%;
            }
            .right-header-icon{
                padding: 10px;
                border-radius: 50%;
                border: 1px solid #0C9A9A;
            }
        }

    }

}


.main-header .header-right .right-header-singles{
    width: 33%;
    float: left;
    margin-top: -6px;
    a{
        text-decoration: none;
        color: #000;
        ul{
            list-style: none;
            li{
                float: left;
                width: 15%;

                &:last-child{
                    width: 85%;
                }
                .right-header-icon{
                    padding: 10px;
                    border-radius: 50%;
                    border: 1px solid #0C9A9A;
                }
            }
        }
    }
}

.main-header .header-right .main-header-right-icon{
    padding: 10px;
    border-radius: 50%;
    border: 1px solid #63BDBE;
    right: 7px;
    top: 16px;
    float: revert;
    position: absolute;
    .top-right-icon{
        font-size: 25px;

    }

}






.second-header{
    width: 100%;
    background: #018EA9;
    padding: 3px;
    position: relative;
    height: 50px;

    .left-second-header{
        width: 70%;
        float: left;
        ul{
            list-style: none;
            z-index: 1;
            li{
                width: 12%;
                float: left;
                position: relative;
               padding: 10px 0;
                padding-left: 5px;
                a{
                    text-decoration: none;
                    color: #fff;
                    font-size: 15px;
                }

                ul{

                    list-style: none;
                    width: 200px !important;
                    background: #018EA9;
                    position: absolute;
                    margin-left: -3px;
                    display: none;
                    margin-top: 33px;
                    li{
                        float: none;
                        width: 200px !important;
                        padding: 10px;
                        background: #018EA9;
                        box-shadow: 0 0 5px #ddd;
                    }
                    span{
                        padding: 7px;
                        border: 1px solid #ffffff;
                        border-radius: 50%;
                        .service-icon{
                            color: #fff;
                            font-size: 18px;
                        }
                    }
                }

                &:hover ul{
                    display: block;
                }
            }
        }
    }

    .right-second-header{
        width: 30%;
        float: left;
        padding-top: 5px;
        ul{
            list-style: none;
            li{
                width: 20%;
                float: right;
                right: 0;
                text-align: right;
                margin-top: 3px;
                cursor: pointer;
                a{
                    text-decoration: none;
                    color: #fff;
                    font-size: 15px;
                    padding-right: 6px;
                    font-weight: 600;

                }
            }
        }
    }

}


@media only screen and (max-width: 600px) {
    .header-left{
        width: 80% !important;
        img{
            margin-left: 10px !important;
        }
    }
    .header-right{
        width: 20% !important;
    }
    .right-second-header{
        ul{
            li{
                padding-right: 67px;
            }
        }
    }

    .left-second-header{
        position: relative !important;
        span{
            .font-icon-second-header{
                margin: 10px;
                font-size: 20px;
                color: white;
            }
        }


        ul{
            background:#018EA9;
            margin-left: -3px;
            padding-left: 5px;
            display: none;
            li{
                float: none !important;
                width: 200px !important;
            }
        }

    }
}

.second-navar-active{
    display: block !important;
    position: absolute;
    li{
        box-shadow: 0 2px 0 0 #f0f6ff;
    }
}

.first-navar-active{
    display: block !important;
}

</style>

<style lang="sass" scoped>
.profile_section_header
    margin-top: 109px !important
    margin-left: 70px !important

.profile_section_header_nav
    margin-top: 35px !important
    margin-left: 30px !important
</style>

<!--class="d-none d-sm-flex"-->