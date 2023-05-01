<template>
    <div>
        <v-card
                class="mx-auto"
                max-width="100%"
                outlined
                style=" padding:15px; background-color: rgb(111 60 199) !important;"
                :class="[{'computer-view-quizze': inwidth}, {'mobile-view-quizze': showNavbar}]"
        >
            <v-form @submit.prevent="addQuizzeQuestion" method="post">
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
                                <date-picker v-model="form.exam_date" :value="form.exam_date" />
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





                    <!--<v-col-->
                            <!--cols="12"-->
                            <!--sm="12"-->
                            <!--md="12"-->
                    <!--&gt;-->
                        <!--<v-layout row>-->
                            <!--<v-col-->
                                    <!--cols="12"-->
                                    <!--sm="12"-->
                                    <!--md="6"-->
                            <!--&gt;-->
                                <!--<h5 class="exam-text-color" >Start:</h5>-->
                                <!--<v-time-picker-->
                                        <!--v-model="form.exam_start"-->
                                        <!--:max="form.exam_end"-->
                                <!--&gt;</v-time-picker>-->
                            <!--</v-col>-->


                            <!--<v-col-->
                                    <!--cols="12"-->
                                    <!--sm="12"-->
                                    <!--md="6"-->
                            <!--&gt;-->
                                <!--<h5 class="exam-text-color">End:</h5>-->
                                <!--<v-time-picker-->
                                        <!--v-model="form.exam_end"-->
                                        <!--:min="form.exam_start"-->
                                <!--&gt;</v-time-picker>-->
                            <!--</v-col>-->
                        <!--</v-layout>-->

                    <!--</v-col>-->

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


    export default {
        data: () => ({
            form:{
                exam_title:null,
                exam_date:null,
                exam_duration:null,
                exam_start:null,
                exam_end:null,
                exam_free:null,
            },
            inwidth:false,
            showNavbar:false
        }),

        methods:{
            addQuizzeQuestion(){
                // console.log(this.form)
                this.form.exam_date = this.form.exam_date.toLocaleDateString();
                this.form.exam_start = this.form.exam_start.toLocaleTimeString();
                this.form.exam_end = this.form.exam_end.toLocaleTimeString();

                axios.post('/api/bvon-quizze/add-quizze-exam', this.form)
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
