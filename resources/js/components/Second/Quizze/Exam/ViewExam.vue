<template>
    <div>
        <v-card
                class="mx-auto"
                max-width="100%"
                outlined
                style=" padding:15px; background-color: rgb(111 60 199) !important;"
                :class="[{'computer-view-quizze': inwidth}, {'mobile-view-quizze': showNavbar}]"
        >
            <v-card>
                <v-card-title>
                    <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            placeholder="Search....."
                            label="Search"
                            single-line
                            hide-details
                    ></v-text-field>
                </v-card-title>
            </v-card>

            <v-data-table
                    mobile-breakpoint="0"
                    :headers="headers"
                    :items="examView"
                    :search="search"
                    class="elevation-1"
            >
                <template #item="{ item }">
                    <tr>
                        <td>{{ item.id }}</td>
                        <td>{{ item.exam_title }}</td>
                        <td>
                           {{item.duration}}
                        </td>
                        <td>{{ new Date(item.exam_date).toLocaleDateString() }}</td>
                        <td>{{ new Date(item.start_time).toLocaleTimeString() }}</td>
                        <td>{{ new Date(item.end_time).toLocaleTimeString() }}</td>
                        <td>{{item.exam_free}}</td>
                        <td><router-link :to="addExamQuestionlink(item.id)">Add Question</router-link>
                            <br> <router-link :to="viewExamQuestionlink(item.id)">View Question</router-link></td>
                        <td style="text-align: center">
                            <router-link :to="editExamQuestionlink(item.id)"  ><v-btn class="exam-action">Edit Exam</v-btn> </router-link>
                            <br><v-btn @click="deleteExamQuestionlink(item.id)" class="exam-action-danger" >Delete</v-btn>
                        </td>

                    </tr>
                </template>
            </v-data-table>
        </v-card>


    </div>
</template>

<script>
    export default {
        name: "ViewExam",
        data(){
            return{
                search:'',
                headers: [
                    {
                        text: '#',
                        align: 'start',
                        value: 'id',
                    },
                    {
                        text: 'Exam Title',
                        value: 'exam_title',
                    },
                    { text: 'Exam Duration',
                        value: 'duration',

                    },
                    {
                        text: 'Exam Date',
                        value: 'exam_date'
                    },

                    {
                        text: 'Start Time',
                        value: 'start_time'
                    },

                    {
                        text: 'End Time',
                        value: 'end_time'
                    },
                    {
                        text: 'Exam Free',
                        value: 'exam_free'
                    },


                    {
                        text: 'Question',
                        value: 'question'
                    },

                    {
                        text: 'ACTION',
                        value:'action'
                    }

                ],
                examView:[],
                inwidth:false,
                showNavbar:false
            }
        },
        methods:{
            addExamQuestionlink(id) {
                return "/dealer/account-add-bvon-quizze-exam-question/"+id;
            },

            viewExamQuestionlink(id) {
                return "/dealer/account-view-bvon-quizze-exam-question/"+id;
            },

            editExamQuestionlink(id){
                return "/dealer/account-edit-bvon-quizze-exam/"+id;
            },

            deleteExamQuestionlink(id){
                // this.examView.splice(id, 1);
                this.examView = this.examView.filter((e)=>e.id !== id );
                axios.get(`/api/dealer/account-delete-bvon-quizze-exam/${id}`)
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
                    .catch(error =>console.log(error.response.data));
            }

        },
        created() {
            axios.get('/api/bvon-quizze/view-quizze-exam')
                .then(res => {
                    this.examView = res.data;
                    console.log(res.data);
                })
                .catch(error => console.log(error.response.data));

            if (window.innerWidth >= 500){
                this.inwidth = true
            }

            if ( window.innerWidth <= 500){
                this.showNavbar = true
            }
        }
    }
</script>

<style scoped>
.exam-action{
    margin: 5px 0;
    background-color: #0E9A00 !important;
    color: #fff;
}
    .exam-action-danger{
        margin: 5px 0;
        background-color: #dc3545 !important;
        color: #fff;
    }
</style>