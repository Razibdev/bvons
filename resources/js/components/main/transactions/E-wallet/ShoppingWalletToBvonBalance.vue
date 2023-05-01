<template>
    <div>
        <v-row justify="center">
            <v-dialog
                    v-model="shoppingWalletToBvonBalance"
                    persistent
                    max-width="400px"
            >
                <template v-slot:activator="{ on, attrs }">

                </template>
                <v-card>
                    <v-form @submit.prevent="shoppingWalletBvonBalanceSubmit" method="post">
                        <v-card-title style="background: teal">
                            <span style="margin: auto; color:white;" class="text-h5">Shopping Wallet Bvon Balance</span>
                            <v-icon style="float: right; cursor:pointer;" @click="shoppingWalletToBvonBalanceClose">mdi-close</v-icon>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" class="withdraw-select-payment">
                                        <v-select
                                                :items="merchantUsers"
                                                label="Choose Payment Method"
                                                solo
                                                :item-text="getFieldText"
                                                item-value="user_id"
                                                v-model="form.username"
                                        ></v-select>
                                    </v-col>
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
                                    @click="shoppingWalletToBvonBalanceClose"
                                    type="submit"
                            >
                                Add Payment
                            </v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
</template>

<script>
    export default {
        name: "ShoppingWalletToBvonBalance",
        props:['shoppingWalletToBvonBalance', 'merchantUsers'],
        data(){
          return{
              items:['shop'],
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
                return `${item.merchant_name} - ${item.referral_id}`
            },
            shoppingWalletToBvonBalanceClose(){
                EventBus.$emit('shoppingWalletToBvonBalanceClose');
            },

            shoppingWalletBvonBalanceSubmit(){
                axios.post('/api/vue-shopping-wallet/shopping-wallet-to-bvon-balance', this.form)
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
                    });
            }



        }
    }
</script>

<style scoped>

</style>