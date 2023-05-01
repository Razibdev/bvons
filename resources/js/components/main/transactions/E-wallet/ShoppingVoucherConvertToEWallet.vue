<template>
    <v-row justify="center">
        <v-dialog
                v-model="shoppingVoucherConvertToEWallet"
                persistent
                max-width="400px"
        >
            <template v-slot:activator="{ on, attrs }">

            </template>
            <v-card>
                <v-form @submit.prevent="shoppingVoucherToEWalletRequest" method="post">
                    <v-card-title style="background: teal">
                        <span style="margin: auto; color:white;" class="text-h5">Shopping Voucher to E-wallet</span>
                        <v-icon style="float: right; cursor:pointer;" @click="shoppingVoucherConvertToEWalletClose">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                            label="Amount"
                                            single-line
                                            type="text"
                                            v-model="form.amount"

                                    ></v-text-field>
                                </v-col>


                                <v-col cols="12">
                                    <v-text-field
                                            label="Enter Password"
                                            single-line
                                            type="password"
                                            v-model="form.password"
                                    ></v-text-field>

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
                                @click="shoppingVoucherConvertToEWalletClose"
                                type="submit"
                        >
                           Convert
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    export default {
        name: "ShoppingVoucherConvertToEWallet",
        props:['shoppingVoucherConvertToEWallet'],
        data(){
          return{
              form:{
                  amount:null,
                  password:null
              }
          }
        },
        methods:{

            shoppingVoucherConvertToEWalletClose(){
                EventBus.$emit('shoppingVoucherConvertToEWalletClose')
            },

            shoppingVoucherToEWalletRequest(){
                axios.post('/api/vue-shopping-wallet/shopping-wallet-to-e-wallet', this.form)
                    .then(res => {
                        if(res.data.type === 'success') {
                            this.$store.dispatch('addNotification', {
                                type: 'success',
                                message: res.data.message
                            });
                            EventBus.$emit('shoppingWalletResponse', res.data.data);

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