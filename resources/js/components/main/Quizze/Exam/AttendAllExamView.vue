<template>
    <div class="container">
        <div style="background-color: #00e676; padding: 0.5rem">
            <h3>View Quiz Ranking</h3>
        </div>
        <div>
            <div class="ranktable">
                <template>
                    <v-simple-table>
                        <template>
                            <thead>
                            <tr>
                                <th>Rank ID</th>
                                <th>Subject</th>
                                <th>Exam Date</th>
                                <th>Examine</th>
                                <th>Question</th>
                                <th>Own Details</th>
                                <th>Ranking</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(attendExamView, index) in getallExamQuizze" :key="attendExamView.id">
                                <td>{{index + 1}}</td>
                                <td>{{attendExamView.exam.exam_title}}</td>
                                <td>{{attendExamView.attend_date}}</td>
                                <td>{{attendExamView.user_count}}</td>
                                <td><router-link :to="getExamAllQuestion(attendExamView.exam_id)">View Question</router-link></td>
                                <td><router-link :to="getOwnDetails(attendExamView.exam_id)">Own details</router-link></td>
                                <td><router-link :to="getExamRankUrl(attendExamView.exam_id)">Ranking</router-link></td>
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
                getallExamQuizze:[],
                exam_id:1
            }
        },
        methods:{

            getExamAllQuestion(id){
                return '/bvon-exam-quizze-all-question/'+id;
            },

            getOwnDetails(id){
                return '/bvon-exam-quizze-own-details/'+id;
            },

            getExamRankUrl(id){
                return '/bvon-exam-quizze-rank-show/'+id;
            },

        },
        created(){
            axios.get('/api/bvon-attend-all-quizze-exam/')
                .then(res => {
                    this.getallExamQuizze = res.data;
                    console.log( this.getallExamQuizze);
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
