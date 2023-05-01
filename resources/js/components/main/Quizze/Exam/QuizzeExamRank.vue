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
                                <th>Exam Name</th>
                                <th>Name</th>
                                <th>Account</th>
                                <th>Right</th>
                                <th>Wrong</th>
                                <th>Percentage</th>
                                <th>Last Activity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(examRank, index) in examQuizzRank" :key="examRank.id">
                                <td>{{index + 1}}</td>
                                <td>{{examRank.exam.exam_title}}</td>
                                <td>{{examRank.user.name}}</td>
                                <td>{{examRank.user.phone}}</td>
                                <td>{{examRank.right}}</td>
                                <td>{{examRank.wrong}}</td>
                                <td><span>{{examRank.ratting}}</span> %</td>
                                <td><vue-moments-ago prefix='' suffix="ago"  :date="examRank.updated_at" lang="en" /></td>
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
                examQuizzRank:[],
                exam_id:1
            }
        },
        methods:{

        },
        created(){
            axios.get(`/api/bvon-exam-quizze-rank-show/${this.exam_id}`)
                .then(res => {
                    this.examQuizzRank = res.data;
                    console.log( this.examQuizzRank);
                    this.examQuizzRank.forEach(item =>{
                        console.log(item.exam.exam_title);
                    })
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
