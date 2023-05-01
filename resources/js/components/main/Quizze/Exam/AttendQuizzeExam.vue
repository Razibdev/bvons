<template>
    <div>
        <div class="main">

            <v-row wrap>
                <v-flex sm12 md3></v-flex>
                <v-flex xs12 sm12 md6 class="box" v-if="singleQuestionShows">

                    <div  style="width: 100%; margin-bottom: 25px">
                        <div style="background-color: #34495e; display: block; position: fixed; z-index: 20; margin-top: -59px; width: 34%; text-align: center"><count-downse :timeCountNow="exam_details.duration"> </count-downse></div>
                    </div>
                    <v-form @submit.prevent="bvonExamQuizzeSubmit" >

                        <v-row wrap  v-for="(singleQuestion, index) in singleQuestionShows" :key="singleQuestion.id">
                            <!--<input type="hidden" name="" ref="question_id[index]" :value="singleQuestion.id">-->
                            <v-flex xs12 style="padding: 1.5rem">
                                <div v-if="singleQuestion.type=== 'boolean'" >
                                    <h2 class="qheading">
                                        <span>{{index+1}}.</span> {{singleQuestion.question_name}} ?
                                    </h2>

                                    <p>
                                        <input
                                                :name="'radio'+index"
                                                type="radio"
                                                style="margin-right: 0.3rem"
                                                v-model="form.option[index]"
                                                :value="singleQuestion.option1"
                                        />
                                        {{singleQuestion.option1}}
                                    </p>

                                    <p>
                                        <input
                                                :name="'radio'+index"
                                                type="radio"
                                                style="margin-right: 0.3rem"
                                                v-model="form.option[index]"
                                                :value="singleQuestion.option2"
                                        />
                                        {{singleQuestion.option2}}
                                    </p>
                                </div>


                                <div v-else-if="singleQuestion.type=== 'mcq'">
                                    <h2 class="qheading" >
                                        <span>{{index+1}} </span> {{singleQuestion.question_name}} ?
                                    </h2>

                                    <p>
                                        <input type="radio" :name="'radio'+index" style="margin-right: 0.3rem" v-model="form.option[index]" :value="singleQuestion.option1" />
                                        {{singleQuestion.option1}}
                                    </p>

                                    <p>
                                        <input type="radio"  :name="'radio'+index" style="margin-right: 0.3rem" v-model="form.option[index]" :value="singleQuestion.option2" />
                                        {{singleQuestion.option2}}
                                    </p>
                                    <p>
                                        <input type="radio"  :name="'radio'+index" style="margin-right: 0.3rem" v-model="form.option[index]" :value="singleQuestion.option3" />
                                        {{singleQuestion.option3}}
                                    </p>

                                    <p>
                                        <input type="radio" :name="'radio'+index" style="margin-right: 0.3rem" v-model="form.option[index]" :value="singleQuestion.option4" />
                                        {{singleQuestion.option4}}
                                    </p>
                                </div>



                                <div v-else-if="singleQuestion.type=== 'written'">
                                    <h2 class="qheading">
                                        <span>{{index+1}}  </span>{{singleQuestion.question_name}} ?
                                    </h2>

                                    <p><input type="text" placeholder="Enter Answer" v-model="form.option[index]"  style="padding: 5px; margin-right: 0.3rem;background-color: white; height: 35px; width: 100%; border:1px solid #000; border-radius: 5px;" /></p>

                                </div>

                                <div>
                                    <p>
                                        <span style="font-weight: 600"> Note:</span> {{singleQuestion.node}}
                                    </p>
                                </div>
                            </v-flex>

                            <v-flex>
                                <div style="margin-left: 1.5rem">
                                    <v-btn dark>Complain</v-btn>
                                </div>
                            </v-flex>


                        </v-row>
                        <v-row>
                            <v-flex xs12 class="button">
                                <div style="margin-right: 1rem">
                                    <v-btn type="submit" dark>Submit</v-btn>
                                </div>
                                <div></div>
                            </v-flex>
                        </v-row>
                    </v-form>


                    <!--<single-attend-quizze-exam v-for="singleQuestion in singleQuestionShows" :key="singleQuestion.id" :singleQuestion="singleQuestion"></single-attend-quizze-exam>-->



                </v-flex>
                <v-flex sm12 md3></v-flex>
            </v-row>
        </div>
    </div>
</template>

<script>
    import  SingleAttendQuizzeExam from './SingleAttendQuizzeExam'
    import  CountDownse from './Countdownse'
    export default {
        name: "AttendQuizzeExam",
        data(){
            return{
                singleQuestionShows:[],
                exam_details:'',
                form:{
                    option:[],
                    exam_id:1,
                }
            }
        },

        methods:{
            bvonExamQuizzeSubmit(){
                this.singleQuestionShows.forEach((item, i) =>{
                    this.form.option[i] = this.form.option[i];

                });
                axios.post('/api/bvon-exam-quizze-submit', this.form)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    })
                    .catch(error => console.log(error.response.error))
            },
            signleQuestions(){
                axios.get('/api/bvon-exam-quizze-single/1')
                    .then(res =>{
                        this.singleQuestionShows = res.data.questions;
                        this.exam_details = res.data.exam;
                        console.log(res.data);
                    })
                    .catch(error =>console.log(error.response.data));
            },

            countDownTimer() {
                if(this.countDown > 0) {
                    setTimeout(() => {
                        this.countDown -= 1;
                        console.log(this.countDown);
                        this.countDownTimer()
                    }, 1000);
                }
            }
        },
        components:{
            SingleAttendQuizzeExam,
            CountDownse
        },
        mounted() {
            this.signleQuestions();
        },
        created() {
            this.countDownTimer();

            EventBus.$on('examFormSubmit', () =>{
                this.bvonExamQuizzeSubmit();
            });

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
