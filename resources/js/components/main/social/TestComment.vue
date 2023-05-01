<template>
    <div>
        <div class="text-center">
            <v-dialog
                    v-model="comment[percomment]"
                    width="500"
            >
                <template v-slot:activator="{ on, attrs }">
                    <div class="social-action-section-icon-middle"  v-bind="attrs" v-on="on" @click="getUserPostsingleComment(percomment)" >
                        <span>{{totaSubTotal}}</span>
                        <v-icon class="social-action-section-icon">mdi-comment-text-multiple-outline</v-icon> <span>Comment</span>
                    </div>
                </template>
                <v-card>

                    <v-list three-line style="height: 400px; overflow: auto; padding-top:14px;">
                        <template v-for="(item, index) in comments">

                            <v-list-item
                                    :key="item.id"
                                    style="margin-top: 10px; min-height: 70px;"
                            >
                                <v-list-item-avatar>
                                    <v-avatar>
                                        <img
                                                :src="imageUser(item.user.profile_pic, item.user.id)"
                                                alt="bvon"
                                        >
                                    </v-avatar>
                                </v-list-item-avatar>

                                <v-list-item-content style="display: block; padding: 0;">
                                    <div style="background-color: #ddd; border-radius: 10px; padding: 3px; margin-left: 10px; margin-right: 10px;">
                                    <v-list-item-title v-html="item.user.name"></v-list-item-title>
                                    <v-list-item-subtitle ><span style="background-color: #ddd; border-radius:  5px; padding:0 2px 2px; height: max-content;display: block;overflow: hidden;"> <span>{{item.body}}</span>
                                        <span>
                                            <span class="reactions_flex_section" @click="reactionDialog(item.id)">
                                                <span class="reactions_flex_single" v-for="(reaction) in item.comment_reactions_group" :key="reaction.id" v-if="reaction" >
                                                    <img :src="image(reaction.type)" width="7" alt=""  >
                                                </span>
                                            </span>
                                            <span v-if="item.comment_reaction_count">{{item.comment_reaction_count}}</span>
                                        </span>
                                        </span>
                                    </v-list-item-subtitle>
                                    </div>
                                    <span style="cursor: pointer; margin-top: 10px; display: block;"><a class="comment-reply-section" style="margin-top: -20px;" href="#"><commen-like :commentlike=item></commen-like></a> &nbsp; <a class="comment-reply-section" @click="oneClick(index, item.user.name)" href="#"> <span  v-if="item.reply_count">{{item.reply_count}}</span> &nbsp;Reply</a> &nbsp;<a class="comment-reply-section" href="#">Share</a> <span class="comment-reply-section"></span></span>
                                    <div v-if="perClickShowEachItem === index">
                                        <template v-for="(sub_item, i) in item.reply">
                                            <v-list-item

                                                    :key="sub_item.id"
                                            >
                                                <v-list-item-avatar>
                                                    <v-avatar>
                                                    <img :src="imageUser(sub_item.user.profile_pic, sub_item.user.id)">
                                                    </v-avatar>
                                                </v-list-item-avatar>

                                                <v-list-item-content>
                                                    <v-list-item-title v-html="sub_item.user.name"></v-list-item-title>
                                                    <v-list-item-subtitle v-html="sub_item.message"> </v-list-item-subtitle>
                                                    <!--<span style="cursor: pointer;"><a class="comment-reply-section" href="#">Like</a> &nbsp; <a class="comment-reply-section" href="#">Reply</a> &nbsp;<a class="comment-reply-section" href="#">Share</a> <span class="comment-reply-section"></span></span>-->

                                                </v-list-item-content>
                                            </v-list-item>
                                        </template>

                                        <v-responsive
                                                max-width="400"
                                                class="mx-auto mb-4"
                                        >
                                            <v-row>
                                                <v-col
                                                        cols="12"
                                                        sm="12"
                                                        class="py-2"
                                                >

                                                    <v-btn-toggle style="width: 100%;">
                                                        <v-form  style="width: 400px;" class="social-comment-section-action-name" method="post"  @submit.prevent="newReplyComment(item.id, index)">
                                                            <v-text-field
                                                                    label="Comment"
                                                                    solo
                                                                    style="width: 276px;margin-left: 23px;"
                                                                    v-model="reply"
                                                            ></v-text-field>
                                                            <v-btn depressed dark type="submit" style="background-color: teal; margin-top:  -56px; float:right;" >Submit</v-btn>
                                                        </v-form>

                                                    </v-btn-toggle>
                                                </v-col>
                                            </v-row>

                                        </v-responsive>

                                    </div>
                                </v-list-item-content>

                            </v-list-item>




                            <div class="text-center">
                                <v-dialog
                                        v-model="dialog[item.id]"
                                        width="500"
                                >
                                    <template v-slot:activator="{ on, attrs }">

                                    </template>

                                    <v-card color="basil">
                                        <v-tabs
                                                v-model="tab"
                                                background-color="transparent"
                                                color="basil"

                                                class="social-tab-wrapper"
                                        >
                                            <v-tab
                                                    v-for="reaction in  item.comment_reactions_group"
                                                    :key="reaction.id"
                                                    class="social-tab-part"
                                            >
                                                <img :src="image(reaction.type)" width="20" height="20" style="border-radius: 10px" alt=""> <span></span>
                                            </v-tab>
                                        </v-tabs>

                                        <v-tabs-items v-model="tab">
                                            <v-tab-item
                                                    v-for="(reac, j) in item.comment_reactions_group"
                                                    :key="j"
                                            >
                                                <v-card
                                                        color="basil"
                                                        flat
                                                >
                                                    <v-list subheader>
                                                        <v-subheader> </v-subheader>

                                                        <v-list-item
                                                                v-for="chat in getCommentReactionUsers"
                                                                v-if="chat.type == reac.type"
                                                                :key="chat.id"
                                                        >
                                                            <v-list-item-avatar>
                                                                <v-img
                                                                        :src="imageUser(chat.user.profile_pic, chat.user.id)"
                                                                ></v-img> &nbsp;
                                                            </v-list-item-avatar>

                                                            <v-list-item-content>
                                                                <v-list-item-title v-text="chat.user.name"></v-list-item-title>
                                                            </v-list-item-content>

                                                        </v-list-item>
                                                    </v-list>

                                                </v-card>
                                            </v-tab-item>
                                        </v-tabs-items>
                                    </v-card>
                                </v-dialog>
                            </div>

                        </template>
                        <div style="height: 55px; width: 100%;" v-observe-visibility="handleScrollToBottom"></div>
                    </v-list>


                    <v-responsive
                            max-width="400"
                            class="mx-auto mb-4"
                    >
                        <v-row>
                            <v-col
                                    cols="12"
                                    sm="12"
                                    class="py-2"
                            >
                                <v-btn-toggle style="width: 100%; margin-top:20px;">
                                    <v-form  style="width: 400px;" method="post" @submit.prevent="newCommentSubmit(percomment, commentscount.user_id)">
                                        <v-text-field
                                                label="Comment"
                                                solo
                                                style="width: 305px;"
                                                v-model="body"
                                        ></v-text-field>
                                        <v-btn depressed dark type="submit" style="background-color: teal; margin-top:  -77px; float:right;" >Submit</v-btn>
                                    </v-form>

                                </v-btn-toggle>
                            </v-col>
                        </v-row>

                    </v-responsive>


                </v-card>
            </v-dialog>
        </div>

    </div>
</template>

<script>
    import CommenLike from './CommentLike'
    export default {
        name: "Comment.vue",
        props: ['percomment', 'commentscount'],
        data(){
            return{
                tab: null,
                comment: {},
                perClickShowEachItem:undefined,
                subTotal:this.commentscount.comment_count,
                subSTotal:this.commentscount.reply_count,
                body:null,
                reply:null,
                getCommentReactionUsers:{},
                dialog:{},
                types:['like', 'love', 'haha', 'wow', 'sad', 'angry'],
                page:1,
                lastPage:1,
                comments:[]

            }
        },

        methods:{
            // commentOpen(comment){
            //     this.comment[comment] = true;
            // },
            totaSubTotals(){
                return this.subTotal+ this.subSTotal;
            },

            oneClick(index, user){
                this.perClickShowEachItem = index;
               this.reply = `@${user}`;

            },
            reactionDialog(id){
                this.dialog[id] = true;
                this.comment = false;

                axios.get('/api/post/comment-reaction-users-info/'+id)
                    .then(res => {
                        this.getCommentReactionUsers = res.data;
                        // console.log(this.getCommentReactionUsers);
                    });

            },

            image(type){
                return `frontend/img/reactions/reactions_${type}.png`
            },

            alertByLogin(){
                this.$alert("Please LogIn First");
            },


            imageUser(type,id){
                return `media/user/profile_pic/${id}/${type}`;
            },

            newCommentSubmit(post_id, user_id){
                // const formData = new FormData;
                // formData.set('body',this.body);
                // this.$store.dispatch('userCommentSubmit', {
                //     user_id: user_id,
                //     post_id : id,
                //     body: this.body
                // });


                axios.post('/api/social/user-per-post', {user_id, post_id, body:this.body})
                    .then(res => {
                        // console.log(res.data);


                        if(res.data.message){
                            if(res.data.message === "Your are already comment this post!"){

                                this.$store.dispatch('addNotification', {
                                    type: 'error',
                                    message: 'Your are already comment this post!'
                                });

                            }else{
                                this.$store.dispatch('addNotification', {
                                    type: 'success',
                                    message: 'Comment Successfully Done!'
                                });
                                // this.$store.dispatch('addNotification', {
                                //     type: 'error',
                                //     message: res.data.message
                                // });
                                this.subTotal++;
                                // commit('USER_COMMENT_SUBMIT', res.data.comment);
                                this.comments.unshift(res.data.comment)

                            }

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: 'Comment Successfully Done!'
                            });
                            this.subTotal++;
                            this.comments.unshift(res.data.comment);
                        }

                    });

                this.body = '';

                // console.log(formData);
                EventBus.$emit('delete_post_fel');
                EventBus.$emit('referesh_user_post_now');
            },

            newReplyComment(comment_id, index){
                // this.$store.dispatch('newReplyCommentSubmit',{
                //     user_id: User.id(),
                //     post_id : this.percomment,
                //     message: this.reply,
                //     comment_id: id
                // });


                axios.post('/api/social/new-reply-comment/'+comment_id, {user_id:User.id(), post_id:this.percomment,  message: this.reply})
                    .then(res => {
                        // console.log(res.data);
                        this.$store.dispatch('addNotification', {
                            type: 'success',
                            message: 'Reply Successfully Done!'
                        });
                        this.getUserPostsingleComment(this.percomment);
                    });



                this.perClickShowEachItem = index;
                this.reply = '';
                EventBus.$emit('delete_post_fel');
                this.$store.dispatch('getPostUserComment', {
                    post_id :  this.percomment
                });
                this.subSTotal++;
            },

             getUserPostsingleComment(id){
                // this.$store.dispatch('getPostUserComment', {
                //     post_id :  this.percomment
                // });
               //   if(this.page > this.lastPage){return}
               // this.test(id);
               //   this.page++;

                 // let comment = await  axios.get(`/api/social/user-post-comment/${id}`);
                 // // console.log(comment.data);
                 // this.lastPage = comment.data.meta.last_page
                 // this.comments =comment.data.data;

                this.comments = [];
                this.page = 1;
                this.test(id);
            },

            async test(id){
                let comment = await  axios.get(`/api/social/user-post-comment/${id}?page=${this.page}`);
                // console.log(comment.data);
                this.lastPage = comment.data.meta.last_page
                this.comments.push(...comment.data.data);
            },

            handleScrollToBottom(isVisible){
                if(!isVisible) {return}
                if(this.page >= this.lastPage){return}
                this.page++;
                this.test(this.percomment);
            },





        },

        created(){
            // this.$store.dispatch('getPostUserComment', {
            //     post_id :  this.percomment
            // });


            EventBus.$on('commentLike',(post_id) => {
                // this.$store.dispatch('getPostUserComment', {
                //     post_id
                // });
                // console.log(post_id);
                // this.test(post_id);
                axios.get(`/api/social/user-post-comment/${post_id}?page=${this.page}`)
                    .then(res =>{
                        this.comments = res.data.data;
                        // console.log(res.data);
                    });
            });

            Echo.channel('commentChannel')
                .listen('CommentEvent', (e) => {
                    if(this.percomment === e.id){
                        // console.log(e);
                        // this.getUserPostsingleComment(e.id);
                        axios.get(`/api/social/user-post-comment/${e.id}`)
                            .then(res =>{
                                this.comments = res.data.data;
                                // console.log(res.data);
                            });
                        this.subTotal++;
                    }
                });
        },

        components:{
            CommenLike
        },

        computed: {
            totaSubTotal(){
                return this.totaSubTotals();
            },

            getSocialReactUser(){
                return this.$store.state.getSocialReactUser;
            },

            own(){
                return User.loggedIn();
            },
            // comments(){
            //     return this.$store.state.comment;
            // }
        },

    }
</script>
<style lang="scss" scoped>
    .comment-reply-main-section{
        margin-top: 10px;
    }
    .comment-reply-section{
        font-size: 10px;
        color:black;
    }
    .social-action-section-icon-middle{
        margin-top: 10px;
        text-align: center;
        color: #111111;
        .social-action-section-icon{
            color: #111;
        }
        span{
            cursor: pointer;
        }
    }
    .cf{
        height: 250px !important;
    }


    .reactions_flex_section{
        cursor: pointer;

    }
</style>

