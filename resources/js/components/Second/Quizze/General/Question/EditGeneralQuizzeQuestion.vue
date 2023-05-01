<template>
    <section>
        <div class="heading">
            <h3>Quize Qusetion</h3>
        </div>

        <div class="childheading">
            <h3>Quize Question Edit</h3>
        </div>
        <div class="main">

            <div>
                <p><v-icon style="color: rgba(0, 0, 0, 0.54)">mdi-subtitles-outline</v-icon> Question Title</p>
            </div>

            <div>

                <v-form @submit.prevent="addQuestionSubmit" method="post">
                    <v-row>
                        <v-col class="selectinput" cols="12" md="12">
                            <v-text-field label="Enter Question Name"  v-model="form.question_title" solo></v-text-field>
                        </v-col>

                        <v-row style="padding-left: 10px;  padding-right: 10px;"  v-if="showSingleQuestion.type === 'mcq'">
                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option One" v-model="form.answer_option1" solo></v-text-field>
                            </v-col>

                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option Two" solo  v-model="form.answer_option2"></v-text-field>
                            </v-col>

                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option Three" solo  v-model="form.answer_option3"></v-text-field>
                            </v-col>

                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option Four" solo  v-model="form.answer_option4"></v-text-field>

                            </v-col>
                        </v-row>




                        <v-row style="padding-left: 10px; padding-right: 10px;" v-if="showSingleQuestion.type === 'boolean'">
                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option One" v-model="form.answer_option1" solo></v-text-field>
                            </v-col>

                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option Two" v-model="form.answer_option2" solo></v-text-field>

                            </v-col>
                        </v-row>

                        <v-row style="padding-left: 10px;  padding-right: 10px;" v-if="showSingleQuestion.type === 'written'">
                            <v-col class="selectinput" cols="12" md="12">
                                <v-text-field label="Enter Option One" v-model="form.answer_option1" solo></v-text-field>
                            </v-col>
                        </v-row>



                        <v-col class="selectinput" cols="12" md="12">
                            <v-text-field v-model="form.right_answer" label="Enter Right Answer" solo></v-text-field>
                        </v-col>

                        <v-col class="selectinput" cols="12" md="12">
                            <v-text-field
                                    v-model="form.duration"
                                    label="Enter Duration (Optional)"
                                    solo
                            ></v-text-field>
                        </v-col>

                        <v-col class="selectinput" cols="12" md="12">
                            <v-text-field v-model="form.node" label="Enter Node (Optional)" solo></v-text-field>
                        </v-col>
                    </v-row>
                    <v-btn class="btn submit" type="submit">Submit</v-btn>
                </v-form>

            </div>
        </div>


    </section>
</template>

<script>
    export default {
        data: () => ({
            valid: false,
            showBoolean:false,
            showMcq:true,
            showWritten:false,
            form:{
                question_title:null,
                answer_option1:null,
                answer_option2:null,
                answer_option3:null,
                answer_option4:null,
                right_answer:null,
                duration:null,
                node:null,
                type:null,
            },
            showSingleQuestion:null


        }),

        methods:{

            addQuestionSubmit(){

                axios.post(`/api/dealer/account-edit-bvon-edit-quizze-question/${this.$route.params.id}`, this.form)
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
                    .catch(error => console.log(error.response.data));

            }
        },

        mounted(){
            axios.get(`/api/dealer/account-view-bvon-general-single-quizze-questions/${this.$route.params.id}`)
                .then(res => {
                    this.showSingleQuestion = res.data;
                    this.form.question_title = res.data.question_name;
                    this.form.answer_option1 = res.data.option1;
                    this.form.answer_option2 = res.data.option2;
                    this.form.answer_option3 = res.data.option3;
                    this.form.answer_option4 = res.data.option4;
                    this.form.right_answer = res.data.answer;
                    this.form.duration = res.data.duration;
                    this.form.node = res.data.node;

                })
                .catch(error => console.log(error.response.data));
            console.log(this.$route.params.id);
            console.log(this.$route.params.examId);

        }
    };
</script>
<style lang="scss" scoped>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");
    .heading {
        font-family: "Inter", sans-serif;
        font-weight: 400;
        width: 1100px;
        max-width: 100%;
        margin: 0 auto;
        padding: 1rem 0rem;
    }
    .childheading {
        font-family: "Inter", sans-serif;
        font-weight: 400;
        width: 1100px;
        max-width: 100%;
        background-color: rgba(241, 241, 241, 0.637);
        margin: 0 auto;
        padding: 1rem 1rem 0.5rem 1rem;
    }
    .main {
        font-family: "Inter", sans-serif;
        width: 1100px;
        max-width: 100%;
        margin: 0 auto;
        background-color: #fafafa;
        padding: 0.5rem 1rem 1rem 1rem;
    }
    .btn.submit{
        background-color: #21db6e !important;
        color: #ffffff;

    }
    .btn:hover {
        color: #ffffff;
        background-color: #00c853;
    }
    .actives{
        color: #ffffff;
        background-color: #00c853 !important;
    }
</style>

<style lang="sass">
    .selectinput
        padding-top:0 !important
        margin-top:0 !important
        .v-input__control
            .v-text-field__details
                display: none !important
</style>
