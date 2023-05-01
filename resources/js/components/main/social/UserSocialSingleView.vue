<template>
    <div>
        <div>
            <v-layout row wrap>
                <v-flex xs12 md6>
                    <v-form @submit.prevent="createNewPost" enctype="multipart/form-data" method="POST">
                        <v-layout>
                            <v-flex xs12 md4>
                                <v-text-field
                                        class="edit-post-input-field"
                                        label="Solo"
                                        single-line
                                        solo
                                        style="min-height: 57px; margin-left: 15px;"
                                        v-model="body"
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs12 md4>
                                <input type="file" @change="onFileChange" label="File input" >
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-btn type="submit" style="background: teal; height: 57px;" dark>Upload</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-flex>

                <v-flex xs12 md6 >
                    <v-layout>
                        <v-flex xs10 md10>
                            <v-autocomplete
                                    :items="allUserGet"
                                    dense
                                    filled
                                    item-value="id"
                                    item-text="name"
                                    label="Filled"
                                    style="margin-left: 15px;"
                                    @change="userSearchFilter()"
                                    v-model="userFilter"

                            ></v-autocomplete>
                        </v-flex>
                        <v-flex xs2 md2 style="text-align: right;">
                            <v-icon style="color: #000; margin-top: 6px; font-size: 40px; cursor: pointer; margin-right: 10px;">mdi-magnify</v-icon>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>

            <v-layout row wrap>

                <v-flex xs12 md6 v-for="post in AuthUserPosts" :key="post.id">
                    <div class="social-main-wrapper">
                        <v-layout row wrap>

                            <v-flex xs3 md3>
                                <v-avatar>
                                    <img
                                            :src="getImgUrl(post.user.id, post.user.profile_pic)"
                                            alt="John"
                                    >
                                </v-avatar>
                            </v-flex>

                            <v-flex xs8 md8>
                                <div class="social-profile-title">
                                    <h3>{{post.user.name}} <span><v-icon v-if="post.user.verified" class="social-profile-verify">mdi-check-circle</v-icon></span></h3>
                                    <p class="social-profile-sub-title"><span v-if="post.action_page === 1">Action</span> <span v-if="post.action_page === 0 && post.premium_post ===1">Sponsored</span> {{post.created_at}}</p>
                                </div>

                            </v-flex>
                            <v-flex xs1 md1>
                                <div class="text-center" v-if="post">
                                    <v-dialog
                                            v-model="dialog[post.id]"
                                            width="500"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn
                                                    color="primary"
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    icon
                                                    @click="openAuthUserModal(post.id, post.body)"
                                            >
                                                <v-icon class="social-profile-actions" >mdi-dots-vertical</v-icon>
                                            </v-btn>

                                        </template>

                                        <v-card>
                                            <v-form @submit.prevent="updateUserPost(post.id)" enctype="multipart/form-data" method="POST">
                                                <v-card-title class="text-h5 grey lighten-2">
                                                    Privacy Policy
                                                </v-card-title>

                                                <v-card-text>
                                                    <v-text-field
                                                            label="Solo"
                                                            single-line
                                                            solo
                                                            class="edit-post-input-field"
                                                            v-model="body"
                                                    ></v-text-field>
                                                    <input
                                                            type="file"
                                                            @change="onFileChanges"
                                                    >

                                                </v-card-text>

                                                <v-divider></v-divider>

                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                            color="primary"
                                                            text
                                                            style="background-color: teal"
                                                            dark
                                                            type="submit"

                                                    >
                                                        Updated
                                                    </v-btn>
                                                </v-card-actions>

                                            </v-form>
                                            <v-divider></v-divider>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                        color="primary"
                                                        text
                                                        @click="deleteAuthUserPost(post.id)"
                                                        style="background-color: red"
                                                        dark
                                                        block
                                                >
                                                    Delete
                                                </v-btn>
                                            </v-card-actions>

                                        </v-card>
                                    </v-dialog>
                                </div>
                            </v-flex>




                            <v-flex xs12 md12 class="social-content-section-main">
                                <div class="social-content-section">
                                    <div class="social-content-text">
                                        <p class="descinline">{{post.body | shorttext(150)}}</p>
                                        <p class="descempty">{{ post.body }}</p>
                                        <span @click="toggle($event)" v-if="post.body.length > 150" style="text-decoration: none; padding: 3px; background: #ddd; border-radius: 5px;cursor: pointer;" >Read More</span>

                                    </div>
                                    <div class="social-content-social" v-if="post.media">
                                        <!--<img src="frontend/img/post.jpg" alt="">-->
                                        <image-zoom
                                                :regular="getPostImgUrl(post.user.id, post.id, post.media)"
                                                :zoom="getPostImgUrl(post.user.id, post.id, post.media)"
                                                :zoom-amount="3"

                                                img-class="img-fluid"
                                                :hover-message=null
                                                alt="Sky">

                                        </image-zoom>

                                    </div>
                                </div>
                            </v-flex>



                            <v-flex xs4 md4>
                                <reactions  :post="post"></reactions>
                            </v-flex>

                            <v-flex xs4 md4>
                                <comment :percomment="post.id" :commentscount="post"></comment>
                            </v-flex>
                            <v-flex xs4 md4>
                                <div style="text-align: center; margin-top: 6px;">
                                    <v-icon class="social-action-section-icon social-action-section-icon-last">mdi-share-variant </v-icon>  <span>Share</span>
                                </div>
                            </v-flex>
                        </v-layout>

                    </div>



                </v-flex>






            </v-layout>
        </div>

    </div>
</template>

<script>
    import Reactions from './Reactions'
    import Comment from './TestComment'
    import imageZoom from 'vue-image-zoomer';
    import 'lazysizes'
    import VueBlu from "vue-blu/dist/vue-blu";
    export default {
        name: "UserPost.vue",
        data(){
            return {
                items: ['foo', 'bar', 'fizz', 'buzz'],
                values: ['foo', 'bar'],
                value: null,
                dialog:{},
                body:'',
                media:'',
                userFilter:null,
            }
        },
        components:{
            VueBlu,
            Reactions,
            Comment,
            imageZoom,
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
                // console.log(this.media);
            },
            onFileChanges(e){
                this.media = e.target.files[0];
                // console.log(this.media);
            },
            userSearchFilter(){
                // alert(this.userFilter);
                this.$router.push('/vue-social-main-profile/'+this.userFilter);
            },
            getImgUrl(id, image){
                return '/media/user/profile_pic/'+id+'/'+image;
            },

            getPostImgUrl(user_id,post_id, image){
                return '/media/post/'+user_id+'/'+post_id+'/'+image;
            },

            createNewPost(){
                const formData = new FormData;
                formData.set('media',this.media);
                formData.set('body', this.body);
                this.$store.dispatch('createNewPost', {
                    id: User.id(),
                    formData
                });


            },

            updateUserPost(id){
                const formData = new FormData;
                formData.set('media',this.media);
                formData.set('body', this.body);
                this.$store.dispatch('updateUserPost', {
                    id:id,
                    formData
                });
                this.dialog[id] = false;

                this.$store.dispatch('getAuthUserAllPost', {
                    id: User.id()
                });

                this.media = '';
                this.body = '';
            },

            deleteAuthUserPost(id){
                this.$confirm("Are you sure? You want to delete the post?").then(() => {
                    this.$store.dispatch('deletePost', id);
                    this.dialog[id] = false;
                    this.$store.dispatch('getAuthUserAllPost', {
                        id: User.id()
                    });
                });
            },

            openAuthUserModal(id, body){
                this.dialog[id] = true;
                this.body = body;
            }

        },
        filters:{

            shorttext(value, limit){
                return value.substring(0, limit);
            }
        },
        created() {
            this.$store.dispatch('getAuthUserAllPost', {
                id: this.$route.params.id
            });

            // Echo.private('App.User.' + User.id())
            //     .notification((notification) => {
            //         this.$store.state.authUserAllPost.unshift(notification.post);
            //     });


            // EventBus.$on('referesh_user_post_now', () =>{
            //     this.$store.dispatch('getAuthUserAllPost', {
            //         id: User.id()
            //     });
            // });
        },
        computed:{
            AuthUserPosts(){
                return this.$store.state.authUserAllPost;
            },

            allUserGet(){
                return this.$store.state.getAllUser;
            }
        },
        mounted() {
            this.$store.dispatch('getAllUser');

        }
    }
</script>

<style scoped>
    .descinline{
        display: inline;
        overflow: hidden;

    }
    .descempty{
        display: none;
    }

</style>

<style lang="scss" scoped>
    .img-fluid{
        width: 574px !important;
        height: 264px !important;
    }
    .social-main-wrapper{
        background-color: #F2F2F2;
        height: max-content !important;
        margin:30px 5px;
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
        .social-content-section-main{
            height: 400px;
            width: 604px;
            overflow: auto;

            .social-content-section{
                overflow: auto;
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