<template>
    <div>
        <div class="reactions_flex_section" @click="dialog = !dialog">
            <div class="reactions_flex_single" v-for="(count, reaction) in summary" :key="reaction" v-if="count" >
                <div  @click="loveData(reaction, post.id)">
                    <img :src="image(reaction)" alt="">
                    <span>{{count}}</span>
                </div>

            </div>

        </div>
        <div class="reactions_section">
            <div class="reactions_section_second" v-show="show_reactions_type"  @click="show_reactions_type = false" style="z-index: 1;" >
                <button @click="toggleReactions(type)" class="reactions_section_action" v-for="type in types" :key="type">
                    <img :src="image(type)" alt="">
                </button>

            </div>
            <button v-if="own" @click="show_reactions_type = !show_reactions_type" style="margin-left: 15px; margin-top: 6px; cursor: pointer;">
                <span v-if="auth_reaction"><img :src="image(auth_reaction)" width="25" alt=""> {{auth_reaction}}</span>
                <span v-else><span :class="{'reactionlast' : !auth_reaction}"  style="position: absolute;"><v-icon style="font-size: 20px; ">mdi-thumb-up-outline</v-icon> Like</span></span>

                </button>
            <button style="margin-left: 15px; margin-top: 6px; cursor:pointer" v-else @click="alertByLogin"><v-icon style="font-size: 20px;">mdi-thumb-up-outline</v-icon> Like</button>

        </div>
            <div v-for="rec in reacted" :key="rec.id">{{rec.type}}</div>

        <div class="text-center">
            <v-dialog
                    v-model="dialog"
                    width="500"
            >
                <template v-slot:activator="{ on, attrs }">

                </template>

                <v-card color="basil">


                    <!--<v-tabs-->
                            <!--v-model="tab"-->
                            <!--background-color="transparent"-->
                            <!--color="basil"-->

                            <!--class="social-tab-wrapper"-->
                    <!--&gt;-->
                        <!--<v-tab-->
                                <!--v-for="(count, reaction) in summary"-->
                                <!--:key="reaction"-->
                                <!--class="social-tab-part"-->

                        <!--&gt;-->
                            <!--<img :src="image(reaction)" width="20" height="20" style="border-radius: 10px" alt=""> <span>{{count}}</span>-->
                        <!--</v-tab>-->
                    <!--</v-tabs>-->

                    <!--<v-tabs-items v-model="tab">-->
                        <!--<v-tab-item-->
                                <!--v-for="(cout,reac) in summary"-->
                                <!--:key="reac"-->
                        <!--&gt;-->
                            <!--<v-card-->
                                    <!--color="basil"-->
                                    <!--flat-->
                            <!--&gt;-->
                                <!--<v-list subheader>-->
                                    <!--<v-subheader> </v-subheader>-->

                                    <!--<v-list-item-->
                                            <!--v-for="chat in getSocialReactUser"-->
                                            <!--v-if="chat.type == reac"-->
                                            <!--:key="chat.title"-->
                                    <!--&gt;-->
                                        <!--<v-list-item-avatar>-->
                                            <!--<v-img-->
                                                    <!--:src="imageUser(chat.user.profile_pic, chat.user.id)"-->
                                            <!--&gt;</v-img> &nbsp;-->
                                        <!--</v-list-item-avatar>-->

                                        <!--<v-list-item-content>-->
                                            <!--<v-list-item-title v-text="chat.user.name"></v-list-item-title>-->
                                        <!--</v-list-item-content>-->

                                    <!--</v-list-item>-->
                                <!--</v-list>-->

                            <!--</v-card>-->
                        <!--</v-tab-item>-->
                    <!--</v-tabs-items>-->



                    <v-tabs>

                        <v-tab v-for="(count, reaction) in summary" :key="reaction" :href="'#'+reaction" class="social-tab-part" @click="loveData(reaction, post.id )" >
                            <img :src="image(reaction)" width="20" height="20" style="border-radius: 10px" alt="" /> <span>{{count}}</span>

                        </v-tab>
                        <v-tab-item v-for="(count, reaction) in summary" :key="reaction" :value="reaction">
                            <v-card
                                    color="basil"
                                    flat
                                    style="margin-bottom: 20px;"

                            >
                                <v-list >
                                    <!--<v-subheader> </v-subheader>-->
                                    <v-list-item
                                            v-for="chat in loveFetch"
                                            :key="chat.title"
                                    >
                                        <v-list-item-avatar>
                                            <v-img
                                                    :src="imageUser(chat.user.profile_pic, chat.user.id)"
                                            ></v-img> &nbsp;
                                        </v-list-item-avatar>

                                        <v-list-item-content>
                                            <v-list-item-title >{{chat.user.name}}</v-list-item-title>
                                        </v-list-item-content>

                                    </v-list-item>
                                </v-list>
                                <span v-if=" lastPageLove > pageLove" @click="loadMoreData(reaction, post.id)" style="text-align: center; padding: 5px; background: #41ab53; border-radius: 10px; cursor: pointer; margin-bottom: 10px; margin-left: 10px !important;">Lode more data</span>

                                <!--<div style="height: 20px; width: 100%;" v-observe-visibility="handleScrollToBottomLove(reaction, post.id)"></div>-->

                            </v-card>
                        </v-tab-item>

                    </v-tabs>

                </v-card>
            </v-dialog>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Reactions.vue",
        props: ['post', 'reacted'],
        data(){
            return{
                dialog: false,
                show_reactions_type:false,
                auth_reaction: this.razib ? this.razib.type : null,
                types:['like', 'love', 'haha', 'wow', 'sad', 'angry'],
                tab: null,
                summary :{},
                loveFetch:[],
                pageLove:1,
                lastPageLove:1,

                items: [
                    'Appetizers', 'Entrees', 'Deserts', 'Cocktails',
                ],
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',


            }
        },
        methods:{
            alertByLogin(){
                this.$alert("Please LogIn First");
            },
            image(type){
                return `frontend/img/reactions/reactions_${type}.png`
            },

            imageUser(type,id){
                return `media/user/profile_pic/${id}/${type}`;
            },

            toggleReactions(reaction){
                let old_reaction = this.auth_reaction;
                axios.post(`/api/post/${this.post.id}/reactions`, {reaction})
                    .catch(() => {
                        this.saveReaction(old_reaction, reaction);
                    });

               this.saveReaction(reaction, old_reaction);

                axios.get(`api/post/reaction/summary/${this.post.id}`)
                    .then(res => {
                        console.log(res.data);
                        this.summary = res.data;
                    });
            },

            saveReaction(new_reaction, old_reaction){
                this.resetReactionSummary(new_reaction, old_reaction);

                if(this.auth_reaction === new_reaction){
                    this.auth_reaction = null;
                    return
                }
                this.auth_reaction = new_reaction;


            },
            resetReactionSummary(new_reaction, old_reaction){
                if(old_reaction){
                    this.summary[old_reaction]--;
                }

                if(new_reaction && old_reaction !== new_reaction){
                    if(!this.summary[new_reaction]){
                        this.summary[new_reaction] = 1;

                        return;
                    }
                    this.summary[new_reaction]++;

                }


            },

            loveData(reaction, id){
                this.loveFetch = [];
                this.pageLove = 1;
                this.fetchLove(reaction, id);

            },

             fetchLove(reaction, id){
                let love =  axios.get(`/api/social/like-react-user-love/${id}/${reaction}?page=${this.pageLove}`)
                    .then(res => {
                        console.log(res.data.data);
                        this.loveFetch.push(...res.data.data);
                        this.lastPageLove = res.data.last_page;
                    })

                // this.loveFetch.push(...love.data.data);
                // this.lastPageLove = love.data.last_page;
                //PromiseResult
            },

            loadMoreData(reaction, id){
                if(this.pageLove >= this.lastPageLove){return}
                this.pageLove++;
                this.fetchLove(reaction, id);
            },


            handleScrollToBottomLove(reaction,id){
                // if(!isVisible) {return}
                if(this.pageLove >= this.lastPageLove){return}
                this.pageLove++;
                this.fetchLove(reaction, id);
            },
        },
        computed:{
            getSocialReactUser(){
                return this.$store.state.getSocialReactUser;
            },
            own(){
                return User.loggedIn();
            }

         },
        created(){
            axios.get(`api/post/reactions/${this.post.id}/${User.id()}`)
                .then(res => {
                    // console.log(res.data);
                    this.auth_reaction = res.data;

                });

            axios.get(`api/post/reaction/summary/${this.post.id}`)
                .then(res => {
                    console.log(res.data);
                    this.summary = res.data;
                });

            this.$store.dispatch('getSocialLikeReactUser', {
                post_id: this.post.id
            });

            Echo.channel('likeChannel')
                .listen('LikeEvent', (e) => {

                    if(this.post.id === e.id){
                        this.resetReactionSummary(e.type, e.old);
                    // console.log(e);
                    }
                });
        },
        mounted() {
            // console.log(this.$store.state.getSocialReactUser);
        }
    }
</script>

<style>
    .basil {
        background-color: #FFFBE6 !important;
    }
    .basil--text {
        color: #356859 !important;
    }
</style>

<style lang="scss" scoped>
    .reactionlast{
        margin-top: -5px !important;
    }

    .reactions_flex_section{
        display: flex;
        margin-top: -19px;
        margin-left: 15px;
        cursor: pointer;
        padding-left: 6px;
        height: 23px;

        .reactions_flex_single{
            padding: 1px;
            img{
                width: 20px;
                height: 20px;
                border-radius: 5px;
            }
        }
    }

    .reactions_section{
        position: relative;
        padding-left: 12px;
        margin-top:3px;
        .reactions_section_second{
            margin-top: -30px;
            position: absolute;
            border-radius: 7px;
            box-shadow: 2px 2px 2px #dddddd;
            background: white;
            margin-left: 15px;

            .reactions_section_action{
                padding: 4px;
                border-radius: 7px;
                &:hover{
                    background-color: #dddddd;
                }
                img{
                    width: 20px;
                    height: 20px;
                   border-radius: 5px;
                }
            }


        }


    }
</style>

<style lang="sass" scoped>
    .v-icon
     color: #000 !important
     background-color: #fff !important
    .theme--light
     color: #000 !important
     background-color: #fff !important
</style>