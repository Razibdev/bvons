<template>
    <div>
        <v-card
                class="mx-auto"
                max-width="100%"
                outlined
                style=" padding:15px; background-color: rgb(111 60 199) !important;"
                :class="[{'computer-view-quizze': inwidth}, {'mobile-view-quizze': showNavbar}]"
        >
            <v-form @submit.prevent="editQuizzeQuestion()" method="post">
                <v-layout row wrap>
                    <v-flex xs12 sm12 md2></v-flex>
                    <v-flex xs12 sm12 md6>
                        <v-col
                                cols="12"
                                sm="12"
                                md="12"
                        >
                            <h5 class="exam-text-color">Enter Exam Title:</h5>
                            <v-text-field
                                    class="add-quizze-exam"
                                    placeholder="Enter Exam Title"
                                    solo
                                    v-model="form.exam_title"
                            ></v-text-field>
                        </v-col>

                        <v-col
                                cols="12"
                                sm="12"
                                md="12"
                        >
                            <h5 class="exam-text-color">Enter Exam Date:</h5>
                            <v-text-field v-model="form.exam_date"
                                          solo
                                          class="add-quizze-exam"
                                          placeholder="Enter Exam Date"
                            >
                                <template v-slot:append-outer >
                                    <date-pickers v-model="form.exam_date" />
                                </template>
                            </v-text-field>
                        </v-col>


                        <v-col
                                cols="12"
                                sm="12"
                                md="12"
                        >
                            <h5 class="exam-text-color">Enter Exam Duration:</h5>
                            <v-text-field
                                    class="add-quizze-exam"
                                    placeholder="Enter Exam Duration"
                                    solo
                                    v-model="form.exam_duration"
                            ></v-text-field>
                        </v-col>


                        <v-col
                                cols="12"
                                sm="12"
                                md="12"
                        >
                            <h5 class="exam-text-color">Enter Exam Free:</h5>
                            <v-text-field
                                    class="add-quizze-exam"
                                    placeholder="Enter Exam Free"
                                    solo
                                    v-model="form.exam_free"
                            ></v-text-field>
                        </v-col>





                        <v-col
                                cols="12"
                                sm="12"
                                md="12"
                        >
                            <h5 class="exam-text-color">Start: </h5>
                            <v-text-field
                                    class="add-quizze-exam"
                                    placeholder="Enter Exam Free"
                                    solo
                                    type="time"
                                    v-model="form.exam_start"
                            ></v-text-field>
                        </v-col>

                        <v-col
                                cols="12"
                                sm="12"
                                md="12"
                        >
                            <h5 class="exam-text-color">End: </h5>
                            <v-text-field
                                    class="add-quizze-exam"
                                    placeholder="Enter Exam Free"
                                    solo
                                    type="time"
                                    v-model="form.exam_end"
                            ></v-text-field>
                        </v-col>

                        <v-col
                                cols="12"
                                sm="12"
                                md="12"

                        >

                            <v-btn type="submit"
                                   depressed
                                   color="primary"
                                   style="float: right;"
                            >Submit</v-btn>

                        </v-col>



                    </v-flex>
                    <v-flex xs12 sm12 md4></v-flex>

                </v-layout>
            </v-form>
        </v-card>

    </div>

</template>
<script>

    import moment from "moment";


    export default {
        name: 'EditExam',
        data: () => ({
            moment: moment,
            form:{
                exam_title:null,
                exam_date:null,
                exam_duration:null,
                exam_start:null,
                exam_end:null,
                exam_free:null,
            },
            id:null,
            inwidth:false,
            showNavbar:false,
        }),

        methods:{
            editQuizzeQuestion(){

                // this.form.exam_date = this.form.exam_date.toLocaleDateString();
                // this.form.exam_start = this.form.exam_start.toLocaleTimeString();
                // this.form.exam_end = this.form.exam_end.toLocaleTimeString();


                axios.post(`/api/bvon-quizze/edit-quizze-exam/${this.id}`, this.form)
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
        created() {

            if (window.innerWidth >= 500){
                this.inwidth = true
            }

            if ( window.innerWidth <= 500){
                this.showNavbar = true
            }


        },
        beforeMount(){
            axios.get(`/api/bvon-quizze/get-single-quizze-exam/${this.$route.params.id}`)
                .then(res =>{
                    this.form.exam_title = res.data.exam_title;
                    this.form.exam_duration   = res.data.duration;
                    this.form.exam_date  = this.moment(res.data.exam_date).format("YYYY-MM-DD") ;
                    this.form.exam_free  = res.data.exam_free;
                    console.log(this.form.exam_free);
                    this.id = res.data.id;

                })
                .catch(error => console.log(error.response.data));
        },
        mounted() {

        }
    }

</script>

<style lang="scss" scoped>
    .mobile-view-quizze{
        height: 100%;
    }
    .computer-view-quizze{
        height: 96vh;
    }
    .exam-text-color{
        color: #fff;
    }
</style>
<style lang="sass">
    .add-quizze-exam
        .v-text-field__details
            display: none !important
</style>
