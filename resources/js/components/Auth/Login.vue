<template>
    <div>
        <v-row justify="center">
            <v-dialog
                    v-model="dialogLogIn"
                    persistent
                    max-width="400px"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                            color="primary"
                            dark
                            v-bind="attrs"
                            v-on="on"
                            text
                            style="margin-top: 5px;"
                    >
                        Login
                    </v-btn>
                </template>
                <v-card>
                    <form @submit.prevent="login" method="post">
                        <v-card-title style="background: teal">
                            <span style="margin: auto; color:white;" class="text-h5">LogIn Bvon</span>
                            <v-icon style="float: right; cursor:pointer;" @click="dialogLogIn = false">mdi-close</v-icon>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                                label="Phone/Username/Account Number"
                                                single-line
                                                type="text"
                                                v-model="form.phone"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                                label="Password"
                                                class="login-style"
                                                single-line
                                                v-model="form.password"
                                                :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
                                                @click:append="() => (value = !value)"
                                                :type="value ? 'password' : 'text'"
                                        ></v-text-field>
                                        <!--<v-icon style="color: #000; position: absolute; right: 17px; top: 30px;" @click="showLoginPassword">{{passwordShow}}</v-icon>-->
                                    </v-col>
                                </v-row>
                                <!--<v-divider></v-divider>-->
                                <div>
                                    <a href="#" @click="forgotClick">Forgot Password?</a>

                                    <v-btn
                                            style="background-color:teal; float:right;"
                                            dark
                                            text
                                            @click="dialogLogIn = false"
                                            type="submit"
                                    >
                                        LogIn
                                    </v-btn>


                                </div>
                            </v-container>

                        </v-card-text>
                        <v-card-actions style="text-align: center; align-items: center; overflow: hidden;">
                            <p style="margin-top: 10px; margin-left: 98px; text-align: center" @click="doneoknow" >Not a member? &nbsp; &nbsp; </p><register></register>
                        </v-card-actions>
                    </form>
                </v-card>
            </v-dialog>
        </v-row>



        <v-row justify="center">
            <v-dialog
                    v-model="forgotPassword"
                    persistent
                    max-width="400px"
            >
                <!--<template v-slot:activator="{ on, attrs }">-->
                    <!--<v-btn-->
                            <!--color="primary"-->
                            <!--dark-->
                            <!--v-bind="attrs"-->
                            <!--v-on="on"-->
                            <!--style="margin-top: 5px; background: #232F3E;"-->
                    <!--&gt;-->
                        <!--Login-->
                    <!--</v-btn>-->
                <!--</template>-->
                <v-card>

                        <v-card-title style="background: teal">
                            <span style="margin: auto; color:white;" class="text-h5">Change Password</span>
                            <v-icon style="float: right; cursor:pointer;" @click="forgotPassword = false">mdi-close</v-icon>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <div v-if="checkPhone">
                                <form @submit.prevent="codeSend" method="post">

                                <v-row >
                                    <v-col cols="12">
                                        <v-text-field
                                                label="Phone Number"
                                                single-line
                                                type="text"
                                                v-model="code.phone"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                                label="Account Number (Premium User)"
                                                single-line
                                                type="text"
                                                v-model="code.account"
                                        ></v-text-field>
                                    </v-col>
                                    <!--<v-col cols="12">-->
                                        <!--<v-text-field-->
                                                <!--label="Password"-->
                                                <!--class="login-style"-->
                                                <!--single-line-->
                                                <!--v-model="form.password"-->
                                                <!--:append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"-->
                                                <!--@click:append="() => (value = !value)"-->
                                                <!--:type="value ? 'password' : 'text'"-->
                                        <!--&gt;</v-text-field>-->
                                        <!--&lt;!&ndash;<v-icon style="color: #000; position: absolute; right: 17px; top: 30px;" @click="showLoginPassword">{{passwordShow}}</v-icon>&ndash;&gt;-->
                                    <!--</v-col>-->

                                    <v-col cols="12">
                                        <v-btn
                                                style="background-color:teal; width: 100%;"
                                                dark
                                                text
                                                type="submit"
                                        >
                                            Send
                                        </v-btn>
                                    </v-col>
                                </v-row>
                                </form>
                                </div>

                                <!--<v-divider></v-divider>-->
                                <div v-if="checkVerifycode">
                                <v-row >
                                    <v-col cols="12">
                                        <div class="ma-auto" style="max-width: 100%; overflow: hidden">
                                            <v-otp-input
                                                    style="margin-left: 48px;"
                                                    inputClasses="otp-input"
                                                    ref="otpInput"
                                                    separator=" "
                                                    dark
                                                    width="100%"
                                                    :num-inputs="4"
                                                    :should-auto-focus="true"
                                                    :is-input-num="true"
                                                    @on-change="handleOnChange"
                                                    @on-complete="handleOnComplete"
                                            ></v-otp-input>
                                        </div>
                                    </v-col>
                                    <v-col cols="12" class="my-3">
                                        <v-btn @click="VerifiedDone" style="background-color:teal; width: 100%;" block :disabled="!isActive">Verified</v-btn>
                                    </v-col>
                                </v-row>
                                </div>


                                <div v-if="afterVerifiedCode">
                                    <form @submit.prevent="changePasswordDone" method="post">
                                        <v-row >
                                            <v-col cols="12">
                                                <v-text-field
                                                        v-model="pw1"
                                                              label="Password"
                                                              type="password"
                                                              :rules="pwdRules"
                                                                single-line
                                                ></v-text-field>

                                            </v-col>

                                            <v-col cols="12">
                                                <v-text-field v-model="pw2"
                                                              label="Confirm Password"
                                                              type="password"
                                                              single-line
                                                              :rules="pwdConfirm"
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-btn
                                                        style="background-color:teal; width: 100%;"
                                                        dark
                                                        text
                                                        type="submit"
                                                >
                                                    Submit
                                                </v-btn>
                                            </v-col>

                                        </v-row>
                                    </form>
                                </div>
                            </v-container>

                        </v-card-text>

                </v-card>
            </v-dialog>
        </v-row>


    </div>

</template>





<script>
    // import OtpInput from "@bachdgvn/vue-otp-input";
    //
    // Vue.component("v-otp-input", OtpInput);
import Register from './Register.vue'
    export  default {
        data(){
            return{
                checkPhone:true,
                checkVerifycode:false,
                afterVerifiedCode:false,

                form:{
                    phone:null,
                    password:null
                },

                code:{
                  phone:null,
                  account:''
                },
                dialogLogIn: false,
                value:'password',
                forgotPassword:false,
                otp: '',
                length: 4,
                isActive:false,
                checkif:false,
                pw1: "",
                pw2: "",
                pwdRules: [v => !!v || "Password required"],
                pwdConfirm: [
                    v => !!v || "Confirm password",
                    v => v === this.pw1 || "Passwords do not match"
                ]
            }
        },
        components:{
          Register
        },
        created(){
            EventBus.$on('loginFormClose', () =>{
                this.dialogLogIn = false;
                this.dialog1 = true;
            });
            EventBus.$on('loginOpen', ()=>{
                this.dialogLogIn = true;
            });

            EventBus.$on('checkAuthDoctorNow', ()=> {
                this.dialogLogIn = true;
            })
        },
        methods:{

            changePasswordDone(){
                const formData = new FormData;
                formData.set('phone',this.code.phone);
                formData.set('account',this.code.account);
                formData.set('password',this.pw1);
                axios.post('/api/user-change-password', formData)
                    .then(res =>{

                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            this.forgotPassword = false;
                            window.location='/';

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    })
                    .catch(error => console.log(error.respond.data));
            },
            VerifiedDone(){
                this.afterVerifiedCode = true;
                this.checkVerifycode = false;
            },
            handleOnComplete(value) {
                // console.log(this.code.phone);
                axios.get(`/api/user-code-check-active/${this.code.phone}`)
                    .then(res =>{
                        console.log(res.data);
                        if(res.data == value){
                            this.isActive = true;
                            // console.log('ok');
                        }else{
                            this.isActive = false;
                        }
                    })

                    .catch(error => console.log(error.respond.data));
                // console.log('OTP completed: ', value);
            },
            handleOnChange(value) {
                axios.get(`/api/user-code-check-active/${this.code.phone}`)
                    .then(res =>{
                        // console.log(res.data);
                        if(res.data == value){
                            this.isActive = true;
                            // console.log('ok');
                        }else{
                            this.isActive = false;
                        }
                    })

                    .catch(error => console.log(error.respond.data));
                // console.log('OTP changed: ', value);


            },
            login(){
                User.login(this.form);
            },
            // isActiveCod(){
            //
            // },

            codeSend(){
                var code = (Math.floor(Math.random() * 10000) + 10000).toString().substring(1);
                const formData = new FormData;
                formData.set('phone',this.code.phone);
                formData.set('account',this.code.account);
                formData.set('code',code);
                axios.post('/api/user-code-check', formData)
                    .then(res =>{

                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            this.checkPhone = false;
                            this.checkVerifycode = true;

                            var setMessage = 'Your Password reset Verification code is: '+code +' by Bvon Limited';

                            let details = {
                                number: this.code.phone,
                                message: setMessage,
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
                                .then(data => {console.log(data)});


                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    })
                    .catch(error => console.log(error.respond.data));




            },


            forgotClick(){
                this.forgotPassword = true;
                this.dialogLogIn = false;
            },

            doneoknow(){
                alert('doneok now');
            }
        },
        computed:{
            // isActiveCode () {
            //     return this.otp.length === this.length
            // }
        }
    }
</script>

<style lang="scss">
    .otp-input {
        width: 40px;
        height: 40px;
        padding: 5px;
        margin: 10px 10px;
        font-size: 20px;
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        text-align: center;
        &.error {
            border: 1px solid red !important;
        }
    }
    .otp-input::-webkit-inner-spin-button,
    .otp-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>