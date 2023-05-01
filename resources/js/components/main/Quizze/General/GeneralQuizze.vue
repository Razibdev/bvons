<template>
    <div>
        <div class="main">
            <div class="container">

                <div class="header">
                    <div style="display:block !important;">
                        <h3 class="text--white" style="display: block;">Bvon Quize</h3>
                    </div>
                    <div class="section-head">
                        <router-link class="link-router-general-rank" to="/bvon-general-quizze-rank">G Quizze Ranking</router-link>
                        <router-link to="#" class="link-router-general-rank">Exam Quizze Ranking</router-link>
                        <router-link to="/bvon-attend-quizze-exam" class="link-router-general-rank">Attend Quizze Exam</router-link>
                    </div>

                </div>
            </div>

            <v-row wrap>
                <v-flex sm12 md3></v-flex>
                <v-flex xs12 sm12 md6 class="box">
                   <single-general-quizze  :singleQuestionShow="singleQuestionShow"></single-general-quizze>
                </v-flex>
                <v-flex sm12 md3></v-flex>
            </v-row>
        </div>
    </div>
</template>

<script>





    import SingleGeneralQuizze from './SingleGeneralQuizze';
    export default {
        data(){
            return{
              singleQuestionShow:'',
                value : 5,
                // index:1
            }
        },
        components:{
            SingleGeneralQuizze
        },
        methods:{
          signleQuestion(){
              axios.get('/api/bvon-general-quizze-single')
                  .then(res =>{
                      this.singleQuestionShow = res.data;
                      console.log(res.data);
                     this.value = res.data.duration ;
                  })
                  .catch(error =>console.log(error.response.data));
            }
        },
        created() {


            let i = 1;
            var tm = this;


                setTimeout(function run() {
                    // func(i++);
                    i++;
                    // alert('ok');
                    if (this.singleQuestionShow != '') {
                        tm.signleQuestion();
                        console.log('ok');
                        console.log(tm.value);
                        var value = tm.value * 1000;
                        setTimeout(run, value);
                    }
                }, 1000);



            EventBus.$on('singleQuestionRefresh', () => {
                this.signleQuestion();
            });
        },
        mounted() {
            this.signleQuestion();
           console.log( this.singleQuestionShow);
            User.countSetTime(0);

            // let i = 1;
            // setTimeout(function run() {
            //     alert('ok')
            //     var value = 0;
            //     func(i++);
            //     this.signleQuestion();
            //     value += this.value;
            //     console.log(value);
            //     setTimeout(run, value*100);
            // }, 1000);

        }
    }
</script>

<style lang="scss" scoped>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");

    .main {
        width: 1200px;
        max-width: 100%;
        background-color: rgba(226, 226, 226, 0.555);
        margin: -0 auto;
    }
    .heading {
        font-size: 40px;
        padding: 1rem 0;
        font-weight: 700;
    }
    .box {
        margin: 1rem;
        justify-content: center;
    }
    .qheading {
        font-family: "Inter", sans-serif;
        color: rgb(9, 40, 75);
        margin-bottom: 1rem;
        font-size: 1.3rem;
        font-weight: 700;
    }
    div p {
        font-family: "Inter", sans-serif;
        line-height: 1.3rem;
        font-weight: 400;
        font-size: 18px;
    }
    .button {
        display: flex;
        margin: 1rem;
        justify-content: center;
    }


    .container {
        font-family: "Inter", sans-serif;
        width: 1200px;
        max-width: 100%;
        margin: 0 auto;
        border: solid 1px rgb(218, 218, 218);
        border-radius: 3px;
    }
    .header {
        display: block;
        background-color: #00e676;
        padding: 0.7rem;
    }
    .header .section-head{
        display: flex;
        justify-content: space-between;
    }
    .header .link-router-general-rank {

        text-decoration: none;
        color: black;
        font-size: 16px;
        font-weight: 400;
        cursor: pointer;

    }
</style>
