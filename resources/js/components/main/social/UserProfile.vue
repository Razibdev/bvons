<template>
    <section style="overflow: hidden; margin-left: -4px;">
        <v-layout>
            <v-flex xs12 md12>
                <v-card color="basil">

                    <v-tabs
                            v-model="tab"
                            background-color="transparent"
                            color="basil"
                            grow
                    >
                        <v-tab href="#tab-1">
                            POSTS &nbsp;
                            <v-icon>mdi-note-plus</v-icon>
                        </v-tab>

                        <v-tab href="#tab-2">
                            ABOUT &nbsp;
                            <v-icon>mdi-information</v-icon>
                        </v-tab>

                        <v-tab href="#tab-3">
                            FOLLOWER &nbsp;
                            <v-icon>mdi-account-multiple-plus</v-icon>
                        </v-tab>

                        <v-tab href="#tab-4">
                            FOLLOWING &nbsp;
                            <v-icon>mdi-account-multiple-outline</v-icon>
                        </v-tab>
                    </v-tabs>

                    <v-tabs-items v-model="tab">



                        <v-tab-item

                                :value="'tab-' + 1"
                        >
                            <v-card flat>
                                <v-divider></v-divider>
                                <user-post></user-post>
                            </v-card>
                        </v-tab-item>



                        <v-tab-item

                                :value="'tab-' + 2"
                        >
                            <v-card flat>
                                <v-divider></v-divider>
                                <user-about></user-about>
                            </v-card>
                        </v-tab-item>

                        <v-tab-item

                                :value="'tab-' + 3"
                        >
                            <v-card flat>
                                <v-card-text>{{ text }}</v-card-text>
                            </v-card>
                        </v-tab-item>

                        <v-tab-item

                                :value="'tab-' + 4"
                        >
                            <v-card flat>
                                <v-card-text>{{ text }}</v-card-text>
                            </v-card>
                        </v-tab-item>



                    </v-tabs-items>
                </v-card>
            </v-flex>
        </v-layout>
    </section>


</template>

<script>

import UserPost from './UserPost';
import UserAbout from './About';
    export default {
        name: "UserProfile.vue",
        data(){
            return{
                tab: null,
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',

            }
        },
        components:{
            UserPost,
            UserAbout
        },
        created() {

        }

    }
</script>



<style>
    /* Helper classes */
    .basil {
        background-color: #FFFBE6 !important;
    }
    .basil--text {
        color: #356859 !important;
    }
</style>

<style scoped>

</style>
