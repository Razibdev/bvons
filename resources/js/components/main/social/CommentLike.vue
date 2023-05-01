<template>
    <div>

        <div class="reactions_flex_section" @click="dialog = !dialog">
            <div class="reactions_flex_single" v-for="(count, reaction) in summary" :key="reaction" v-if="count" >
                <img :src="image(reaction)" alt=""  >
                <span>{{count}}</span>
            </div>
        </div>


        <div class="reactions_section">
            <div class="reactions_section_second" v-show="show_reactions_type"  @click="show_reactions_type = false" style="z-index: 1;" >
                <button @click="toggleReactions(type, commentlike.id, commentlike.post_id )" class="reactions_section_action" v-for="type in types" :key="type">
                    <img :src="image(type)" alt="">
                </button>

            </div>
            <button v-if="own" @click="show_reactions_type = !show_reactions_type" style="margin-left: 15px; margin-top: 4px; cursor: pointer; float: left;">
                <span v-if="auth_reaction"><img :src="image(auth_reaction)" width="10" alt=""> {{auth_reaction}}</span>
                <span v-else>Like</span>
            </button>
            <button style="margin-left: 15px; margin-top: 6px; cursor:pointer" v-else @click="alertByLogin">Like</button>

        </div>



        <!--<div v-for="rec in reacted" :key="rec.id">{{rec.type}}</div>-->


    </div>

</template>

<script>
    export default {
        name: "Reactions.vue",
        props: ['commentlike'],
        data(){
            return{
                dialog: false,
                show_reactions_type:false,
                auth_reaction: null,
                types:['like', 'love', 'haha', 'wow', 'sad', 'angry'],
                tab: null,
                summary :{},

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

            toggleReactions(reaction, comment_id, post_id){
                let old_reaction = this.auth_reaction;
                let user_id = User.id();
                axios.post(`/api/post/${this.commentlike.id}/comment-reactions`, {reaction, comment_id, user_id})
                    .catch(() => {
                        // this.saveReaction(old_reaction, reaction);

                    });
                if(old_reaction === reaction){
                    this.auth_reaction = null;

                }else{
                    this.auth_reaction = reaction;

                }
                EventBus.$emit('commentLike', post_id);

                // this.saveReaction(reaction, old_reaction);
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
            }
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
            axios.get(`api/post/comment-reactions/${this.commentlike.id}/${User.id()}`)
                .then(res => {
                    // console.log(res.data);
                    this.auth_reaction = res.data;
                });

            Echo.channel('likeChannel')
                .listen('LikeEvent', (e) => {

                    if(this.commentlike.id === e.id){
                        this.resetReactionSummary(e.type, e.old);
                        EventBus.$emit('commentLikes', this.commentlike.post_id );

                    }
                });

            // this.commentlike.comment_reactions.forEach(item =>{
            //     if(item.user_id === User.id()){
            //         this.auth_reaction = item.type;
            //         console.log(item.type);
            //     }
            // })
            //
            // axios.get(`api/post/reaction/summary/${this.post.id}`)
            //     .then(res => {
            //         console.log(res.data);
            //         this.summary = res.data;
            //     });
            //
            // this.$store.dispatch('getSocialLikeReactUser', {
            //     post_id: this.post.id
            // });


        },
        mounted() {

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
    span{

    }

    .reactions_flex_section{
        display: flex;
        margin-top: -19px;
        margin-left: 15px;
        cursor: pointer;
        padding-left: 6px;

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
        margin-top:8px;
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


