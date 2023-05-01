<template>
    <v-row justify="center">
        <v-dialog
                v-model="dialogWithdraw"
                persistent
                max-width="400px"
        >
            <template v-slot:activator="{ on, attrs }">

            </template>
            <v-card>
                <form @submit.prevent="withdraw" method="post">
                    <v-card-title style="background: teal">
                        <span style="margin: auto; color:white;" class="text-h5">Withdraw Balance</span>
                        <v-icon style="float: right; cursor:pointer;" @click="closeWithdraw">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="withdraw-select-payment">
                                    <v-select
                                            :items="getPaymentMethod"
                                            label="Choose Payment Method"
                                            :item-text="getFieldText"
                                            item-value="id"
                                            solo
                                            v-model="form.withdraw_method"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                            label="Enter Amount more then 800 tk"
                                            single-line
                                            type="text"
                                            v-model="form.withdraw_amount"
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
                                            v-model="form.withdraw_password"
                                    ></v-text-field>
                                    <!--<v-icon style="color: #000; position: absolute; right: 17px; top: 30px;" @click="showLoginPassword">{{passwordShow}}</v-icon>-->
                                </v-col>
                            </v-row>
                            <v-divider></v-divider>
                        </v-container>

                    </v-card-text>
                    <v-card-actions>
                        <div >
                            <add-payment ></add-payment>
                        </div>
                        <v-spacer></v-spacer>
                        <v-btn
                                style="background-color:teal;"
                                dark
                                text
                                @click="closeWithdraw"
                                type="submit"
                        >
                            Withdraw
                        </v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    import AddPayment from './AddPayment';
    export default {
        name: "Withdraw",
        props:['dialogWithdraw'],
        data: () => ({
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            value:'password',
            getPaymentMethod: [],
            form:{
                withdraw_method:null,
                withdraw_amount:null,
                withdraw_password:null
            }
        }),
        methods:{
            getFieldText (item)
            {
                return `${item.name} - ${item.details}`
            },
            closeWithdraw(){
                EventBus.$emit('withdrawCloses');
            },
            withdraw(){
                axios.post('/api/vue-wallet/get-payment-withdraw-request', this.form)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            EventBus.$emit('withdrawRequest')

                        }else{
                            this.$store.dispatch('addNotification', {
                                type: 'error',
                                message: res.data.message
                            });
                        }

                    });
            }
        },
        created() {

        },
        components:{
            AddPayment
        },
        mounted() {
            axios.get('/api/vue-wallet/get-payment-method/'+ User.id())
                .then(res => {
                    console.log(res.data);
                    this.getPaymentMethod = res.data;
                })
        }
    }

</script>

<style lang="sass" scoped>

</style>
<style>

</style>