<template>
    <div>
    <v-layout row wrap>
        <v-flex  xs12 sm12 md12>
            <div class="heroBlock" >
                <!--<v-carousel :show-arrows="true"  show-arrows-on-hover hide-delimiters interval="10000">-->
                    <!--<v-carousel-item-->
                            <!--v-for="(item,i) in items"-->
                            <!--:key="i"-->
                            <!--:src="item.src"-->
                            <!--reverse-transition="fade-transition"-->
                            <!--transition="fade-transition"-->
                    <!--&gt;</v-carousel-item>-->
                <!--</v-carousel>-->
                <img src="frontend/image/doctor_image.jpg" alt="">
            </div>

        </v-flex>
    </v-layout>
    </div>
</template>

<script>

    export  default {
        data(){
            return{
                items: [
                    {
                        src: 'frontend/image/doctor_image.jpg',
                    },
                    {
                        src: 'frontend/image/doctor_image.jpg',
                    },
                    {
                        src: 'frontend/image/doctor_image.jpg',
                    },

                    {
                        src: 'frontend/image/doctor_image.jpg',
                    },

                    {
                        src: 'frontend/image/doctor_image.jpg',
                    },
                ]
            }
        }
    }
</script>
<style lang="scss" scoped>

    .heroBlock {
        position: relative;
        margin-top: -4px !important;
        height: 500px;
        width: 100%;
        overflow: hidden;
        img {
            width: 100%;
            height: 500px;


        }
        .v-window {
            @media only screen and (max-width: 599px) {
                height: 220px !important;
            }
        }

        .v-image__image {
            &:before {
                content: '';
                background: rgba(0, 0, 0, 0.3);
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1;
            }
        }

        .title {
            color: #fff;
            position: relative;
            z-index: 2;
        }
    }

    // latest post block
    .latestPostBlock {
        background: darken(#fff, 2%);

        .v-card__title {
            background: rgba(0,0,0,0.3);
        }
    }


    @media only screen and (max-width: 599px) {
        .heroBlock{
            height: 220px !important;
            img {
                height: 220px !important;
            }
        }
    }
</style>

<style lang="sass">
  .heroBlock
   .v-window__next
    float: right !important
    right: 0 !important
    cursor: pointer
   .v-window__prev
    float: left !important
    left: 0 !important
    cursor: pointer
</style>