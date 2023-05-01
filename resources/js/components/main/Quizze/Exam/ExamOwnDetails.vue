<template>
    <div>
        <div class="main" style="margin-bottom: 30px;">
            <v-row wrap>
                <v-flex sm12 md3></v-flex>
                <v-flex xs12 sm12 md6 class="box" v-if="singleQuestionShows">

                    <div  style="width: 100%; margin-bottom: 25px">
                        <div style="background-color: #34495e; display: block; position: fixed; z-index: 20; margin-top: -59px; width: 34%; text-align: center"></div>
                    </div>
                        <v-row wrap  v-for="(singleQuestion, index) in singleQuestionShows" :key="singleQuestion.id">
                            <!--<input type="hidden" name="" ref="question_id[index]" :value="singleQuestion.id">-->

                            <v-flex xs12 style="padding: 1.5rem">
                                <div v-if="singleQuestion.types=== 'boolean'" >
                                    <h2 class="qheading">
                                        <span>{{index+1}}.</span> {{singleQuestion.questions.question_name}} ?
                                    </h2>

                                    <p>
                                        <input
                                                :name="'radio'+index"
                                                type="radio"
                                                style="margin-right: 0.3rem"
                                                :value="singleQuestion.questions.option1"
                                        />
                                        {{singleQuestion.questions.option1}}
                                    </p>

                                    <p>
                                        <input
                                                :name="'radio'+index"
                                                type="radio"
                                                style="margin-right: 0.3rem"
                                                :value="singleQuestion.questions.option2"
                                        />
                                        {{singleQuestion.questions.option2}}
                                    </p>
                                </div>


                                <div v-else-if="singleQuestion.types=== 'mcq'">
                                    <h2 class="qheading" >
                                        <span>{{index+1}} </span> {{singleQuestion.questions.question_name}} ?
                                    </h2>

                                    <p>
                                        <input type="radio" :name="'radio'+index" style="margin-right: 0.3rem"  :value="singleQuestion.questions.option1" />
                                        {{singleQuestion.questions.option1}}
                                    </p>

                                    <p>
                                        <input type="radio"  :name="'radio'+index" style="margin-right: 0.3rem"  :value="singleQuestion.questions.option2" />
                                        {{singleQuestion.questions.option2}}
                                    </p>
                                    <p>
                                        <input type="radio"  :name="'radio'+index" style="margin-right: 0.3rem"  :value="singleQuestion.questions.option3" />
                                        {{singleQuestion.questions.option3}}
                                    </p>

                                    <p>
                                        <input type="radio" :name="'radio'+index" style="margin-right: 0.3rem"  :value="singleQuestion.questions.option4" />
                                        {{singleQuestion.questions.option4}}
                                    </p>
                                </div>



                                <div v-else-if="singleQuestion.types=== 'written'">
                                    <h2 class="qheading">
                                        <span>{{index+1}}  </span>{{singleQuestion.questions.question_name}} ?
                                    </h2>

                                    <p><input type="text" placeholder="Enter Answer" :value="singleQuestion.answers" style="padding: 5px; margin-right: 0.3rem;background-color: white; height: 35px; width: 100%; border:1px solid #000; border-radius: 5px;" /></p>

                                </div>


                                <div>
                                    <p>
                                        <span style="font-weight: 600"> My Ans:</span> {{singleQuestion.answers}}
                                    </p>
                                </div>

                                <div>
                                    <p>
                                        <span style="font-weight: 600"> Right Ans:</span> {{singleQuestion.right_answers}}
                                    </p>
                                </div>

                                <div>
                                    <p>
                                        <span style="font-weight: 600"> Note:</span> {{singleQuestion.questions.node}}
                                    </p>
                                </div>
                            </v-flex>

                            <v-flex>
                                <div style="margin-left: 1.5rem;">
                                    <v-btn dark>Complain</v-btn>
                                </div>
                            </v-flex>

                        </v-row>

                </v-flex>
                <v-flex sm12 md3></v-flex>
            </v-row>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExamOwnDetails",
        data(){
            return{
                singleQuestionShows:[],
            }
        },
        created() {
            axios.get(`/api/bvon-exam-quizze-own-details/${this.$route.params.id}`)
                .then(res => {
                    this.singleQuestionShows = res.data;
                    console.log( this.singleQuestionShows);

                })
                .catch(error => console.log(error.response.data));
        }
    }
</script>

<style scoped>

</style>