<template>
    <div>
        <div class="social-main-wrapper" >
            <v-layout row wrap>
                <v-flex xs3 md3>
                    <v-avatar>
                        <img
                                :src="getImgUrl(user.user.id, user.user.profile_pic)"
                                alt="profile_image"
                        >
                    </v-avatar>
                </v-flex>

                <v-flex xs8 md8>
                    <div class="social-profile-title">
                        <h3 >{{user.user.name}} <span  v-if="user.user.verified ===1" class="social-profile-icon" title="Verified"> <v-icon class="social-profile-verify">mdi-check-circle</v-icon></span></h3>
                        <p class="social-profile-sub-title"><span v-if="user.action_page === 1">Action</span> <span v-if="user.action_page === 0 && user.premium_post ===1">Sponsored</span>  {{user.created_at}}</p>
                    </div>



                </v-flex>
                <v-flex xs1 md1>

                    <v-dialog
                            v-model="dialog[user.id]"
                            persistent
                            max-width="600"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                    color="primary"
                                    v-bind="attrs"
                                    v-on="on"
                                    icon
                                    @click="threeDotIconClick"
                            > <v-icon v-if="own === user.user.id"  class="social-profile-actions" style="color:#000">mdi-dots-vertical</v-icon></v-btn>
                        </template>

                        <v-card>
                            <v-form  @submit.prevent="postEditUser(user)" enctype="multipart/form-data" method="POST">
                                <v-toolbar
                                        color="primary"
                                        dark
                                        style="background-color: #0C9A9A; padding-left: 20px;"
                                >Edit user post </v-toolbar><span><v-icon @click="closeModalSocial(user.id)" style="float: right; color: #000; margin-top: -48px; right: 5px; cursor:pointer;">mdi-close</v-icon></span>
                                <v-card-text>
                                    <v-layout style="margin-top: 20px;">
                                        <v-flex xs12 md6 >
                                            <v-text-field
                                                    label="Solo"
                                                    single-line
                                                    solo
                                                    class="social-post-edit-title"
                                                    style="margin-right: 5px;"
                                                    v-model="body"
                                            ></v-text-field>
                                        </v-flex>

                                        <v-flex xs12 md6>
                                            <input type="file" @change="onFileChange" label="File input" >
                                        </v-flex>

                                    </v-layout>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn

                                            text
                                            style="background-color:red"
                                            @click="deletePost(user.id)"
                                    >Delete</v-btn>
                                    <v-spacer></v-spacer>

                                    <v-btn
                                            type="submit"
                                            @click="dialog[user.id] = false"
                                            style="background: teal; height: 40px;"
                                    >Update</v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-dialog>
                </v-flex>




                <v-flex xs12 md12>
                    <div class="social-content-section">
                        <div class="social-content-text">
                            <p class="descinline">{{user.body | shorttext(150)}}</p>
                            <p class="descempty">{{ user.body }}</p>
                            <a href="#" @click="toggle($event)" v-if="user.body.length > 150" style="text-decoration: none; padding: 3px; background: #ddd; border-radius: 5px;" >Read More</a>

                        </div>
                        <div class="social-content-social">
                            <!--<img src="frontend/img/post.jpg" alt="">-->
                            <image-zoom
                                    :regular="getPostImgUrl(user.user.id, user.id, user.media)"
                                    :zoom="getPostImgUrl(user.user.id, user.id, user.media)"
                                    :zoom-amount="3"
                                    img-class="img-fluid"
                                    hover-message
                                    alt="Sky">
                            </image-zoom>

                        </div>
                    </div>
                </v-flex>


                <v-flex xs4 md4>
                    <reactions :post="user"></reactions>
                </v-flex>

                <v-flex xs4 md4>
                    <!--<comment :percomment="user.id" :commentscount="user"></comment>-->
                    <test-comment :percomment="user.id" :commentscount="user" ></test-comment>
                </v-flex>
                <v-flex xs4 md4>
                    <div style="text-align: center;  margin-top: 6px;">
                        <v-icon class="social-action-section-icon social-action-section-icon-last" style="color: #000;">mdi-share-variant </v-icon>  <span>Share</span>
                    </div>
                </v-flex>
            </v-layout>
        </div>
    </div>
</template>

<script>
    import Reactions from './Reactions'
    import TestComment from'./TestComment';
    import imageZoom from 'vue-image-zoomer';
    import 'lazysizes'
    export default {
        props:['user'],


        data(){
            return {
                dialog: {},
                body:'',
                media:'',
                readMore: true

            }
        },
        components:{
            Reactions,
            imageZoom,
            TestComment
        },
        methods:{

            toggle(e){
                if(e.target.innerText == 'Read More'){
                    e.target.innerText = 'Read Less';
                    e.target.parentElement.children[0].className = '';
                    e.target.parentElement.children[0].className = 'descempty';
                    e.target.parentElement.children[1].className = '';
                    e.target.parentElement.children[1].className = 'descinline';

                }else{
                    e.target.innerText = 'Read More';
                    e.target.parentElement.children[0].className = 'descinline';
                    e.target.parentElement.children[1].className = 'descempty';
                }
            },


            onFileChange(e){
               this.media = e.target.files[0];
            },
            getImgUrl(id, image){
                return '/media/user/profile_pic/'+id+'/'+image;
            },

            getPostImgUrl(user_id,post_id, image){
                return '/media/post/'+user_id+'/'+post_id+'/'+image;
            },

            closeModalSocial(id){
                this.dialog[id] = false;
            },

            postEditUser(user){
                const formData = new FormData;
                formData.set('media',this.media);
                formData.set('body', this.body);
                this.$store.dispatch('postEditUser', {
                    id:user.id,
                   formData
                });
                EventBus.$emit('delete_post_fel');
            },

            threeDotIconClick(){
              this.body = this.user.body;
            },

            deletePost(id){
                this.$confirm("Are you sure? You want to delete the post?").then(() => {
                    this.$store.dispatch('deletePost', id);
                    this.dialog[id] = false;
                    EventBus.$emit('delete_post_fel');
                });
            }
        },

        created(){
            Echo.channel('PostChannel')
                .listen('PostEvent', (e) => {
                        EventBus.$emit('delete_post_fel');

                });


            Echo.channel('postDeleteChannel')
                .listen('PostDeleteEvent', (e) => {

                    EventBus.$emit('delete_post_fel');

                });
        },

        filters:{

          shorttext(value, limit){
              return value.substring(0, limit);
          }
        },

        computed:{
            own(){
                return User.id();
            },
        },
        mounted() {

        }


    }
</script>

<style scoped>
.descinline{
    display: inline;
}
.descempty{
    display: none;
}

</style>

<style lang="scss">

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
                padding: 0 23px;
                margin-bottom: 10px;
                p{
                    color: #111;
                    font-size: 16px;
                    padding: 10px 0;
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
