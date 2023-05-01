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
                    :items="generalQuestionView"
                    :search="search"
                    class="elevation-1"
            >
                <template #item="{ item }">
                    <tr>
                        <td>{{ item.id }}</td>
                        <td>
                            {{item.question_name}}
                        </td>
                        <td>{{item.option1}}</td>
                        <td>{{item.option2}}</td>
                        <td>{{item.option3}}</td>
                        <td>{{item.option4}}</td>
                        <td>{{item.answer}}</td>
                        <td>{{item.type}}</td>
                        <td>{{item.duration}}</td>
                        <td>{{item.node}}</td>
                        <td><router-link :to="editGeneralQuestionlink(item.id)">Edit Question</router-link>
                            <br><v-btn @click="deleteGeneralQuizzeQuestionlink(item.id)" class="exam-action-danger" >Delete</v-btn></td>

                    </tr>
                </template>
            </v-data-table>
        </v-card>


    </div>
</template>

<script>
    export default {
        name: "ViewQuizzeQuestion",
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
                        text: 'Question Title',
                        value: 'question_name',
                    },
                    { text: 'Option 1',
                        value: 'option1',

                    },

                    { text: 'Option 2',
                        value: 'option1',

                    },

                    { text: 'Option 3',
                        value: 'option1',

                    },

                    { text: 'Option 4',
                        value: 'option1',

                    },

                    {
                        text: 'Right Answer',
                        value: 'answer'
                    },

                    {
                        text: 'Type',
                        value: 'type'
                    },

                    {
                        text: 'Duration',
                        value: 'duration'
                    },

                    {
                        text: 'Node',
                        value: 'node'
                    },

                    {
                        text: 'ACTION',
                        value:'action'
                    }

                ],
                generalQuestionView:[],
                inwidth:false,
                showNavbar:false
            }
        },
        methods:{
            editGeneralQuestionlink(id){
                return "/dealer/account-edit-bvon-edit-quizze-question/"+id;
            },

            deleteGeneralQuizzeQuestionlink(id){
                this.generalQuestionView = this.generalQuestionView.filter((e)=>e.id !== id );
                axios.get(`/api/dealer/account-delete-bvon-general-quizze-question/${id}`)
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
            axios.get(`/api/dealer/account-view-bvon-general-quizze-questions/`)
                .then(res => {
                    this.generalQuestionView = res.data;
                    console.log(res.data)
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



