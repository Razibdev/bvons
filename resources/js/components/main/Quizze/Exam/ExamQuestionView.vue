<template>
    <div class="container">
        <div style="background-color: #00e676; padding: 0.5rem">
            <h3>View Quizze Exam Question</h3>
        </div>
        <div>
            <div class="ranktable">
                <template>
                    <v-simple-table>
                        <template>
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Question Title</th>
                                <th>Option1</th>
                                <th>Option2</th>
                                <th>Option3</th>
                                <th>Option4 </th>
                                <th>Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(examQuestion, index) in getallExamQuestion" :key="examQuestion.id">
                                <td>{{index + 1}}</td>
                                <td>{{examQuestion.question_name}}</td>
                                <td>{{examQuestion.option1}}</td>
                                <td>{{examQuestion.option2}}</td>
                                <td>{{examQuestion.option3}}</td>
                                <td>{{examQuestion.option4}}</td>
                                <td>{{examQuestion.answer}}</td>

                            </tr>

                            </tbody>
                        </template>
                    </v-simple-table>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'QuizzeExamRank',
        data(){
            return{
                getallExamQuestion:[],
                exam_id:1
            }
        },
        methods:{


        },
        created(){
            axios.get(`/api/bvon-exam-quizze-all-question/${this.$route.params.id}`)
                .then(res => {
                    this.getallExamQuestion = res.data;
                    console.log( this.getallExamQuestion);
                    // this.examQuizzRank.forEach(item =>{
                    //     console.log(item.exam.exam_title);
                    // })
                })
                .catch(error => console.log(error.response.data));
        },
        mounted() {

        }
    }
</script>

<style lang="scss" scoped>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");

    .container {
        font-family: "Inter", sans-serif;
        width: 1200px;
        max-width: 100%;
        margin: 0 auto;
        border: solid 1px rgb(218, 218, 218);
    }
</style>
