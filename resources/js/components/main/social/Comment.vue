<template>
    <div>
        <div class="social-action-section-icon-middle" @click="comment = !comment">
            <span>{{commentscount.comment_count}}</span>
            <v-icon class="social-action-section-icon">mdi-comment-text-multiple-outline</v-icon> <span>Comment</span>
        </div>

        <div class="text-center" >
            <v-dialog
                    v-model="comment"
                    width="500"
                    style="background:#fff"
            >
                <template v-slot:activator="{ on, attrs }">

                </template>

                <v-card
                        elevation="16"
                        max-width="500"
                        class="mx-auto"
                >

                    <v-virtual-scroll
                            :bench="benched"
                            :items="comments"
                            height="500"
                            :item-height="113"
                    >
                        <template v-slot:default="{ item }">
                            <v-list-item :key="item.id">
                                <v-list-item-action>
                                    <v-btn
                                            fab
                                            small
                                            depressed
                                            color="primary"
                                            style="background-color: #2A73C5"
                                    >
                                        <v-avatar>
                                            <img
                                                    :src=" imageUser(item.user.profile_pic, item.user.id)"
                                                    alt="John"
                                            >
                                        </v-avatar>
                                    </v-btn>
                                </v-list-item-action>

                                <v-list-item-content style="margin-left:10px">
                                    <v-list-item-title style="font-size: 13px;">
                                        {{item.user.name}}
                                    </v-list-item-title>
                                    <v-list-item-title style="font-size: 12px">
                                        {{item.body}}
                                    </v-list-item-title>
                                    <!--<input type="hidden" v-if="item.reply_count" id="perreplycount" ref="perreplycount" name="perreplycount" :value="item.reply_count">-->
                                    <input type="hidden" ref="data" name="data" value="Hello" id="data">
                                    <span style="cursor: pointer;" class="comment-reply-main-section"><a class="comment-reply-section" href="#"><comment-like></comment-like></a> &nbsp; <a @click="userReplyComment(item.id, item.reply_count)" class="comment-reply-section" href="#"><span v-if="item.reply_count" >{{item.reply_count}}</span> Reply</a> &nbsp;<a class="comment-reply-section" href="#">Share</a> <span class="comment-reply-section">{{item.created_at}}</span></span>

                                </v-list-item-content>

                            </v-list-item>

                            <div v-if="replyFocusOn"
                            >

                                <v-virtual-scroll
                                        :bench="1"
                                        :items="item.reply"
                                        height="250"
                                        item-height="113"
                                        style="margin-left: 50px; overflow:auto;"

                                >
                                    <template v-slot:default="{ item }" >
                                        <v-list-item :key="item.id" v-if="item">
                                            <v-list-item-action>
                                                <v-btn
                                                        fab
                                                        small
                                                        depressed
                                                        style="width: 35px; height: 35px; background-color: #2A73C5"
                                                        color="primary"
                                                >
                                                    <v-avatar  size="35" style="background-color: transparent">
                                                        <img
                                                                :src=" imageUser(item.user.profile_pic, item.user.id)"
                                                                alt="John"

                                                        >
                                                    </v-avatar>
                                                </v-btn>
                                            </v-list-item-action>

                                            <v-list-item-content style="margin-left:10px">
                                                <v-list-item-title style="font-size: 12px;">
                                                    {{item.user.name}}
                                                </v-list-item-title>
                                                <v-list-item-title style="font-size: 11px;">
                                                    {{item.message}}
                                                </v-list-item-title>
                                                <span style="cursor: pointer;"><a class="comment-reply-section" href="#">Like</a> &nbsp; <a class="comment-reply-section" href="#">Reply</a> &nbsp;<a class="comment-reply-section" href="#">Share</a> <span class="comment-reply-section">{{item.created_at}}</span></span>

                                            </v-list-item-content>

                                        </v-list-item>
                                    </template>
                                </v-virtual-scroll>
                            </div>

                        </template>
                    </v-virtual-scroll>

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
                                    <v-form @submit.prevent="commentSubmit" style="width: 400px;" method="post">
                                        <v-text-field
                                                label="Comment"
                                                solo
                                                v-model="body"
                                                style="width: 305px;"
                                        ></v-text-field>
                                        <v-btn depressed dark type="submit" style="background-color: teal; margin-top:  -77px; float:right;" v-if="own">Comment</v-btn>
                                        <v-btn depressed dark style="background-color: teal; margin-top: -77px; float:right;" v-else @click="alertByLogin" >Comment</v-btn>
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




    export default {
        data () {
            return {
                dialog: true,
                perClickShowEachItem:undefined,

                items: [
                    { header: 'Today' },
                    {
                        id:1,
                        avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
                        title: 'Brunch this weekend?',
                        subtitle: `<span class="text--primary">Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?`,
                    },
                    { divider: true, inset: true },
                    {
                        id:2,
                        avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
                        title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
                        subtitle: `<span class="text--primary">to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend.`,
                    },
                    { divider: true, inset: true },
                    {
                        id:3,
                        avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
                        title: 'Oui oui',
                        subtitle: '<span class="text--primary">Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?',
                    },
                    { divider: true, inset: true },
                    {
                        id:4,
                        avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
                        title: 'Birthday gift',
                        subtitle: '<span class="text--primary">Trevor Hansen</span> &mdash; Have any ideas about what we should get Heidi for her birthday?',
                    },
                    { divider: true, inset: true },
                    {
                        id:5,
                        avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
                        title: 'Recipe to try',
                        subtitle: '<span class="text--primary">Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.',
                    },

                    { divider: true, inset: true },
                    {
                        id:6,
                        avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
                        title: 'Recipe to try',
                        subtitle: '<span class="text--primary">Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.',
                    },

                    { divider: true, inset: true },
                    {
                        id:7,
                        avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
                        title: 'Recipe to try',
                        subtitle: '<span class="text--primary">Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.',
                    },
                ],
            }
        },
        methods:{
            oneClick(index){
                this.perClickShowEachItem = index;
            }
        },

    }


















    // import CommentLike from './CommentLike';
    // export default {
    //     name: "Comment.vue",
    //     props: ['percomment', 'commentscount'],
    //     data(){
    //         return{
    //             comment: false,
    //             benched: 0,
    //             body: null,
    //             replyFocusOn:false,
    //             itemHeight:113,
    //             reply_count_per: 0,
    //             someData:113,
    //
    //         }
    //     },
    //
    //     mounted(){
    //
    //     },
    //
    //     methods:{
    //         alertByLogin(){
    //             this.$alert("Please LogIn First");
    //         },
    //
    //         userReplyComment(id, value){
    //             if(value>0){
    //                 this.someData = value*113+113;
    //                 this.replyFocusOn = true;
    //
    //
    //             }
    //
    //             alert(id);
    //
    //
    //         },
    //
    //         imageUser(type,id){
    //             return `media/user/profile_pic/${id}/${type}`;
    //         },
    //
    //         commentSubmit(){
    //             // const formData = new FormData;
    //             // formData.set('body',this.body);
    //             this.$store.dispatch('userCommentSubmit', {
    //                 user_id: User.id(),
    //                 post_id : this.percomment,
    //                 body: this.body
    //             });
    //             // console.log(formData);
    //         },
    //
    //
    //
    //     },
    //
    //     created(){
    //       this.$store.dispatch('getPostUserComment', {
    //           post_id :  this.percomment
    //       });
    //     },
    //
    //     components:{
    //         CommentLike
    //     },
    //
    //     computed: {
    //         perItemHeight(){
    //             if(this.reply_count_per != 0){
    //                 return this.reply_count_per * 1003;
    //             }
    //             return 2000;
    //         },
    //
    //         items () {
    //             return Array.from({ length: this.length }, (k, v) => v + 1)
    //         },
    //         length () {
    //             return 7000
    //         },
    //
    //         own(){
    //             return User.loggedIn();
    //         },
    //         comments(){
    //             return this.$store.state.comment;
    //         }
    //     },
    //
    // }
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
</style>