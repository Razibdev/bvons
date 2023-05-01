<template>
    <div>
        <v-form @submit.prevent="generalQuizzeSubmit">
            <v-row wrap v-if="singleQuestionShow">
                <v-flex xs12 style="padding: 1.5rem">

                    <div v-if="singleQuestionShow.type=== 'boolean'" >
                        <h2 class="qheading">
                            <span>1. </span> {{singleQuestionShow.question_name}} ?
                        </h2>

                        <p>
                            <input
                                    name="radio"
                                    type="radio"
                                    style="margin-right: 0.3rem"
                                    v-model="form.option1"
                                    :value="singleQuestionShow.option1"
                            />
                            {{singleQuestionShow.option1}}
                        </p>

                        <p>
                            <input
                                    name="radio"
                                    type="radio"
                                    style="margin-right: 0.3rem"
                                    v-model="form.option2"
                                    :value="singleQuestionShow.option2"
                            />
                            {{singleQuestionShow.option2}}
                        </p>
                    </div>




                    <div v-else-if="singleQuestionShow.type=== 'mcq'">
                        <h2 class="qheading" >
                            <span>1. </span> {{singleQuestionShow.question_name}} ?
                        </h2>

                        <p>
                            <input type="radio" name="radio" style="margin-right: 0.3rem" v-model="form.option1" :value="singleQuestionShow.option1" />
                            {{singleQuestionShow.option1}}
                        </p>

                        <p>
                            <input type="radio" name="radio" style="margin-right: 0.3rem" v-model="form.option2" :value="singleQuestionShow.option2" />
                            {{singleQuestionShow.option2}}
                        </p>
                        <p>
                            <input type="radio" name="radio" style="margin-right: 0.3rem" v-model="form.option3" :value="singleQuestionShow.option3" />
                            {{singleQuestionShow.option3}}
                        </p>

                        <p>
                            <input type="radio" name="radio" style="margin-right: 0.3rem" v-model="form.option4" :value="singleQuestionShow.option4" />
                            {{singleQuestionShow.option4}}
                        </p>
                    </div>



                    <div v-else-if="singleQuestionShow.type=== 'written'">
                        <h2 class="qheading">
                            <span>1. </span>{{singleQuestionShow.question_name}} ?
                        </h2>

                        <p><input type="text" placeholder="Enter Answer" v-model="form.option1"  style="padding: 5px; margin-right: 0.3rem;background-color: white; height: 35px; width: 100%; border:1px solid #000; border-radius: 5px;" /></p>

                    </div>

                    <div>
                        <p>
                            <span style="font-weight: 600"> Note:</span> {{singleQuestionShow.node}}
                        </p>
                    </div>
                </v-flex>


                <v-flex xs12 class="button">
                    <div style="margin-right: 1rem">
                        <v-btn dark>Complain</v-btn>
                        <v-btn type="submit" dark>Submit</v-btn>
                    </div>
                    <div></div>
                </v-flex>



            </v-row>
        </v-form>
    </div>
</template>

<script>
    export default {
        name: "SingleAttendQuizzeExam",
        props:['singleQuestionShow'],
        data(){
            return{
                form:{
                    option1:null,
                    option2:null,
                    option3:null,
                    option4:null,
                    question_title:null,
                    id:null,
                    answer:null,
                    type:null,
                }
            }
        }
    }
</script>

<style scoped>
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
</style>