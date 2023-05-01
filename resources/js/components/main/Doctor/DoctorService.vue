<template>
    <div>
        <loader v-if="isLoading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#ffffff" objectbg="#999793" opacity="100" disableScrolling="true" name="dots"></loader>

        <div v-if="checkActivation" class="container">
            <div>
                <div >
                    <div style="margin-bottom:25px; width: 100%; justify-content: space-between; display: flex;"><v-btn @click="openTicketShow">Open Ticket</v-btn> <v-btn @click="prescription">Prescription</v-btn> <v-btn @click="openFilterShow">Filter</v-btn></div>
                </div>
                <v-form method="post" @submit.prevent="appointmentSubmit"   ref="form"  v-model="valid"
                        lazy-validation >
                    <div v-if="value">
                    <div class="distric">
                        <v-row>
                            <v-col
                                    class="selectinput"
                                    cols="12"
                                    sm="6"

                            >
                                <!--<v-select-->
                                        <!--label="District"-->
                                        <!--solo-->
                                        <!--:items="district"-->
                                        <!--item-text="name"-->
                                        <!--item-value="id"-->
                                        <!--v-model="selectDistrict"-->
                                        <!--:rules="[v => !!v || 'District is required']"-->
                                        <!--required-->

                                <!--&gt;</v-select>-->

                                <v-autocomplete
                                        :items="district"
                                        label="District"
                                        item-text="name"
                                        item-value="id"
                                        solo
                                        v-model="selectDistrict"
                                        :rules="[v => !!v || 'District is required']"
                                        required
                                        :menuprops="autocompleteMenuProps"
                                ></v-autocomplete>
                            </v-col>
                            <v-col
                                    class="selectinput"
                                    cols="12"
                                    sm="6"
                            >
                                <v-select
                                        label="Upazila"
                                        :items="area"
                                        solo
                                        item-text="name"
                                        item-value="id"
                                        v-model="areaList"
                                ></v-select>
                            </v-col>
                        </v-row>
                    </div>
                    <div class="selectinput">
                        <v-row >
                            <v-col
                                    class="chamber"
                                    cols="12"
                                    sm="6"
                            >
                                <v-select
                                        :items="chamber"
                                        label="Chamber"
                                        item-text="chamber_name"
                                        item-value="id"
                                        solo
                                        v-model="selectChamber"
                                        :rules="[v => !!v || 'Chamber is required']"
                                        required
                                ></v-select>
                            </v-col>

                            <v-col
                                    class="chamber"
                                    cols="12"
                                    sm="6"
                            >
                                <v-menu
                                        ref="menu"
                                        v-model="menu"
                                        :close-on-content-click="false"
                                        :return-value.sync="date"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="auto"
                                        style="color:#000 !important;"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                                v-model="date"
                                                label="If you want to fix appointment date"
                                                prepend-icon="mdi-calendar"
                                                class="class-date-picker"
                                                readonly
                                                solo
                                                v-bind="attrs"
                                                v-on="on"
                                                :value="date"
                                        ></v-text-field>


                                    </template>
                                    <v-date-picker
                                            v-model="date"
                                            no-title
                                            scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn
                                                text
                                                color="primary"
                                                @click="menuClose"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                                text
                                                color="primary"
                                                @click="$refs.menu.save(date)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>

                            <v-col
                                    class="chamber"
                                    cols="12"
                                    sm="6"
                            >

                                <v-btn  :disabled="!valid"   @click="[checkMessage(), validate()]" style="background-color: #2CBD2C; color: #fff;" type="submit" >Confirm</v-btn>
                            </v-col>
                        </v-row>

                    </div>
                   <div style="width: 100%;"> <div class="tockennumber" v-if="token"> <b> S/N = {{token}}</b></div></div>

                    </div>
                </v-form>

                <div v-if="filterShow">
                    <div class="distric">
                        <v-row>
                            <v-col
                                    class="selectinput"
                                    cols="12"
                                    sm="4"

                            >
                                <!--<v-select-->
                                        <!--label="District"-->
                                        <!--solo-->
                                        <!--:items="district"-->
                                        <!--item-text="name"-->
                                        <!--item-value="id"-->
                                        <!--v-model="selectDistrictFilter"-->


                                <!--&gt;</v-select>-->

                                <v-autocomplete
                                        :items="district"
                                        label="District"
                                        item-text="name"
                                        item-value="id"
                                        solo
                                        v-model="selectDistrictFilter"
                                        :menuprops="autocompleteMenuProps"
                                ></v-autocomplete>
                            </v-col>
                            <v-col
                                    class="selectinput"
                                    cols="12"
                                    sm="4"
                            >
                                <v-select
                                        label="Upazila"
                                        :items="area"
                                        solo
                                        item-text="name"
                                        item-value="id"
                                        v-model="areaListFilter"
                                ></v-select>
                            </v-col>

                            <v-col
                                    class="selectinput"
                                    cols="12"
                                    sm="4"
                            >
                                <v-select
                                        label="Service"
                                        :items="categories"
                                        solo
                                        item-text="name"
                                        item-value="name"
                                        v-model="serviceFilter"
                                ></v-select>
                            </v-col>
                        </v-row>
                    </div>

                </div>

            </div>
            
               <v-container v-if="prescriptionlist">
                   <prescription-list></prescription-list>
               </v-container>
            <v-container v-else>

                <v-row>
                    Bvon Doctor List
                </v-row>

                <v-row >

                    <v-col cols="6" sm="3" v-for="doctor in doctors" :key="doctor.id" style="position: relative;">

                        <div class="wrapper-doctor-list">
                            <div class="doctor-img">
                                    <img :src="getDoctorImage(doctor.profile_pic)" alt="">

                            </div>
                            <div class="doctor-info">
                                <h4>{{doctor.name}}</h4>
                            </div>

                            <div class="doctor-info">
                                <h6> {{doctor.specialist}}</h6>
                            </div>

                            <div class="doctor-info">
                                <h6><a class="button" :href="'tel:'+doctor.phone">{{doctor.phone}}</a></h6>
                            </div>
                        </div>

                    </v-col>


                </v-row>


                <v-row>
                    Services
                </v-row>

                <v-row style="margin-bottom: 20px">

                    <v-col cols="12" sm="3" v-for="service in services" :key="service.id">
                        <div class="service-list">
                            <div class="service-image">
                                <img width="100px" height="100px" :src="imgUrl(service.logo)" alt="">
                            </div>
                            <div class="service-info">
                               <h4> {{service.organization_name}}</h4>
                            </div>

                            <div class="service-info">
                                {{service.discount}} percent
                            </div>

                            <div class="service-info">
                                {{service.address}}
                            </div>

                            <div class="service-info">
                                <h6><a class="buttons" :href="'tel:'+service.phone">{{service.phone}}</a></h6>
                            </div>
                         </div>
                    </v-col>


                </v-row>
            </v-container>
        </div>







        <div v-else class="container" style="height: 90vh; margin: auto;">
            <p style="width: 400px; margin: 30% auto;"> <span style="padding: 20px; background: #dc3545; color: #ffffff;">Your Subscription Expired !</span> <span @click="openActivationActive" style="padding: 20px; background: green; color: #ffffff; cursor: pointer;">Please Renew</span></p>
        </div>


        <div class="text-center">
            <v-dialog
                    v-model="openActivation"
                    width="500"
            >
                <v-card>
                    <v-card-title  class="text-h5 grey lighten-2" style="background-color: teal; color: #fff">
                        Bvon Doctor Subscription Renew
                    </v-card-title>
                    <v-form  method="post" ref="form"  v-model="valid"
                             lazy-validation @submit.prevent="doctorServiceRenew" >

                        <v-card-text>

                            <!--<v-col-->
                                    <!--cols="12"-->
                                    <!--sm="12"-->
                                    <!--md="12"-->
                            <!--&gt;-->
                                <!--<v-select-->
                                        <!--xs12-->
                                        <!--:items="duration"-->
                                        <!--class="doctor-text-field"-->
                                        <!--label="Select Month"-->
                                        <!--item-text="name"-->
                                        <!--item-value="month"-->
                                        <!--solo-->
                                        <!--:rules="[v => !!v || 'Month is required']"-->
                                        <!--required-->
                                        <!--v-model="form.month"-->
                                <!--&gt;</v-select>-->
                            <!--</v-col>-->

                             <v-col
                                    cols="12"
                                    sm="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="Enter Pin Code"
                                        placeholder="Enter Pin Code"
                                        solo
                                        :rules="[v => !!v || 'Pin Code is required']"
                                        v-model="form.pincode"
                                ></v-text-field>
                            </v-col>



                        </v-card-text>

                        <!--<v-divider></v-divider>-->

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                    color="primary"
                                    style="background-color: teal; color: #fff;"
                                    type="submit"
                                    text
                                    :disabled="!valid"
                                    @click="validate"

                            >
                                Confirm
                            </v-btn>
                        </v-card-actions>

                    </v-form>
                </v-card>
            </v-dialog>
        </div>

    </div>


</template>

<script>
    import  PrescriptionList from './PrescriptionList'
    export default {
        name: "DoctorService",
        components:{
            PrescriptionList
        },
        data(){
           return {
               doctors:[],
               form:{
                 pincode: null
               },
               openActivation:false,
               valid: true,
               value:false,
               menu: false,
               selectDistrict: '',
               area:[],
               areaList:'',
               selectChamber: '',
               chamber: [],
               date: null,
               token: '',
               services:'',
               serviceFilter:'',
               filterShow:false,
               categories:[
                   {id:1, name: 'Health'},
                   {id:2, name: 'Shopping'},
                   {id:3, name: 'Hotel'}
               ],
               duration:[
                   {month: 1, name: 'One Month'},
                   {month: 3, name: 'Three Month'},
                   {month: 6, name: 'Six Month'},
                   {month: 12, name: 'One year'},

               ],
               selectDistrictFilter: '',
               areaListFilter:'',
               prescriptionlist:false,
               checkActivation:0,
               isLoading:true
           }
        },
        watch :{

            selectDistrictFilter : function(){
                axios.get('/api/area?district_id='+this.selectDistrictFilter)
                    .then(res =>{
                        this.area = res.data.data;
                    });

                axios.get('/api/bvon-chamber-service-token-filter?district_id='+this.selectDistrictFilter)
                    .then(res => {
                        this.services = res.data;
                        console.log(res.data);
                    })
                    .catch(error => console.log(error.response.data));

            },

            areaListFilter : function(){
                axios.get('/api/bvon-chamber-service-token-filter-thana?thana_id='+this.areaListFilter)
                    .then(res => {
                        this.services = res.data;
                        console.log(res.data);
                    })
                    .catch(error => console.log(error.response.data));
            },

            serviceFilter : function(){
                axios.get('/api/bvon-chamber-service-token-filter-service?service='+this.serviceFilter)
                    .then(res => {
                        this.services = res.data;
                        console.log(res.data);
                    })
                    .catch(error => console.log(error.response.data));
            },


            selectDistrict : function(value){
                axios.get('/api/area?district_id='+this.selectDistrict)
                    .then(res =>{
                        this.area = res.data.data;
                    });

                axios.get('/api/bvon-chamber-service-token?district_id='+this.selectDistrict)
                    .then(res => {
                        this.chamber = res.data;
                        console.log(res.data);
                })
                    .catch(error => console.log(error.response.data));
            },

            areaList : function(value){

                axios.get('/api/bvon-chamber-service-token-thana?thana_id='+this.areaList)
                    .then(res => {
                        this.chamber = res.data;
                        console.log(res.data);
                    })
                    .catch(error => console.log(error.response.data));
            },

        },
        methods:{

            getDoctorImage(image){
                return '/media/doctor/service/image/'+image;
            },

            doctorServiceRenew(){
              axios.post('/api/bvon-doctor-service-renew', this.form)
                  .then(res =>{
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
            },

            validate () {
                this.$refs.form.validate()
            },

            openActivationActive(){
                this.openActivation = true;
            },
            autocompleteMenuProps() {
                // default properties copied from the vuetify-autocomplete docs
                let defaultProps = {
                    closeOnClick: false,
                    closeOnContentClick: false,
                    disableKeys: true,
                    openOnClick: false,
                    maxHeight: 304
                };

                if (this.$vuetify.breakpoint.smAndDown) {
                    defaultProps.maxHeight = 130;
                    defaultProps.top = true;
                }
                return defaultProps;
            },
            prescription(){
                if(this.prescriptionlist == false){

                this.prescriptionlist = true;

                }else{
                    this.prescriptionlist = false;

                }
            },
            validate () {
                this.$refs.form.validate()
            },
            imgUrl(image){
                return '/media/doctor/service/'+image;
            },
            checkMessage(){
                if(this.selectDistrict ==='' || this.selectChamber ===''){
                    if (this.selectDistrict ==='') {
                        this.$alert("Please fill the District!");
                       return;

                    }
                    if(this.selectChamber ===''){
                        this.$alert("Please fill the Chamber!");

                    }
                }
            },
            openTicketShow(){
                this.value = !this.value;
                this.filterShow = false;
                this.prescriptionlist = false;
            },
            openFilterShow(){
               this.filterShow = !this.filterShow;
               this.value = false;
                this.prescriptionlist = false;
            },
            menuClose(){
                this.menu = false;
                this.date = null;
            },

            appointmentSubmit(){
                axios.post('/api/bvon-doctor-service-appointment-submit',{
                    district: this.selectDistrict,
                    area: this.areaList,
                    chamber: this.selectChamber,
                    date: this.date,
                    user_id: User.id()
                })
                    .then(res => {

                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            axios.get('/api/get-doctor-appointment-token/'+User.id())
                                .then(res => {
                                    this.token = res.data;
                                });

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }

                        console.log(res.data);
                    })
                    .catch(error => console.log(error.response.data));
            }

        },
        computed:{
            district(){
                return this.$store.state.district;
            },

        },
        mounted() {
            this.$store.dispatch('district');

        },
        created() {
            axios.get('api/get-doctor-service-activation')
                .then(res => {
                    this.checkActivation = res.data;
                    // console.log(this.checkActivation)
                    this.isLoading = false;

                })
                .catch(error => console.log(error.response.data));

            axios.get('/api/get-doctor-appointment-token/'+User.id())
                .then(res => {
                    this.token = res.data;
                })
                .catch(error => console.log(error.response.data));


            axios.get('/api/get-doctor-service-list')
                .then(res => {
                    this.services = res.data;
                })
                .catch(error => console.log(error.response.data));

            axios.get('/api/get-doctor-list-fetch')
                .then(res =>{
                    this.doctors = res.data;
                    console.log(this.doctors);
                })
                .catch(error => console.log(error.response.data));



        }
    }
</script>

<style lang="scss" scoped>
    @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

    .service-list{
        background: #247ea1;
        text-align: center;
        padding: 10px;
        color: #ffffff;

        .service-image{
            width: 100px;
            height: 100px;
            display: inline;

        }

        .service-info{
            padding: 3px;
        }
    }



    .buttons {
        background-color: #247EA1;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: none;
        color: #FFFFFF;
        cursor: pointer;
        display: inline-block;
        font-family: Arial;
        font-size: 20px;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        -webkit-animation: glowings 1500ms infinite;
        -moz-animation: glowings 1500ms infinite;
        -o-animation: glowings 1500ms infinite;
        animation: glowings 1500ms infinite;
    }

    @keyframes glowings {
        0% { background-color: #148A9D; box-shadow: 0 0 3px #148A9D; }
        50% { background-color: #247EA1; box-shadow: 0 0 40px #247EA1; }
        100% { background-color: #148A9D; box-shadow: 0 0 3px #148A9D; }
    }








    .button {
        background-color: #018EA9;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: none;
        color: #FFFFFF;
        cursor: pointer;
        display: inline-block;
        font-family: Arial;
        font-size: 16px;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        -webkit-animation: glowing 1500ms infinite;
        -moz-animation: glowing 1500ms infinite;
        -o-animation: glowing 1500ms infinite;
        animation: glowing 1500ms infinite;
    }

    @keyframes glowing {
        0% { background-color: #468180; box-shadow: 0 0 3px #468180; }
        50% { background-color: #018EA9; box-shadow: 0 0 40px #018EA9; }
        100% { background-color: #468180; box-shadow: 0 0 3px #468180; }
    }

    .wrapper-doctor-list{
        padding: 10px;
        width: 100%;
        background-color: #468180;
        text-align: center;
        color: #ffffff;
        //box-shadow: 10px 10px #dddddd, -10px -10px #dddddd;
        .doctor-img{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: inline;
            img{
                width: 100px;
                height: 100px;
                border-radius: 50%;
            }
        }

        .doctor-info{
            padding: 5px;
            a{
                text-decoration: none;
                color: #fff;
            }
        }
    }

    footer {
        background-color: #222;
        color: #fff;
        font-size: 14px;
        bottom: 0;
        position: fixed;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 999;
    }


    .container {
        background-color: rgb(241, 241, 241);
        border-radius: 5px;
        /* box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22); */
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 100%;
        min-height: 480px;
        margin-top: 10px;

    }
</style>

<style lang="scss" scoped>
    .containers{
        width: 450px;
        max-width: 100%;
        border: solid 1px rgb(212, 212, 212);
        border-radius: 5px;
        padding: 16px;
        margin: 0 auto;
        margin-top: 10px;
    }
    .distric{
        width: 100%;
    }
    .tockennumber{
        border-radius: 3px;
        text-align:center;
        background-color:rgb(44, 189, 44);
        color:white;padding:10px;
        width: 300px;
        margin: 14px auto;
    }


</style>

<style lang="sass">
    .selectinput
        padding-top: 0 !important
        margin-top: 0 !important
        .v-input__control
            .v-text-field__details
                display: none !important
.v-btn--active
  color: #000 !important
.class-date-picker
  .v-input__control
    height: 40px !important


</style>