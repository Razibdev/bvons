<template>
    <div>
        <v-app id="inspire">
            <div>
                <v-layout row wrap >
                    <v-flex sm12 md12 xs12 >
                        <v-app-bar style="background-color: #4A148C !important;">
                            <v-toolbar-items style="position: absolute;right: 0; width: 100%">
                                <v-btn icon class="d-flex d-sm-none"  @click.stop="drawer = !drawer"><v-icon style="color: white !important;">mdi-reorder-horizontal</v-icon> </v-btn>
                            </v-toolbar-items>
                        </v-app-bar>
                    </v-flex>
                    <v-flex md2 >
                        <v-navigation-drawer
                                absolute
                                left
                                class="purple darken-4 px-3 py-3"
                                v-model="drawer"
                                :permanent="$vuetify.breakpoint.mdAndUp"
                                height="100vh"
                                style="!important; overflow: hidden"
                        >
                            <span style="float:right; color: #fff;" v-if="showNavbar" @click="drawer=false">Close</span>
                            <v-list dense class="pt-0">
                                <v-list-item
                                >
                                    <v-list-item-content style="padding-top: 40px;" >
                                        <v-expansion-panels class="span-panel-style-now">
                                            <v-expansion-panel
                                                v-if="User != 'DC' && User != 'GU'"
                                            >
                                                <v-expansion-panel-header
                                                >
                                                    Designation Salary
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link to="/dealer/account/salary">Salary</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link to="/dealer/account/salary-history">Salary History</router-link></v-list-item-title>

                                                </v-expansion-panel-content>
                                            </v-expansion-panel>


                                            <v-expansion-panel
                                                v-if="User === 'DC'"
                                            >
                                                <v-expansion-panel-header>
                                                   Doctor Section
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/bvon-doctor/section/new-prescription">Add New Prescription</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/bvon-doctor/section/view-prescription">View All Prescription</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/bvon-doctor/section/all-member-list">All Member List</router-link></v-list-item-title>

                                                </v-expansion-panel-content>
                                            </v-expansion-panel>



                                            <v-expansion-panel
                                                    v-if="User != 'DC' && User != 'GU'"
                                            >
                                                <v-expansion-panel-header>
                                                    Dealer Stock Section
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/stock/all-stock">All Stock</router-link></v-list-item-title>
                                                 </v-expansion-panel-content>
                                            </v-expansion-panel>




                                            <v-expansion-panel
                                                    v-if="User != 'DC' && User != 'GU'"
                                            >
                                                <v-expansion-panel-header>
                                                    Dealer Order Section
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/all-order">All Orders</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/pending-order">Pending Orders</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/processing-order">Processing Orders</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/shipped-order">Shipping Orders</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/complete-order">Complete Orders</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/cancel-order">Canceled Orders</router-link></v-list-item-title>

                                                </v-expansion-panel-content>
                                            </v-expansion-panel>


                                            <v-expansion-panel
                                                    v-if="User != 'DC' && User != 'GU'"
                                            >
                                                <v-expansion-panel-header>
                                                    Dealer Employee
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/employee/employee-area-na">Employee AreaNa</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/employee/employee-downline">Employee Downline</router-link></v-list-item-title>

                                                </v-expansion-panel-content>

                                            </v-expansion-panel>

                                            <v-expansion-panel
                                                    v-if="value"
                                            >
                                                <v-expansion-panel-header>
                                                    Doctors Officer
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/bvon-doctor-officer-target-list">Target History</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/bvon-doctor-officer-signup-list/">SignUP History</router-link></v-list-item-title>
                                                </v-expansion-panel-content>
                                            </v-expansion-panel>


                                            <v-expansion-panel
                                            >
                                                <v-expansion-panel-header>
                                                    Quizze Exam
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/add-bvon-quizze-exam">Add Quizze Exam</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/view-bvon-quizze-exam">View Quizze Exam</router-link></v-list-item-title>
                                                </v-expansion-panel-content>
                                            </v-expansion-panel>



                                            <v-expansion-panel
                                            >
                                                <v-expansion-panel-header>
                                                    General Quizze Question
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/add-bvon-general-quizze-question">Add General Quizze Question</router-link></v-list-item-title>
                                                    <v-list-item-title style="padding: 5px;"><router-link class="route-link-color-need" to="/dealer/account/view-bvon-general-quizze-question">View General Quizze Question</router-link></v-list-item-title>
                                                </v-expansion-panel-content>
                                            </v-expansion-panel>




                                        </v-expansion-panels>



                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>

                        </v-navigation-drawer>
                    </v-flex>
                    <v-flex md10 >


                        <!--<p-->
                                <!--class="title grey&#45;&#45;text font-weight-light text-xs-center py-5"-->
                                <!--style="background-color: antiquewhite"-->
                        <!--&gt;Content</p>-->

                        <div>
                            <router-view></router-view>

                        </div>
                    </v-flex>
                </v-layout>
            </div>

        </v-app>

    </div>
</template>

<script>
    export default {
        name: "SecondSidebar.vue",
        data () {
            return {
                drawer: null,
                value: 0,
                inwidth: null,
                showNavbar: window.innerWidth <= 990,

            }
        },
        created(){

        },
        methods:{
            handle() {
                this.inwidth = window.innerWidth >= 990;
                this.showNavbar = window.innerWidth <= 990;

            },
        },

        mounted(){
            User.Officer().then(res => {
                this.value = res;
                console.log(this.value);
            });
        },

        computed:{
            User(){
                return User.user_type();
            },
            officers(){
                return User.Officer();
            }
        },

    }
</script>

<style scoped >
    .span-panel-style-now{

    }
</style>