<template>
    <v-row justify="center">
        <v-dialog
                v-model="dialogSellMarchantAmount"
                persistent
                max-width="400px"
        >
            <template v-slot:activator="{ on, attrs }">

            </template>
            <v-card>
                <form @submit.prevent="sendMarchantAmountRequest" method="post">
                    <v-card-title style="background: teal">
                        <span style="margin: auto; color:white;" class="text-h5">Send Balance</span>
                        <v-icon style="float: right; cursor:pointer;" @click="sellMarchantAmountClose">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="withdraw-select-payment">
                                    <v-select
                                            :items="users"
                                            label="Choose Payment Method"
                                            solo
                                            :item-text="getFieldText"
                                            item-value="id"
                                            v-model="form.username"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                            label="Enter Amount"
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
                                text
                                @click="sellMarchantAmountClose"
                                type="submit"
                        >
                            Send Balance
                        </v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    export default {
        name: "SellMarchantAmount",
        props:['dialogSellMarchantAmount', 'users'],
        data(){
            return{
                form:{
                    username:null,
                    amount:null,
                    password:null
                },
                value:'password'
            }
        },

        methods:{
            getFieldText (item)
            {
                return `${item.name} - ${item.referral_id}`
            },
            sellMarchantAmountClose(){
                EventBus.$emit('sellMarchantAmountClose');
            },

            sendMarchantAmountRequest(){
                axios.post('/api/vue-marchann-wallet/marchent-transactions-request', this.form)
                    .then(res => {

                    if(res.data.type === 'success') {
                        this.$store.dispatch('addNotification', {
                            type: 'success',
                            message: res.data.message
                        });
                        EventBus.$emit('sellMarchantAmountRequest', res.data.data);

                    }else{
                        this.$store.dispatch('addNotification', {
                            type: 'error',
                            message: res.data.message
                        });
                    }

               })
            }
        }


    }
</script>

<style scoped>

</style>