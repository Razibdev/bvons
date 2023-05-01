<template>
    <div style="height: 119px">
        <v-layout row wrap >
            <v-flex xs12 md12 style="margin-top: 12px;">
                <div>
                    <v-app-bar
                            dark
                            dense
                            class="first-navbar-ok-now-important"
                            style="z-index: 10"
                    >
                        <test :test="navigations"></test>

                        <ul class="dropdown_category d-none d-sm-flex" >
                            <li><a href="#"> <v-app-bar-nav-icon class="d-none d-sm-flex main-header-cart-icon" ></v-app-bar-nav-icon></a>
                                <ul style="margin-top: 12px">
                                    <li v-for="navigation in navigations" :key="navigation.id"><a href="#">{{navigation.category_name}}</a>
                                        <ul>
                                            <li v-for="subcategory in navigation.subcategory_id" :key="subcategory.id"><a href="">{{subcategory.sub_category_name}}</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <v-toolbar-title v-if="inwidth">
                            <router-link to="/">
                            <v-img
                                    lazy-src="frontend/image/logo.png"
                                    max-height="40"
                                    max-width="120"
                                    src="frontend/image/logo.png"
                                    class="full-image-width"
                            ></v-img>
                            </router-link>
                        </v-toolbar-title>
                        <v-toolbar-title style="z-index: -1" v-if="!inwidth" :class="{'logo' : !searchClosed }">
                            <router-link to="/">
                            <v-img
                                    lazy-src="frontend/image/logo.png"
                                    max-height="30"
                                    max-width="100"
                                    class="logoSmallMobile"
                                    src="frontend/image/logo.png"
                                    style="margin-left:10px;"
                            ></v-img>
                            </router-link>
                        </v-toolbar-title>



                        <v-spacer></v-spacer>

                        <v-text-field
                                width="800"
                                v-model="search"
                                color="#ddd"
                                @focus="searchClosed = false"
                                @blur="searchClosed = true"
                                label="Search"
                                filled
                                dense
                                solo
                                append-icon="mdi-magnify"
                                class="expanding-search mt-4"
                                :class="{ 'closed' : searchClosed && !search }"
                                clearable
                                style="z-index: -1; margin-top: 32px !important;"

                        ></v-text-field>&nbsp;&nbsp;


                        <v-icon

                                medium
                                color="#ddd darken-2"
                                style="z-index: -1"
                                @click="showCartBtn"



                        > mdi-cart-variant </v-icon><span>

                        <span class="main-header-cart-icon" v-if="findroute == '/bvon-shop'"  :class="{'main-cart-button' : inwidth }"><sup v-if="dealerCartItemCount">{{dealerCartItemCount}}</sup></span>
                        <span class="main-header-cart-icon" v-else  :class="{'main-cart-button' : inwidth }"><sup v-if="cartItemCount">{{cartItemCount}}</sup></span>
                    </span>



                        <v-menu
                                left
                                bottom
                                content-class="header-all-service-here"

                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                        icon
                                        v-bind="attrs"
                                        v-on="on"
                                        :class="{'button-hide-main' : inwidth }"
                                        style="z-index: 1"
                                >
                                    <v-icon  class="d-flex d-sm-none main-header-cart-icon">mdi-account-wrench</v-icon>
                                </v-btn>
                            </template>

                                <v-list style="margin-top: 40px;">
                                    <v-list-item
                                            style="box-shadow: 2px 2px 3px #888888;"
                                            v-for="(n, i) in service"
                                            :key="n.title"
                                            @click="() => {}"
                                            v-if=" n.type ==='' || n.type===0"
                                    >
                                        <div  v-if="i === 1">
                                            <div v-if="authInfo.doctor_service === n.type" >
                                                <div v-if="isAuth">
                                                    <v-list-item-title ><router-link  :to="n.url"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                </div>
                                                <div v-else>
                                                    <v-list-item-title @click="loginBvonDoctor"><router-link to="#" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                </div>
                                            </div>
                                            <div v-else>
                                                <div v-if="isAuth">
                                                    <v-list-item-title ><router-link  to="bvon-doctor-service-token"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                </div>
                                                <div v-else>
                                                    <v-list-item-title @click="loginBvonDoctor"><router-link to="#" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                </div>

                                            </div>

                                        </div>
                                        <div  v-else-if="i === 2">
                                            <div v-if="isAuth" >
                                                <v-list-item-title v-if="dealer" @click="bvonRouteCheck('/bvon-shop')"><router-link  :to="n.url"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>
                                                <v-list-item-title v-else  @click="bvonDealerForm()"><router-link  to="#"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>
                                            </div>
                                            <div v-else >
                                                <v-list-item-title  @click="bvonDealerAuthCheck"><router-link  to="#"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                            </div>
                                        </div>
                                        <div v-else>
                                            <v-list-item-title><router-link  :to="n.url"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                        </div>


                                    </v-list-item>
                                </v-list>

                        </v-menu>
                    </v-app-bar>

                    <v-app-bar
                            class="second-nav-bar"
                            dense
                            style="overflow:hidden;"
                    >
                        <v-card
                                class="d-flex flex-row mb-12 second-nav-list"
                        >



                            <v-card
                                    class="pa-5 second-nav-bar-list-item  d-none d-sm-flex"

                            >
                                <div>
                                <v-menu
                                        left
                                        bottom
                                        content-class="all-service-list"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <p
                                                v-bind="attrs "
                                                v-on="on"
                                                text
                                                style="z-index: 1"
                                        >
                                            All Services
                                        </p>
                                    </template>

                                    <v-list>
                                        <v-list-item
                                                style="box-shadow: 2px 2px 3px #888888;"
                                                v-for="(n, i) in service"
                                                :key="n.title"
                                                @click="() => {}"
                                                v-if=" n.type ==='' || n.type===0"
                                        >
                                            <div  v-if="i === 1">
                                                    <div v-if="authInfo.doctor_service === n.type" >
                                                        <div v-if="isAuth">
                                                            <v-list-item-title ><router-link  :to="n.url"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                        </div>
                                                        <div v-else>
                                                            <v-list-item-title @click="loginBvonDoctor"><router-link to="#" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div v-if="isAuth">
                                                            <v-list-item-title ><router-link  to="bvon-doctor-service-token"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                        </div>
                                                        <div v-else>
                                                            <v-list-item-title @click="loginBvonDoctor"><router-link to="#" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                        </div>

                                                    </div>

                                            </div>
                                            <div  v-else-if="i === 2">
                                                <div v-if="isAuth" >
                                                    <v-list-item-title v-if="dealer" @click="bvonRouteCheck('/bvon-shop')"><router-link  :to="n.url"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>
                                                    <v-list-item-title v-else  @click="bvonDealerForm()"><router-link  to="#"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>
                                                </div>
                                                <div v-else >
                                                    <v-list-item-title  @click="bvonDealerAuthCheck"><router-link  to="#"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                                </div>
                                            </div>


                                            <div v-else>
                                                <v-list-item-title><router-link  :to="n.url"  style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{n.icon}}</v-icon> &nbsp;{{n.title}}</router-link></v-list-item-title>

                                            </div>


                                        </v-list-item>
                                    </v-list>

                                </v-menu>
                                </div>
                            </v-card>


                            <v-card
                                    class="pa-5 second-nav-bar-list-item"
                                    text
                            >
                                Gift Card
                            </v-card>

                            <v-card
                                    text
                                    class="pa-5 second-nav-bar-list-item"
                            >
                                Campaigns
                            </v-card>


                        </v-card>

                        <v-spacer class="" ></v-spacer>



                        <v-card
                                class="mb-6 second-nav-list"
                                flat
                        >

                            <!--<v-card-->
                                    <!--class="pa-5 second-nav-bar-list-item-right"-->

                                    <!--flat-->
                                    <!--v-if="isAuth"-->


                            <!--&gt;-->
                                <v-menu
                                        left
                                        bottom
                                        content-class="profile_section_header"
                                        v-if="isAuth"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <p
                                                color="primary"
                                                v-bind="attrs"
                                                v-on="on"
                                                text
                                                style="font-size: 17px !important; color: #fff !important;margin-right: 27px; margin-top: 8px;"
                                        >
                                            Profile
                                        </p>
                                    </template>
                                    <v-list>
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
                                            <v-list-item-title style="color: #47AA48;"><span>{{authInfo.name}}</span></v-list-item-title>

                                        </v-list-item>
                                        <v-list-item v-if="authInfo.referral_id">
                                            <v-list-item-title ><span>{{authInfo.referral_id}}</span> <span aria-label="verified" data-balloon-pos="right"><v-icon style="color: #2196F3;">mdi-check-circle</v-icon></span></v-list-item-title>

                                        </v-list-item>
                                        <v-list-item
                                                style="box-shadow: 2px 2px 3px #888888;"
                                                v-for="(item, index) in items"
                                                :key="item.title"
                                        >
                                            <div v-if="index === 1">
                                                <v-list-item-title><router-link :to="item.url" target="_blank" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" ><v-icon style="color: #47AA48;">{{item.icon}}</v-icon> {{ item.title }}</router-link></v-list-item-title>

                                            </div>

                                            <div v-else-if="index === 7">
                                                <v-list-item-title @click="dealer_change_method" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;"><v-icon style="color: #47AA48;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                            </div>


                                            <div v-else-if="index === 10">
                                                <v-list-item-title @click="username_change = true" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;"><v-icon style="color: #47AA48;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                            </div>

                                            <div v-else-if="index === 11">
                                                <v-list-item-title @click="applyForIDCartNow" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;"><v-icon style="color: #47AA48;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                            </div>
                                            <div v-else-if="index === 12">
                                                <v-list-item-title @click="copyTestingCode" style=" cursor: pointer !important; color: #47AA48; text-decoration: none;"><v-icon style="color: #47AA48;">{{item.icon}}</v-icon> {{ item.title }}</v-list-item-title>

                                            </div>


                                            <div v-else >
                                                <v-list-item-title><router-link style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" :to="item.url"><v-icon style="color: #47AA48;">{{item.icon}}</v-icon> {{ item.title }}</router-link></v-list-item-title>
                                            </div>
                                        </v-list-item>

                                        <v-list-item style="box-shadow: 2px 2px 3px #888888;">
                                            <v-list-item-title style=" cursor: pointer !important; color: #47AA48; text-decoration: none;" @click="dialog = true"><v-icon style="color: #47AA48;"> mdi-shield-account</v-icon> Apply Premium User</v-list-item-title>

                                        </v-list-item>


                                        <v-list-item style="box-shadow: 2px 2px 3px #888888;">
                                            <router-link to="/logout" style="color: #47AA48; text-decoration: none;">
                                               <v-icon style="color: #47AA48;">mdi-logout</v-icon> Logout
                                            </router-link>
                                        </v-list-item>
                                    </v-list>

                                    <input type="hidden" id="testing-code" :value="testingCode">

                                </v-menu>
                            <!--</v-card>-->

                            <v-card
                                    style="cursor: pointer;"
                                    class="pa-5 second-nav-bar-list-item-right "
                                    v-if="!isAuth"
                            >
                                <popup-login ></popup-login>
                            </v-card>

                        </v-card>
                    </v-app-bar>
                </div>
            </v-flex>
        </v-layout>


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


    </div>



</template>

<script>


    import PopupLogin from './Auth/Login';
    import  mdiAccount  from '@mdi/js'
    import '.././Helpers/index'
    import Test from './test'
    export  default {
        data(){
            return{

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
                services:[
                    'Social Media', 'Bvon Shop', 'B-courier', 'Blood Bank', 'Ride Sharing', 'B-learning School', 'B-Food', 'B-Pay', 'B-Card Service', 'Live Tutor/ Tuition', 'All Types of Alert', 'Charity', 'B-Doctor', 'B-Quizzes', 'B-Puzzel', 'B-Games', 'Freelance Place', 'Career Finder', 'B-News Portal', 'B-Baazar', 'Reading adn Reviews', 'Earning Opportunities'
                ],
                service:[
                    {title: 'Social Media', url:'/bvon-social', icon: 'mdi-power-socket-au', type: ''},
                    {title: 'B-Doctor', url:'/bvon-doctor-service', icon: 'mdi-doctor', type: 0},
                    {title: 'Bvon Shop', url:'/bvon-shop',  icon: 'mdi-basket', type: ''},
                    {title: 'B-Courier', url:'#', icon: 'mdi-train-car', type: ''},
                    {title: 'Blood Bank', url:'#', icon:'mdi-blood-bag', type: ''},
                    {title: 'Ride Sharing', url:'#', icon: 'mdi-subway-variant', type: ''},
                    {title: 'B-learning School', url:'#', icon: 'mdi-school', type: ''},
                    {title: 'B-Food', url:'#', icon:'mdi-food', type: ''},
                    {title: 'B-Pay', url:'#', icon: 'mdi-contactless-payment', type: ''},
                    {title: 'B-Card Service', url:'#', icon:'mdi-account-wrench-outline', type: ''},
                    {title: 'Live Tutor/ Tuition', url:'#', icon: 'mdi-book-education', type: ''},
                    {title: 'All Types of Alert', url:'#', icon: 'mdi-alert', type: ''},
                    {title: 'Charity', url:'#', icon: 'mdi-contrast-box', type: ''},

                    {title: 'B-Quizze', url:'/bvon-general-quizze', icon: 'mdi-puzzle', type: ''},
                    {title: 'B-Games', url:'#', icon:'mdi-google-controller', type: ''},
                    {title: 'Freelance Place', url:'#', icon: 'mdi-head-snowflake-outline', type: ''},
                    {title: 'Career Finder', url:'#', icon: 'mdi-pyramid', type: ''},
                    {title: 'B-News Portal', url:'#', icon: 'mdi-newspaper-variant', type: ''},
                    {title: 'B-Baazar', url:'#', icon: 'mdi-crowd', type: ''},
                    {title: 'Reading adn Reviews', url:'#', icon: 'mdi-book-open-variant', type: ''},
                    {title: 'Earning Opportunities', url:'#', icon: 'mdi-chair-school', type: ''}
                ],
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

        components: {
            PopupLogin,
            Test
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
            bvonRouteCheck(id){
                if(id ==='/bvon-shop'){
                    this.findroute = '/bvon-shop';
                    // console.log('ok')
                }
                else{
                    this.findroute = '/';
                    // console.log('now');
                }
            }

        },
        created() {
            axios.get('/api/dealer-zone-area')
                .then(res => {
                    this.zone = res.data;
                })
                .catch(error => console.log(error.response.data));
            EventBus.$on('showDealerOrNot', () =>{
                this.bvonRouteCheck('ds');
            // console.log('newok');
            });
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

<!-- header categories menu -->
<style lang="scss" scope>
    .dealer-apply-now{
        padding: 5px !important;
    }

    .file-input {
        display: inline-block;
        text-align: left;
        background: #fff;
        padding: 12px;
        width: 100%;
        position: relative;
        border-radius: 3px;
        box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%);
    }

    .file-input > [type='file'] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 10;
        cursor: pointer;
    }

    .file-input > .button {
        display: inline-block;
        cursor: pointer;
        background: #eee;
        padding: 8px 16px;
        border-radius: 2px;
        margin-right: 8px;
    }

    /*.file-input:hover > .button {*/
    /*background: dodgerblue;*/
    /*color: white;*/
    /*}*/

    .file-input > .label {
        color: #333;
        white-space: nowrap;
        opacity: .8;
    }

    .file-input.-chosen > .label {
        opacity: 1;
    }




    /*.profile{*/
        /*margin-top: 79px;*/
    /*}*/
    .dropdown_category {
        padding: 0;
        list-style: none;
        width: 47px;
        background-color: #272727;
        height: 52px;
        margin-top: 8px;
    }

    .dropdown_category li {
         position: relative;
     }

    .dropdown_category li a {
        color: #ffffff;
        text-align: center;
        text-decoration: none;
        display: block;
        padding: 5px;
    }

    .dropdown_category li ul {
        position: absolute;
        top: 88%;
        margin: 0;
        padding: 0;
        list-style: none;
        display: none;
        line-height: normal;
        background-color: #333;
    }

    .dropdown_category li ul li a {
        text-align: left;
        color: #cccccc;
        font-size: 14px;
        padding: 10px;
        display: block;
        white-space: nowrap;
    }

    .dropdown_category li ul li a:hover {
        background-color: #0abf53;
        color: #ffffff;
    }

    .dropdown_category li ul li ul {
        left: 100%;
        top: 0;
    }

    ul li:hover>a {
        background-color: #272727;
        color: #ffffff !important;
    }

    ul li:hover>ul {
        display: block;
    }


</style>
<style lang="scss" scoped>

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }

.first-navbar-ok-now-important{
    height: 52px !important;
    left: auto !important;
    right: auto !important;
    position: fixed;
    width: 1185px;
    margin-left: 12px;

}


    #header-main{
        width: 100%;
    }


    #sub_menu{
        border:none
    }
    #small_app_bar{
        display: none;
    }
    .logoSmallMobile{
        /*margin-left: 50px !important;*/
    }
    .logo{
        display: none;
    }

    .search-btn:hover{
        background: transparent !important;

    }
    
    .icon-cursor{
        cursor: pointer;
    }

    .full-image-width{
        margin-left: 18px !important;
        padding-top: 10px !important;
    }

    .v-toolbar__content{
        height: 48px !important;
    }
    .button-hide-main{
        display: none;
    }

    .main-cart-button{
        padding-right: 15px;
    }

    .nav-title{
        color: #000 !important;
    }

    .second-nav-bar{
        top: 52px;
        height: 43px !important;
        background: #232F3E !important;
        position: relative;
        .v-toolbar__content{
            width: 100% !important;
        }
        .second-nav-list{
            overflow: hidden;
            height: 38px;
            padding:0;
            margin-top: -10px;
            background: #232F3E !important;

            .second-nav-bar-list-item{
                min-height: 35px;
                color:#fff !important;
                background: #232F3E !important;
                padding-top:5px;
                padding-left:8px;
                font-size: 17px;
                margin-left: 15px;
            }
            .mobile-show-all-shop{
                padding-left: 20px;
            }
            .second-nav-bar-list-item:first-child{
                padding-left: 20px;

            }
            .second-nav-bar-list-item-right{
                min-height: 35px;
                color:#ddd !important;
                background: #232F3E !important;
                padding-top:5px;
                padding-right: 8px;
            }

            .second-nav-bar-list-item-right:last-child{
                padding-right: 20px;
            }


            .second-nav-bar-list-item-right-r{
                padding-right: -8px;
            }
        }
    }



    .nav-wrapper {
        position: fixed;
        width: 300px;
        height: 100vh;
        transition: transform 0.3s;
        transform: translateX(-100%);
        margin-top: 600px;

        &.show-menu {
            transform: none;
        }
    }

    .js-nav-toggle {
        position: absolute;
        top: 0;
        right: -60px;
        width: 43px;
        height: 40px;
        margin: 15px 0 0 15px;
        display: block;
        float: left;
        padding: 0;
        color: #ddd;
        border: 2px solid #272727;
        z-index: 2;

        span {
            position: relative;
            background-color: #ffffff;
            height: 2px;
            display: block;
            width: 22px;
            margin: 17px auto 0;
            transition: all 0.4s;
            transition-delay: 0.3s;

            &:before,
            &:after {
                content: '';
                position: absolute;
                display: block;
                width: 20px;
                height: 0;
                left: 1px;
                top: 50%;
                margin-top: -7px;
                transition: all 0.3s 0.3s;
            }

            &:before {
                box-shadow: 0 14px 0 1px #ddd;
            }

            &:after {
                box-shadow: 0 0 0 1px #ddd;
            }

            .show-menu & {
                background-color: transparent;

                &:before {
                    transform: rotate(-45deg);
                }

                &:after {
                    transform: rotate(45deg);
                }

                &:before,
                &:after {
                    margin-top: 0;
                    box-shadow: 0 0 0 1px #ddd;
                }
            }
        }
    }

    nav {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        box-shadow: 0 0 5px 1px #ddd;
        background-color: #fafafa;
        margin-top: 5px;

        .nav-toggle {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 0.45em 0.6em;
            background-color: #456;
            color: #fff;
            cursor: pointer;
            transition: backgroun-color 0.2s;

            &:hover {
                background-color: #345;
            }

            &.back-visible {

                .nav-back {
                    opacity: 1;
                }

                .nav-title {
                    transform: translateX(40px);
                }
            }
        }

        .nav-title {
            position: absolute;
            left: 0;
            top: 0.8em;
            padding-left: 0.7em;
            transition: transform 0.3s;
        }

        .nav-back {
            display: inline-block;
            position: relative;
            width: 30px;
            height: 30px;
            vertical-align: middle;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.2s;

            &:before,
            &:after {
                content: '';
                position: absolute;
                top: 50%;
            }

            &:before {
                left: 50%;
                width: 9px;
                height: 9px;
                border: 2px solid currentcolor;
                border-right-color: transparent;
                border-bottom-color: transparent;
                transform: translate(-50%, -50%) rotateZ(-45deg);
            }

            &:after {
                left: 28%;
                width: 15px;
                height: 2px;
                background-color: currentcolor;
                margin-top: -1px;
            }
        }

        .nav-close {

        }

        a {
            display: block;
            position: relative;
            padding: 0.7em;
            border-bottom: 1px solid #eee;
            color: #999;
            text-decoration: none;
            transition: color 0.15s, background-color 0.15s;

            &:hover {
                color: #333;
                background-color: #efefef;
            }
        }

        ul {
            list-style: none;
            padding: 45px 0 0;
            transition: transform 0.3s;
            background-color: #fafafa;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;

            ul {
                display: none;
                left: 100%;
            }
        }

        li {

            &.has-dropdown {

                > a {
                    padding-right: 2.5em;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    overflow: hidden;

                    &:after {
                        content: '';
                        position: absolute;
                        top: 50%;
                        right: 1em;
                        width: 9px;
                        height: 9px;
                        border: 1px solid currentcolor;
                        border-left-color: transparent;
                        border-top-color: transparent;
                        transform: translateY(-90%) rotateZ(-45deg);
                        transition: transform 0.3s;
                        transform-origin: 100%;
                    }
                }
            }

            &.nav-dropdown-open {

                ul {
                    display: block;
                }
            }
        }
    }


.v-navigation-drawer{
        top: 60px !important;
        right:0px !important;
        transform: translateX(100%) !important;
    }




.theme--dark.v-icon{
    color: #fff!important;
    }


.v-navigation-drawer__content{
    display: none !important;
}



.theme--dark.v-icon[data-v-2ee14f0e]{
    color: #ddd !important;
}

    

    @media screen and (max-width: 968px){
        #large_app_bar{
            display:  none;
        }
        #small_app_bar{
            display: block;
        }
    }

</style>

<style lang="sass">

    .v-input.expanding-search
        background: transparent !important
        .v-input__slot
            cursor: pointer !important
            color: #000000 !important
            background: #ffffff !important
            &:before, &:after
             border-color: transparent !important


        &.closed
           max-width: 35px
           height: 70px

        .v-input__slot
          background: #fff !important
          color: #000
          .v-input__append-inner
           .v-input__icon.v-input__icon--append
             .notranslate
              color: #000 !important
              background: #fff
              margin-left: -20px
          .v-input__icon--clear
           .mdi-close
            color: black !important
            padding-right: 12px

        .v-text-field__slot
         .v-label.theme--dark
           display: none
         #input-7
           color: #000 !important

              



    .theme--light.v-icon
        color: #fff
    .v-input--is-focused
        border-color: transparent !important

    .theme--light.v-input input
      color: #000
   .v-sheet.theme--dark.v-toolbar.v-toolbar--extended.v-app-bar.v-app-bar--fixed
    height: 102px !important
    width: 100% !important
    margin: 5px auto !important
    &.mobile-nav-first
     height: 55px !important
    .v-toolbar__content
       height: 52px !important
       padding-top: 10px

    .v-toolbar__extension
       height: 50px !important

    .mdi-cart-variant
       color: #fff !important
    .mdi-account-circle
       color: #fff !important
    .v-input__control
       margin-top: 5px !important
    .mdi-menu
       color: #fff !important
.v-application--wrap
  min-height: 10vh !important
.v-menu__content--fixed
 position: absolute
.all-service-list
    margin-left: 108px !important
    margin-top: 36px !important

.profile_section_header
    margin-top: 36px !important
    margin-left: 15px !important
.applie-id-cart-class-now
    .v-input__control
     height: 40px !important

.header-all-service-here
    z-index: 1 !important

</style>


<style lang="scss" scoped>
    .main {
        width: 1000px;
        max-width: 100%;
        overflow: hidden;
    }

    .form {
        padding: 1rem;
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