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
                                <th>Name</th>
                                <th>Account</th>
                                <th>Right</th>
                                <th>Wrong</th>
                                <th>Percentage</th>
                                <th>Last Activity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(generalRank, index) in generalQuizzRank" :key="generalRank.id">
                                <td>{{index + 1}}</td>
                                <td>{{generalRank.user.name}}</td>
                                <td>{{generalRank.user.phone}}</td>
                                <td>{{generalRank.right}}</td>
                                <td>{{generalRank.wrong}}</td>
                                <td><span>{{generalRank.ratting}}</span> %</td>
                                <td><vue-moments-ago prefix='' suffix="ago"  :date="generalRank.updated_at" lang="en" /></td>
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
        name:'GeneralQuizzeRank',
        data(){
            return{
                generalQuizzRank:[]
            }
        },
        methods:{

        },
        mounted() {
            axios.get('/api/bvon-general-quizze-rank-show')
                .then(res => {
                    this.generalQuizzRank = res.data;
                    console.log(res.data);
                })
                .catch(error => console.log(error.response.data));
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
