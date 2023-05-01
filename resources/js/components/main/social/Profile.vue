<template>
    <div style="margin-bottom: 200px; ">
        <v-card
                class="mx-auto"
                max-width="100%"
                tile
                style="height: 350px; margin-bottom: 10px; overflow:hidden;"
        >
            <v-img
                    height="100%"
                    src="https://cdn.vuetifyjs.com/images/cards/server-room.jpg"
                    style="height: 350px; margin-bottom: 10px; overflow:hidden;"
            >
                <v-row
                        align="end"
                        class="fill-height"
                >
                    <v-col
                            align-self="start"
                            class="pa-0"
                            cols="12"
                    >
                        <v-icon style="position: absolute; float: right; right: 10px; ">mdi-pencil-outline</v-icon>

                        <v-avatar
                                class="profile"
                                color="grey"
                                size="164"
                                tile
                        >
                            <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
                        </v-avatar>
                    </v-col>
                    <v-col class="py-0">
                        <v-list-item
                                color="rgba(0, 0, 0, .4)"
                                dark
                        >
                            <v-list-item-content>
                                <v-list-item-title class="text-h6">
                                    Marcus Obrien
                                </v-list-item-title>
                                <v-list-item-subtitle>Network Engineer</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>

                    </v-col>
                </v-row>



            </v-img>



        </v-card>

        <v-divider></v-divider>

        <user-profile></user-profile>


    </div>

</template>
<script>
    import UserProfile from './UserProfile'
    import Reactions from './Reactions'
    import Comment from './Comment'
    import imageZoom from 'vue-image-zoomer';
    import 'lazysizes'
    export default {
        name: "Profile.vue",
        data(){
            return {
                items: ['foo', 'bar', 'fizz', 'buzz'],
                values: ['foo', 'bar'],
                value: null,
            }
        },

        components:{
            Reactions,
            Comment,
            imageZoom,
            UserProfile
        }
    }
</script>

<style lang="scss" scoped>
    .social-main-wrapper{
        background-color: #F2F2F2;
        margin:60px 0;
        border-radius:  10px;
        .v-avatar{
            width: 82px !important;
            height: 82px !important;
            padding-left: 26px;

            img{
                width: 60px;
                height: 60px;
            }
        }

        .social-profile-title{
            padding-top: 15px;
            h3{
                font-size: 21px;

                .social-profile-verify{
                    color: green;
                }
            }
        }



        .social-profile-actions{
            color:#000;
            cursor: pointer;
            padding-top:26px;
        }

        .social-content-section{
            overflow: hidden;
            margin:20px 0;
            padding: 0 2px;
            .social-content-text{
                padding: 0 10px;
                p{
                    color: #111;
                    font-size: 16px;
                    padding: 0 15px;
                }
            }

            .social-content-social{
                overflow: hidden;
                padding: 0 25px;
                img{
                    width: 100%;
                }
            }
        }

        .social-action-section-icon-middle{
            text-align: center;
            span{
                cursor: pointer;
            }
        }


        .social-action-section-icon{
            color:#111;
            overflow: hidden;
            cursor: pointer;
            padding: 10px 3px;

        }


    }
</style>
<style lang="sass" scoped>
   .v-input__control
     min-height: 57px !important

.mdi-camera
  display: none !important
.mdi-paperclip
    color: #000 !important
.v-input__prepend-outer
    display: none !important
</style>