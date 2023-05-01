<template>
    <div>
    <v-card v-if="registerv" max-width="400px" style="margin: 0 auto; margin-bottom: 20px">
        <v-card-title style="background: teal">
            <span style="margin: auto; color:white;" class="text-h5">Sign Up In Bvon</span>
        </v-card-title>
        <form @submit.prevent="register">
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                    label="Your Full Name"
                                    class="register-text-filled"
                                    single-line
                                    type="text"
                                    v-model="form.name"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12">
                            <v-text-field
                                    class="register-text-filled"
                                    label="01XXXXXXXXX (Mobile No)"
                                    single-line
                                    type="text"
                                    v-model="form.phone"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                    class="register-text-filled login-style"
                                    label="*******(Type Password)"
                                    single-line
                                    type="password"
                                    v-model="form.password"
                                    :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
                                    @click:append="() => (value = !value)"
                                    :type="value ? 'password' : 'text'"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12">
                            <v-text-field
                                    class="register-text-filled login-style"
                                    label="*******(Re-Type Password)"
                                    single-line
                                    type="password"
                                    v-model="form.passwordCode"
                                    :append-icon="scon ? 'mdi-eye' : 'mdi-eye-off'"
                                    @click:append="() => (scon = !scon)"
                                    :type="scon ? 'password' : 'text'"
                            ></v-text-field>
                        </v-col>


                        <v-col cols="12">
                            <v-text-field
                                    class="register-text-filled"
                                    label="Introducer A/C NO (Optional)"
                                    single-line
                                    type="text"
                                    v-model="form.introduce"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12">
                            <v-text-field
                                    class="register-text-filled"
                                    label="Dealer A/C NO (Optional)"
                                    single-line
                                    type="text"
                                    v-model="form.dealer"

                            ></v-text-field>
                        </v-col>


                        <v-col cols="12">
                            <v-text-field
                                    class="register-text-filled "
                                    label="Product Code (Optional) If You have?"
                                    single-line
                                    type="text"
                                    v-model.tirm="form.pincode"
                            ></v-text-field>
                        </v-col>

                    </v-row>
                    <v-divider></v-divider>
                </v-container>
            </v-card-text>
            <v-card-actions>

                <v-spacer></v-spacer>
                <v-btn
                        style="background-color:teal"
                        dark
                        text
                        type="submit"
                >
                    Sign Up
                </v-btn>
            </v-card-actions>
        </form>
    </v-card>

    <v-card v-if="registerverified" max-width="400px" style="margin: 0 auto; margin-bottom: 20px">
        <v-card-title style="background: teal">
            <span style="margin: auto; color:white;" class="text-h5">Sign Up In Bvon</span>
        </v-card-title>
        <v-card-text>
            <form @submit.prevent="registerComplete" method="post">
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
                        <v-btn type="submit" style="background-color:teal; width: 100%;" block :disabled="!isActive">Verified</v-btn>
                    </v-col>
                </v-row>
            </form>
        </v-card-text>
    </v-card>


    </div>
</template>

<script>
    export default {
        name: "ReferralUser",
        data(){
            return{
                form:{
                    name:null,
                    phone:null,
                    password:null,
                    passwordCode:null,
                    introduce:this.$route.params.id,
                    dealer:null,
                    pincode:null
                },
                value:'password',
                scon:'password',
                registerv:true,
                registerverified:false,
                isActive:false
            }
        },
        methods:{

            register(){
                var code = (Math.floor(Math.random() * 10000) + 10000).toString().substring(1);
                const formData = new FormData;
                formData.set('phone',this.form.phone);
                formData.set('pincode',this.form.pincode);
                formData.set('introduce',this.form.introduce);
                formData.set('code',code);
                let pas = this.form.password;
                let pasc = this.form.passwordCode;
                if(pas === pasc){
                    axios.post('/api/user-code-send-for-register', formData)
                        .then(res =>{

                            if(res.data.type === 'success') {
                                this.$store.dispatch('addNotification', {
                                    type: 'success',
                                    message: res.data.message
                                });


                                this.registerv = false;
                                this.registerverified = true;

                                var setMessage = 'Your account Verification code is: '+code +' by Bvon Limited';

                                let details = {
                                    number: this.form.phone,
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


                            }
                            else{
                                this.$store.dispatch('addNotification', {
                                    type: 'error',
                                    message: res.data.message
                                });
                            }
                        })
                        .catch(error => console.log(error.respond.data));
                }
                else{
                    this.$store.dispatch('addNotification', {
                        type: 'error',
                        message: 'Password Not Match'
                    });
                }

            },
            registerComplete(){
                User.register(this.form);
                this.dialog1 = false;
            },

            handleOnComplete(value) {
                // console.log(this.code.phone);
                axios.get(`/api/user-code-check-active/${this.form.phone}`)
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
        },
        created() {
            console.log(this.valued);

        },
        computed:{
            // introduce(){
            //     return this.$route.params.id;
            // },
        }
    }
</script>

<style scoped>

</style>