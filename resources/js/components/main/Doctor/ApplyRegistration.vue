<template>
    <div>
        <div class="container">
            <div>
                <h3 class="register">
                    User/Register
                </h3>
            </div >
            <v-form  ref="form" class="px-3" @submit.prevent="register" method="post" enctype="multipart/form-data"  v-model="valid"
                    lazy-validation >
                <div>
                    <v-row>
                        <v-col
                                cols="12"
                        >
                            <v-text-field
                                    label="Name"
                                    class="doctor-text-field"
                                    single-line
                                    solo
                                    :value="user"
                                    v-model="form.name"
                                    required
                                    :rules="nameRules"
                            ></v-text-field>
                        </v-col>

                        <v-col
                                cols="12"
                        >
                            <v-text-field
                                    class="doctor-text-field"
                                    label="Phone No:"
                                    required
                                    solo
                                    :value="phone"
                                    v-model="form.phone"
                                    :rules="phoneRules"

                            ></v-text-field>
                        </v-col>

                        <v-col
                                cols="12"
                        >

                            <v-autocomplete
                                    class="doctor-text-field"
                                    :items="ageNow"
                                    label="Age"
                                    item-text="name"
                                    item-value="name"
                                    solo
                                    v-model="form.age"
                                    required
                                    :rules="[v => !!v || 'Age is required']"
                                    :menuprops="autocompleteMenuProps"
                            ></v-autocomplete>



                        </v-col>

                        <v-col
                                cols="12"
                        >

                            <v-layout row>
                                <v-col cols="4">
                                    <v-autocomplete
                                            class="doctor-text-field"
                                            :items="district"
                                            label="District"
                                            item-text="name"
                                            item-value="id"
                                            required
                                            solo
                                            v-model="selectDistrict"
                                            :rules="[v => !!v || 'District is required']"
                                            :menuprops="autocompleteMenuProps"
                                    ></v-autocomplete>
                                </v-col>

                                <v-col cols="4">
                                    <v-select
                                            xs12
                                            :items="area"
                                            label="Thana"
                                            item-text="name"
                                            item-value="id"
                                            solo
                                            class="doctor-text-field"
                                            v-model="form.area"
                                            required
                                            :rules="[v => !!v || 'Area is required']"
                                    ></v-select>
                                </v-col>



                                <v-col cols="4">
                                    <v-text-field
                                            v-model="form.village"
                                            class="doctor-text-field"
                                            label="Village"
                                            required
                                            solo
                                            :rules="villageRules"
                                    ></v-text-field>
                                </v-col>
                            </v-layout>
                        </v-col>


                        <v-col
                                cols="12"
                        >

                            <v-select
                                    xs12
                                    :items="occupations"
                                    class="doctor-text-field"
                                    label="Choose Occupation"
                                    item-text="name"
                                    item-value="name"
                                    solo
                                    required
                                    v-model="form.occupation"
                                    :rules="[v => !!v || 'Occupation is required']"
                            ></v-select>


                        </v-col>


                        <!--<v-col-->
                                <!--cols="12"-->
                        <!--&gt;-->

                            <!--<v-select-->
                                    <!--xs12-->
                                    <!--:items="duration"-->
                                    <!--class="doctor-text-field"-->
                                    <!--label="Select Month"-->
                                    <!--item-text="name"-->
                                    <!--item-value="month"-->
                                    <!--solo-->
                                    <!--required-->
                                    <!--v-model="form.duration"-->
                                    <!--:rules="[v => !!v || 'Occupation is required']"-->
                            <!--&gt;</v-select>-->


                        <!--</v-col>-->

                        <v-col
                                cols="12"
                        >

                            <v-select
                                    xs12
                                    class="doctor-text-field"
                                    :items="blood"
                                    label="Choose Blood Group"
                                    item-text="name"
                                    item-value="name"
                                    solo
                                    required
                                    v-model="form.blood"
                                    :rules="[v => !!v || 'Blood is required']"
                            ></v-select>

                        </v-col>


                        <v-col
                                cols="12"
                        >
                            <v-text-field
                                    v-model="form.account"
                                    class="doctor-text-field"
                                    label="Field Officer Account NO:"
                                    required
                                    solo
                                    :rules="fieldRules"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12">
                            <div class='file-input'>
                                <input type='file' @change="onFileChange" >
                                <span class='label' style="font-weight: 400" >Upload Photo</span>
                                <span class='button'></span>
                            </div>
                        </v-col>

                        <v-layout row style="padding-left: 15px; padding-right: 15px">
                            <v-col cols="12" style="padding-bottom:0 !important">
                                <p style="font-weight: 400">Member</p>
                                <v-select
                                        xs12
                                        class="doctor-text-field"
                                        :items="countMember"
                                        label="Choose Family Members"
                                        item-text="name"
                                        item-value="id"
                                        required
                                        solo
                                        v-model="selectMemeber"
                                        :rules="[v => !!v || 'Member is required']"
                                ></v-select>
                            </v-col>

                            <v-layout row wrap style="padding-left: 10px; padding-right: 10px">
                                    <v-col cols="12" v-if="n > 0">
                                        <v-layout v-for="i in n" :key="i" row>
                                            <v-col
                                                    cols="12"
                                                    md="3"
                                            >
                                                <v-select
                                                        xs12
                                                        class="doctor-text-field"
                                                        :items="relationShip"
                                                        label="Relation"
                                                        item-text="name"
                                                        item-value="name"
                                                        solo
                                                        v-model="form.relation[i]"
                                                        required
                                                        :rules="[v => !!v || 'Relation is required']"
                                                ></v-select>
                                            </v-col>

                                            <v-col
                                                    cols="12"
                                                    md="3"
                                            >
                                                <v-text-field
                                                        label="Name"
                                                        placeholder="Name"
                                                        solo
                                                        v-model="form.rname[i]"
                                                        required
                                                        :rules="[v => !!v || 'Name is required']"
                                                ></v-text-field>
                                            </v-col>

                                            <v-col
                                                    cols="12"
                                                    md="3"
                                            >
                                                <!--<v-text-field-->
                                                        <!--label="Age"-->
                                                        <!--placeholder="Age"-->
                                                        <!--solo-->
                                                        <!--v-model="form.rage[i]"-->
                                                <!--&gt;</v-text-field>-->

                                                <v-autocomplete
                                                        :items="ageNow"
                                                        label="Age"
                                                        item-text="name"
                                                        item-value="name"
                                                        solo
                                                        v-model="form.rage[i]"
                                                        required
                                                        :rules="[v => !!v || 'Age is required']"
                                                        :menuprops="autocompleteMenuProps"
                                                ></v-autocomplete>
                                            </v-col>
                                            <v-col
                                                    cols="12"
                                                    md="3"
                                            >
                                                <v-select
                                                        xs12
                                                        :items="occupations"
                                                        class="doctor-text-field"
                                                        label="Choose Occupation"
                                                        item-text="name"
                                                        item-value="name"
                                                        solo
                                                        v-model="form.roccupation[i]"
                                                        :rules="[v => !!v || 'Occupation is required']"
                                                        required
                                                ></v-select>

                                            </v-col>
                                        </v-layout>
                                    </v-col>
                            </v-layout>
                        </v-layout>

                        <v-row style="padding-left: 10px; padding-right: 10px;">
                            <v-col
                                    cols="12"
                                    md="12"
                            >
                                <v-text-field
                                        label="PIN"
                                        placeholder="Pin"
                                        class="doctor-text-field class-drcress-now-pin"
                                        solo
                                        v-model="form.pin"
                                        required
                                        :rules="[v => !!v || 'PinCode is required']"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-row>
                </div>

                <div class="button" style="margin-top: 20px;">
                    <v-btn type="submit" :disabled="!valid"  @click="validate">
                        Register
                    </v-btn>
                </div>
            </v-form>


        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                valid: true,


                nameRules: [
                    v => !!v || 'Name is required',
                ],

                phoneRules: [
                    v => !!v || 'Phone is required',
                ],

                villageRules: [
                    v => !!v || 'Village is required',
                ],
                fieldRules: [
                    v => !!v || 'Field Officer is required',
                ],

                n: 0,
                countMember:[
                    {id:1, name:1},
                    {id:2, name:2},
                    {id:3, name:3},
                    {id:4, name:4},
                    {id:5, name:5},
                    {id:6, name:6},
                    {id:7, name:7},
                    {id:8, name:8}
                ],
                duration:[
                    {month: 1, name: 'One Month'},
                    {month: 3, name: 'Three Month'},
                    {month: 6, name: 'Six Month'},
                    {month: 12, name: 'One year'},

                ],
                blood:[
                    {name: 'O+'},
                    {name: 'O-'},
                    {name: 'A+'},
                    {name: 'A-'},
                    {name: 'B+'},
                    {name: 'B-'},
                    {name: 'AB+'},
                    {name: 'AB-'},
                    {name: 'Unknown'},
                ],
                relationShip:[
                    {name: 'Father'},
                    {name: 'Mother'},
                    {name: 'Brother'},
                    {name: 'Sister'},
                    {name: 'Husband'},
                    {name: 'Wife'},
                    {name: 'Son'},
                    {name: 'Daughter'}
                ],
                occupations:[
                    {name: 'Doctor'},
                    {name: 'Teacher'},
                    {name: 'Business/Entrepreneur'},
                    {name: 'Student'},
                    {name: 'Farmer'},
                    {name: 'Housewife'},
                    {name: 'Government Service'},
                    {name: 'Private Service'},
                    {name: 'Freelancer'},
                    {name: 'Physician'},
                    {name: 'Architect'},
                    {name: 'Electrician/Technician'},
                    {name: 'Lawyer'},
                    {name: 'Researcher'},
                    {name: 'Writer/Poet'},
                    {name: 'Journalist'},
                    {name: 'Engineer'},
                    {name: 'Software & Web Developer'},
                    {name: 'Athlete'},
                    {name: 'Artist-Actor/Actress/Singer'},
                    {name: 'Driving'},
                    {name: 'Social Worker/ Politician'},
                    {name: 'Others'},

                ],
                form:{
                    name: User.user(),
                    phone: User.phone(),
                    age:"",
                    area:"",
                    occupation:"",
                    relation : [],
                    rname:[],
                    rage:[],
                    roccupation:[],
                    pin:'',
                    village:'',
                    account:'',
                    blood:'',
                    // duration:''
                },

                selectMemeber:'',
                selectDistrict: '',
                area:[],
                media:'',

            }
        },
        computed:{

            user(){
                return User.user();
            },

            userType(){
                return User.user_type();
            },

            phone(){
                return User.phone();
            },
            district(){
                return this.$store.state.district;
            },
            ageNow(){
                var lenft = [];
                var n= 100;
                var left = {};
                for (var i= 1; i<= n; i++){
                    left = {name : i};
                    lenft.push(left);
                }
                return lenft;
            }
        },
        watch : {
            selectMemeber: function (value) {
                // this.selectMemeber = this.n;
                this.n = value;
                // console.log(this.n);
            },

            selectDistrict : function(value){
                axios.get('/api/area?district_id='+this.selectDistrict)
                    .then(res =>{
                        this.area = res.data.data;
                    });
            }
        },
        methods:{

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
            validate () {
                this.$refs.form.validate()
            },
            onFileChange(e){
                this.media = e.target.files[0];
                console.log(this.media);
            },
            register(){
                // const formData = new FormData;
                // formData.append('media',this.media);

                const formData = new FormData;
                formData.set('name', this.form.name);
                formData.set('phone', this.form.phone);
                formData.set('age', this.form.age);
                formData.set('area', this.form.area);
                formData.set('occupation', this.form.occupation);
                formData.set('blood', this.form.blood);

                formData.set('village', this.form.village);
                formData.set('account', this.form.account);
                // formData.set('duration', this.form.duration);
                formData.set('selectMemeber', this.selectMemeber);
                formData.set('selectDistrict', this.selectDistrict);
                formData.set('user_id',  User.id());
                formData.set('relation', this.form.relation);
                formData.set('rname', this.form.rname);
                formData.set('rage', this.form.rage);
                formData.set('roccupation', this.form.roccupation);
                formData.set('media',this.media);
                formData.set('pin',this.form.pin);


                axios.post('/api/bvon-doctor-service', formData)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });

                            let details = {
                                number: this.form.phone,
                                message: 'আপনার ও পরিবারের স্বাস্থ্য সুরক্ষায় বিভন বি ডক্টর সেবায় আপনাকে স্বাগতম। সেবা নিন সুস্থ থাকুন। বিভন বি ডক্টর | ডাক্তারের সেবা পেতে ভিজিট করুনঃ https://bvon.app/bvon-doctor-service-token',
                                key:'a7348e9751efeb8e6108339c84b6d9ac2ebbc14c',
                                type: 'sms',
                                devices:'105|0',
                                prioritize:0
                            };
                            let data = new FormData();
                            for ( let key in details ) {
                                data.append(key, details[key]);
                            }
                            fetch('https://bulksms.brotherit.net/services/send.php', {
                                method: 'POST',
                                mode: 'cors',
                                body: data
                            })
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                });

                            window.location='/bvon-doctor-service-token';

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    })
                    .catch(error => console.log(error.response.data));
            },
            // appendNewChildCreate(){
            //     // e.parentNode.parentNode.remove();
            //     // console.log();
            //    var element = document.querySelector("#appendNewChild");
            //     var first = element.firstElementChild;
            //         // .addEventListener("click", (e) => {
            //         // if (e.target.classList.contains("delete")) {
            //         //     e.target.closest("div").remove();
            //         // }
            //     // });
            // }
        },

        mounted() {
            this.$store.dispatch('district');


            // console.log(lenft[0].name);

            // console.log([...Array(n+100).keys(), ...Array(100).values()]);
        },


    }
</script>


<style lang="scss" scoped>
    .container {
        background-color: rgb(219, 219, 219);
        border-radius: 5px;

        /* box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22); */
        position: relative;
        overflow: hidden;
        width: 700px;
        max-width: 100%;
        min-height: 480px;
        line-height: .5rem;
        margin-bottom: 20px;
    }
    .register{
        justify-content: center;
        text-align: center;

        margin-bottom: 20px;
    }
    .position-relative {
        position: relative;
    }
    .button{
        justify-content: center;
        text-align: center;
    }



    .file-input {
        display: inline-block;
        text-align: left;
        background: #fff;
        padding: 12px;
        width: 100%;
        position: relative;
        border-radius: 3px;
    }

    .file-input > [type='file'] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 10;
        cursor: pointer;
    }

    .file-input > .button {
        display: inline-block;
        cursor: pointer;
        background: #eee;
        padding: 8px 16px;
        border-radius: 2px;
        margin-right: 8px;
    }

    /*.file-input:hover > .button {*/
        /*background: dodgerblue;*/
        /*color: white;*/
    /*}*/

    .file-input > .label {
        color: #333;
        white-space: nowrap;
        opacity: .3;
    }

    .file-input.-chosen > .label {
        opacity: 1;
    }


</style>

<style lang="sass" >
    .doctor-text-field
        padding-top:0 !important
        margin-top:0 !important
        .v-input__control
            .v-text-field__details
                display: none !important
    .class-drcress-now-pin
     .v-input__control
         max-height: 41px !important
</style>
