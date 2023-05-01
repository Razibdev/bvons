<template>
    <div>
        <loader v-if="isLoading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#ffffff" objectbg="#999793" opacity="100" disableScrolling="true" name="dots"></loader>
        <template>
                <v-layout row wrap>

                    <v-flex xs12 md3>
                    </v-flex>

                    <v-flex xs12 md6>

                        <second-social v-for="(social, i) in getSocial" :key="i" :social="social"></second-social>

                    </v-flex>

                    <v-flex xs12 md3>
                    </v-flex>
                </v-layout>

        </template>
    </div>
</template>
<script>
    import SecondSocial from './SecondSocial'

    export default {
        data(){
          return{
              isLoading:true,
              // getSocial:[]
          }
        },
        components:{
           SecondSocial,
        },
        methods:{
          getAllPostFetch(){
              this.$store.dispatch('getAllSocial');

          }
        },
        created(){
          EventBus.$on('delete_post_fel', () => {
              this.getAllPostFetch();
          });
            // setTimeout(() => this.isLoading = false, 3000);

            axios.get('/api/social')
                .then(res => {
                    this.isLoading = true;
                    this.$store.state.getAllSocial = res.data;

                    // commit('GET_ALL_SOCIAL', res.data);
                }).finally(()=> this.isLoading = false);

        },
        mounted() {
            // this.$store.dispatch('getAllSocial');
            // console.log(this.$store.state.getAllSocial);
            // console.log(this.$store.state.getAllSocial);


        },

        computed:{
            getSocial(){
                return this.$store.state.getAllSocial
            },
            // visible(){
            //     return this.$store.state.visible;
            // }
        }
    }
</script>
