<template>
    <v-layout row wrap>
        <v-flex xs12 sm12 md12>
            <v-footer
                    dark
            >

               <v-layout row wrap class="main-wrapper-footer">
                   <v-flex xs12 md3 class="single-footer">
                       <h2 class="h1">Download</h2>
                       <img src="https://www.bitcomet.com/images/download_en.png" alt="">
                   </v-flex>

                   <v-flex xs12 md3 class="single-footer">
                       <h2  class="h2">Menu</h2>
                       <ul class="footer-list-vue">
                           <li><a href="#">Privacy Policy</a></li>
                           <li><a href="#">Cookie Policy</a></li>
                           <li><a href="#">Purchasing Policy</a></li>
                           <li><a href="#">Terms & Conditions</a></li>
                       </ul>
                   </v-flex>

                   <v-flex xs12 md3 class="single-footer">
                       <h2  class="h3">CONTACT US</h2>
                       <ul class="footer-list-vue">
                           <li><a href="#">House #13(2nd Floor), Road #2, Sector #6
                               Uttara, Dhaka-1230</a></li>
                           <li><a href="#">Email: bvononline@gmail.com</a></li>
                           <li><a href="#">Contact No: +8801788999966</a></li>
                       </ul>
                   </v-flex>

                   <v-flex xs12 md3 class="single-footer">
                       <h2  class="h4">Get in touch</h2>
                       <ul class="footer-icon-class">
                           <li><a href="#"><v-icon>mdi-facebook</v-icon></a></li>
                           <li><a href="#"><v-icon>mdi-instagram</v-icon></a></li>
                           <li><a href="#"><v-icon>mdi-youtube</v-icon></a></li>
                           <li><a href="#"><v-icon>mdi-twitter</v-icon></a></li>
                       </ul>
                   </v-flex>
               </v-layout>
                <v-layout row wrap class="footer-bottom-ok" style="margin-top: 0;">
                    <v-flex xs12 md12 class="footer-bottom-single-ok">

                            &copy; 2019-2021 Bvon. All rights reserved

                    </v-flex>
                </v-layout>

            </v-footer>




        </v-flex>
    </v-layout>
</template>

<style>
    .main-wrapper-footer .single-footer .h1::before, .main-wrapper-footer .single-footer .h2::before, .main-wrapper-footer .single-footer .h3::before, .main-wrapper-footer .single-footer .h4::before{
        content:'';
        position:relative;
        left:21px;
        top:54px;
        background-color: #018EA0;
        height:20px;
        box-sizing: border-box;
        width: 50px;
        overflow:hidden;
    }
</style>

<style lang="scss" scoped>
    .main-wrapper-footer{
        padding:5px 10px;
        overflow:hidden;
        background-color: #018EA9 !important;
        .single-footer{
            padding: 3px 5px;
            h2{
                padding: 5px 0;

            }

            img{
                width: 150px;
                height: auto;
            }

            .footer-list-vue{
                list-style-type: none;
                li{
                    padding: 0;
                    a{
                        text-decoration: none;
                        color: #ddd;
                    }
                }
            }
            .footer-icon-class{
                list-style: none;
                width: 100%;
                padding: 0 100px 0 0;
                li{
                    padding:5px;
                    float:left;
                    width: 25%;
                }
            }


        }

    }

    .footer-bottom-ok{
        background-color: #028aa5 !important;
        width: 100%;
        display: block;
        padding:20px;

        .footer-bottom-single-ok{
            text-align: center;
        }
    }
</style>

<script>
    export default {
        data: () => ({
            icons: [
                'mdi-facebook',
                'mdi-twitter',
                'mdi-linkedin',
                'mdi-instagram',
            ],
        }),
    }
</script>