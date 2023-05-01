<template>
    <section>
        <div class="heading">
            <h3>Quize Qusetion</h3>
        </div>

        <div class="childheading">
            <h3>Quize Question Add</h3>
        </div>
        <div class="main">
            <div style="display: flex; margin-bottom: 1.2rem; margin-top: 0">

                <div style="margin-right: 0.7rem"><v-btn class="btn" :class="{'actives':showMcq}" @click="clickAddQuestion('mcq')"   >MCQ</v-btn></div>
                <div style="margin-right: 0.7rem">
                    <v-btn class="btn" :class="{'actives':showBoolean}" @click="clickAddQuestion('boolean')" >Boolean</v-btn>
                </div>
                <div><v-btn class="btn" :class="{'actives':showWritten}" @click="clickAddQuestion('written')" >Written</v-btn></div>

            </div>

            <div>
                <p><v-icon style="color: rgba(0, 0, 0, 0.54)">mdi-subtitles-outline</v-icon> Question Title</p>
            </div>

            <div>

                <v-form @submit.prevent="addQuestionSubmit" method="post">
                    <v-row>
                        <v-col class="selectinput" cols="12" md="12">
                            <v-text-field label="Enter Question Name"  v-model="form.question_title" solo></v-text-field>
                        </v-col>

                        <v-row style="padding-left: 10px;  padding-right: 10px;"  v-if="showMcq">
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




                        <v-row style="padding-left: 10px; padding-right: 10px;" v-if="showBoolean">
                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option One" v-model="form.answer_option1" solo></v-text-field>
                            </v-col>

                            <v-col class="selectinput" cols="12" md="6">
                                <v-text-field label="Enter Option Two" v-model="form.answer_option2" solo></v-text-field>

                            </v-col>
                        </v-row>

                        <v-row style="padding-left: 10px;  padding-right: 10px;" v-if="showWritten">
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
        name:'AddGeneralQuestion',
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
                exam_id: null
            }


        }),

        methods:{
            clickAddQuestion(param){
                if(param === 'mcq'){
                    this.showMcq = true;
                    this.showWritten = false;
                    this.showBoolean = false;

                }else if(param === 'boolean'){
                    this.showBoolean = true;
                    this.showMcq = false;
                    this.showWritten = false;
                    this.form.answer_option3 = null;
                    this.form.answer_option4 = null;
                    this.form.right_answer = null;

                }else if(param === 'written'){
                    this.showWritten = true;
                    this.showBoolean = false;
                    this.showMcq = false;
                    this.form.answer_option2 = null;
                    this.form.answer_option3 = null;
                    this.form.answer_option4 = null;
                    this.form.right_answer = null;

                }
            },


            addQuestionSubmit(){
                if(this.showMcq){
                    this.form.type = 'mcq';
                }else if(this.showBoolean){
                    this.form.type = 'boolean';
                }else if(this.showWritten){
                    this.form.type = 'written';

                }
                // this.form.exam_id = this.$route.params.id;
                // console.log(this.form);

                axios.post('/api/bvon-quizze/add-general-quizze-question', this.form)
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
