<template>
    <div>
        <v-layout row wrap>


            <v-flex xs4 md3>
                <v-card
                        class="mx-auto about-single-info"
                        max-width="100%"
                        outlined
                >

                    <v-icon class="about-signle-info-icon">mdi-account</v-icon>
                    <h5 class="about-single-info-title">Known as</h5>
                    <h5>Kamal Hossain Durjoy</h5>
                </v-card>
            </v-flex>

            <v-flex xs4 md3>
                <v-card
                        class="mx-auto about-single-info"
                        max-width="100%"
                        outlined
                >

                    <v-icon class="about-signle-info-icon">mdi-briefcase-outline</v-icon>
                    <h5 class="about-single-info-title">Work as</h5>
                    <h5>Entrepreneur</h5>
                </v-card>
            </v-flex>

            <v-flex xs4 md3>
                <v-card
                        class="mx-auto about-single-info"
                        max-width="100%"
                        outlined
                >

                    <v-icon class="about-signle-info-icon">mdi-cake-variant-outline</v-icon>
                    <h5 class="about-single-info-title">Birthday</h5>
                    <h5>1993-12-16</h5>
                </v-card>
            </v-flex>


            <v-flex xs4 md3>
                <v-card
                        class="mx-auto about-single-info"
                        max-width="100%"
                        outlined
                >

                    <v-icon class="about-signle-info-icon">mdi-human-non-binary</v-icon>
                    <h5 class="about-single-info-title">Gender</h5>
                    <h5>Male</h5>
                </v-card>
            </v-flex>


            <v-flex xs4 md3>
                <v-card
                        class="mx-auto about-single-info"
                        max-width="100%"
                        outlined
                >

                    <v-icon class="about-signle-info-icon">mdi-earth</v-icon>
                    <h5 class="about-single-info-title">Follows</h5>
                    <h5>Islam</h5>
                </v-card>
            </v-flex>


            <v-flex xs4 md3>
                <v-card
                        class="mx-auto about-single-info"
                        max-width="100%"
                        outlined
                >

                    <v-icon class="about-signle-info-icon">mdi-home-city</v-icon>
                    <h5 class="about-single-info-title">Lives In</h5>
                    <h5>Uttara Dhaka</h5>
                </v-card>
            </v-flex>


            <v-flex xs4 md3>
                <v-card
                        class="mx-auto about-single-info"
                        max-width="100%"
                        outlined
                >

                    <v-icon class="about-signle-info-icon">mdi-home-variant</v-icon>
                    <h5 class="about-single-info-title">Home Town</h5>
                    <h5>Uttara Dhaka</h5>
                </v-card>
            </v-flex>


        </v-layout>

        <v-layout row wrap class="second-main-wrapper">
            <v-flex xs12 md6>
                <div class="second-single-wrap">
                <v-text-field
                        label="Registration Number"
                        solo
                ></v-text-field>
                </div>
            </v-flex>

            <v-flex xs12 md6 >
                <div class="second-single-wrap">
                <v-text-field
                        label="Roll Number"
                        solo
                ></v-text-field>
                </div>
            </v-flex>

            <v-flex xs12 md6>
                <div class="second-single-wrap">
                <v-text-field
                        label="Email"
                        solo
                ></v-text-field>
                </div>
            </v-flex>

            <v-flex xs12 md6 >
                <div class="second-single-wrap">
                <v-select
                        :items="items"
                        label="Department"
                        solo
                ></v-select>
                </div>
            </v-flex>
            <v-flex xs12 md6 >
                <div class="second-single-wrap">
                <v-select
                        :items="items"
                        label="Passing Year"
                        solo
                ></v-select>
                </div>
            </v-flex>
            <v-flex xs12 md6 >
                <div class="second-single-wrap">
                <v-select
                        :items="items"
                        label="Division"
                        solo
                ></v-select>
                </div>
            </v-flex>

            <v-flex xs12 md6>
                <div class="second-single-wrap">
                <v-btn block>
                    Update SSC Information
                </v-btn>
                </div>
            </v-flex>


            <v-flex xs12 md6>
                <div class="second-single-wrap">
                <v-btn block>
                    Update All Information
                </v-btn>
                </div>
            </v-flex>


        </v-layout>
    </div>
</template>

<script>
    export default {
        name: "About.vue",
        data: () => ({
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
        }),
    }
</script>

<style lang="scss" scoped>
    .about-single-info{
        padding: 5px 0;
        text-align: center;
        margin: 5px 5px 0 0 !important;
        box-shadow: 2px 2px 2px #dddddd;
        .about-signle-info-icon{
            color: #232F3E;
        }
        .about-single-info-title{
            font-weight: 600;
            padding: 5px 0;
        }
    }


    .second-main-wrapper{
        margin: 30px 0;

        .second-single-wrap{
            margin-right: 5px;
        }
    }
    
</style>