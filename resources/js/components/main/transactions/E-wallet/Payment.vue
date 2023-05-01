<template>
    <v-row justify="center">
        <v-dialog
                v-model="dialogPayment"
                persistent
                max-width="400px"
        >
            <template v-slot:activator="{ on, attrs }">

            </template>
            <v-card>
                <form @submit.prevent="paymentRequest" method="post">
                    <v-card-title style="background: teal">
                        <span style="margin: auto; color:white;" class="text-h5">Payment</span>
                        <v-icon style="float: right; cursor:pointer;" @click="paymentClose">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="withdraw-select-payment">
                                    <v-select
                                            :items="merchantUsers"
                                            label="Merchent User Account"
                                            solo
                                            item-value="user_id"
                                            :item-text="getFieldText"
                                            v-model="form.username"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                            label="Enter amount more then 100"
                                            single-line
                                            type="text"
                                            v-model="form.amount"

                                    ></v-text-field>
                                </v-col>


                                <v-col cols="12">
                                    <v-text-field
                                            label="Password"
                                            class="login-style"
                                            single-line
                                            :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
                                            @click:append="() => (value = !value)"
                                            :type="value ? 'password' : 'text'"
                                            v-model="form.password"
                                    ></v-text-field>
                                    <!--<v-icon style="color: #000; position: absolute; right: 17px; top: 30px;" @click="showLoginPassword">{{passwordShow}}</v-icon>-->
                                </v-col>
                            </v-row>
                            <v-divider></v-divider>
                        </v-container>

                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                                style="background-color:teal;"
                                dark
                                type="submit"
                                @click="paymentClose"
                        >
                            Payment
                        </v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    export default {
        name: "Payment",
        props:['dialogPayment', 'merchantUsers'],
        data(){
            return{
                items:['Merchent user account'],
                value:'password',
                form:{
                    username:null,
                    amount:null,
                    password:null
                }
            }
        },
        methods:{
            getFieldText (item)
            {
                return `${item.merchant_name} - ${item.merchant_account}`
            },
            paymentRequest(){
                axios.post('/api/vue-wallet/send-payment-request-marchent', this.form)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            EventBus.$emit('sendBalanceRequest', res.data.data);

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }
                    })
                    .catch(error => console.log(error.response.data))
            },
            paymentClose(){
                EventBus.$emit('paymentClose');
            }
        }
    }
</script>

<style scoped>

</style>