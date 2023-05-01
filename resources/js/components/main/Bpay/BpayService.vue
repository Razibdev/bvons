<template>
    <section class="section">
        <loader v-if="isLoading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#ffffff" objectbg="#999793" opacity="100" disableScrolling="true" name="dots"></loader>

        <v-layout raw wrap >
            <v-flex xs6 md2 style="overflow:hidden;" class="main-cards"  v-for="category in categories" :key="category.id" >
                <div>
                    <template>
                        <div class="text-center">
                            <v-dialog
                                    v-model="dialog[category.id]"
                                    width="867"
                                    style="overflow : hidden;"
                            >

                                <template v-slot:activator="{ on, attrs }">
                                    <!--<v-btn-->
                                    <!--color="red lighten-2"-->
                                    <!--dark-->
                                    <!---->
                                    <!--&gt;-->
                                    <!--Click Me-->
                                    <!--</v-btn>-->

                                    <div   v-bind="attrs"
                                           v-on="on" >
                                        <div @click="openServiceList(category.id)">
                                        <router-link to="" style="text-decoration: none;">
                                            <v-card
                                                    class="mx-auto cards"
                                                    max-width="180"
                                                    outlined
                                                    style="margin-left: 15px !important; margin-right: 11px !important; margin-bottom: 1px !important;"
                                            >

                                                <v-list-item three-line >

                                                    <v-list-item-content style="padding: 20px 0">
                                                        <div class="text-overline mb-4" style="align-items: center; text-align: center;margin-bottom: 0.5rem !important;">
                                                            <img :src="categoryImage(category.category_image)" alt="">

                                                        </div>
                                                        <v-list-item-title class="text-h5 mb-1 text-part" style="align-items: center; text-align: center">
                                                            {{category.category_name}}
                                                        </v-list-item-title>

                                                    </v-list-item-content>

                                                </v-list-item>
                                            </v-card>
                                        </router-link>
                                        </div>
                                    </div>



                                </template>
                                <v-card >
                                    <v-card-title class="text-h5 grey lighten-2" style="background-color: teal; color: #ffffff;">
                                        Bpay Service List
                                    </v-card-title>

                                    <v-card-text>
                                        <div >
                                            <v-layout raw wrap>
                                                <v-flex xs12 md4 >
                                                    <v-autocomplete
                                                            :items="district"
                                                            label="District"
                                                            item-text="name"
                                                            item-value="id"
                                                            solo
                                                            v-model="selectDistrictFilter"
                                                    ></v-autocomplete>
                                                </v-flex>
                                                <v-flex xs12 md4 >
                                                    <v-select
                                                            :items="area"
                                                            label="Choose Thana"
                                                            item-text="name"
                                                            item-value="id"
                                                            v-model="selectThanaFilter"
                                                            solo
                                                    ></v-select>
                                                </v-flex>
                                                <v-flex xs12 md4 >
                                                    <v-text-field
                                                            label="Marchant Phone Number"
                                                            solo
                                                            v-model.number="phone"
                                                            @keyup="isNumber($event)"
                                                            type="number"
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                        <v-layout v-if="services.length > 0" raw wrap style="overflow:auto; height: 500px;">
                                            <v-flex xs6 md3  class="main-cards"  v-for="service in services" :key="service.id">

                                                <v-card
                                                        class="mx-auto service-list-shop"
                                                        max-width="470"
                                                        @click="paymentConfirm(service.id)"
                                                >
                                                    <v-list-item style="min-height: 42px;">
                                                        <v-list-item-content style="padding: 0 !important;" >
                                                            <v-list-item-title>
                                                                <v-layout raw wrap >
                                                                    <v-flex xs12 md3 >
                                                                        <img  :src="imgUrl(service.logo)" width="100%" height="60px" alt="" style="margin-bottom: 10px">
                                                                    </v-flex>
                                                                    <v-flex xs12 md9 >
                                                                        <span :class="{'text-size-decress' : showNavbar}" > {{service.name}}</span>
                                                                    </v-flex>
                                                                </v-layout>

                                                            </v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>

                                                    <!--<v-divider my></v-divider>-->

                                                    <v-list-item style="min-height: 42px;" >
                                                        <v-list-item-content style="padding: 0 !important;">
                                                            <v-list-item-title :class="{'text-size-decress' : showNavbar}">Address: {{service.address}}</v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>

                                                    <v-list-item style="min-height: 42px;" >
                                                        <v-list-item-content style="padding: 0 !important;">
                                                            <v-list-item-title :class="{'text-size-decress' : showNavbar}">Phone: {{service.mobile}}</v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>
                                                </v-card>
                                            </v-flex>
                                        </v-layout>
                                        <v-layout raw wrap v-else>
                                            <div >
                                                <v-layout raw wrap>
                                                    <div style="width: 100%; text-align: center; ">
                                                        <span style="width: 200px; font-size: 21px;">Service Not Available</span>
                                                    </div>

                                                </v-layout>

                                            </div>
                                        </v-layout>
                                        </div>

                                    </v-card-text>

                                    <v-divider></v-divider>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                                color="primary"
                                                text
                                                @click="openServiceDetails(category.id)"
                                        >
                                            Close
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </div>
                    </template>
                </div>

            </v-flex>
        </v-layout>






        <template>
            <div class="text-center">
                <v-dialog
                        v-model="paymentDialog"
                        width="500"
                >

                    <v-card>
                        <v-card-title class="text-h5 grey lighten-2" style="background: teal">
                            Marchant Payment
                        </v-card-title>

                        <v-card-text>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                    color="primary"
                                    text
                                    @click="dialog = false"
                            >
                                I accept
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
        </template>





    </section>
</template>

<script>
    export default{
        data(){
            return{
                categories:[],
                dialog: {},
                paymentDialog: false,
                services:[],
                isLoading:false,
                inwidth:'',
                showNavbar:'',
                items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
                selectDistrictFilter:'',
                area:[],
                selectThanaFilter:'',
                phone:null


            }
        },
        watch : {

            selectDistrictFilter: function () {
                axios.get('/api/area?district_id=' + this.selectDistrictFilter)
                    .then(res => {
                        this.area = res.data.data;
                    });

                axios.get('/api/bvon-bpay-service-list-filter-district?district_id=' + this.selectDistrictFilter)
                    .then(res => {
                        this.services = res.data;
                    })
                    .catch(error => console.log(error.response.data));

            },
            selectThanaFilter: function () {

                axios.get('/api/bvon-bpay-service-list-filter-thana?thana_id=' + this.selectThanaFilter)
                    .then(res => {
                        this.services = res.data;
                    })
                    .catch(error => console.log(error.response.data));

            },


        },
        mounted(){
            this.$store.dispatch('district');
        },
        computed:{
            district(){
                return this.$store.state.district;
            },
        },
        created(){
          axios.get('api/bpay-categories-get')
              .then(res =>{
                  this.categories = res.data;
              })
              .catch(error => console.log(error.response.data));
             this.handle();

        },
        methods:{
            paymentConfirm(id){
                this.paymentDialog = true;
            },
            isNumber(evt) {

                if(this.phone != null && this.phone != ''){
                    axios.get(`/api/bvon-bpay-service-list-filter-phone/${this.phone}`)
                        .then(res => {
                            this.services = res.data;
                        })
                        .catch(error => console.log(error.response.data));
                }

            },

            categoryImage(image){
                return '/bpay/category/'+image;
            },
            openServiceDetails(id){
                this.dialog[id] = false;
            },

            openServiceList(id){
                this.isLoading = true;
                axios.get(`/api/bpay-service-list/${id}`)
                    .then(res =>{
                        this.isLoading = false;
                        this.services = res.data;
                    })
                    .catch(error => console.log(error.response.data));
            },
            imgUrl(image){
                return '/bpay/marchant_shop/'+image;
            },

            handle() {
                this.inwidth = window.innerWidth >= 900;
                this.showNavbar = window.innerWidth <= 900;

            },
        }
    }
</script>


<style scoped>
    .text-size-decress{
        font-size: 10px;
    }

    .section{
        overflow: hidden;
        margin-top: 20px;
        margin-bottom: 40px;
    }

    .section h5{
        padding: 20px  0;
        padding-left: 12px;
        font-size: 30px;
        font-weight: 700;
    }
    .main-cards{
        margin-bottom: 10px;

    }

     .main-cards .cards{
        background-color: #468180;
        cursor: pointer;
        box-shadow: 0 0px 5px 0px #0000002e;
        margin-right: 1px;

    }

    .main-cards .cards::before{
        content: '';
        position: absolute;
        left:0;
        bottom:0;
        width:0;
        box-sizing: border-box;
        height: 0;
        border-bottom: 3px solid transparent;
        border-left: 3px solid transparent;
        transition: all .8s ease;
    }
   .main-cards .cards::after{
        content: '';
        position: absolute;
        right:0;
        top:0;
        width:0;
        box-sizing: border-box;
        height:0;
        border-top: 3px solid transparent;
        border-right: 3px solid transparent;
        transition: all .8s ease;
    }
    .main-cards:hover .cards::after,
     .main-cards:hover .cards::before{
        border-color: #0ecde7;
        width: 100% !important;
        height: 100% !important;
    }



   .main-cards .text-part{
        text-transform: capitalize;
        font-size: 18px;
        line-height: 30px;
        font-weight: 500;
        color: white;
    }

    .service-list-shop{
        margin-right: 8px !important;
        margin-bottom: 8px !important;
    }


</style>

