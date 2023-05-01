<template>
    <div>
        <loader v-if="isLoading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#ffffff" objectbg="#999793" opacity="100" disableScrolling="true" name="dots"></loader>

        <div class="wallet-wrapper">
            <v-layout row wrap class="wallet-main-wrapper">
                <v-flex xs4 class="title-single">
                    <v-list-item-title class="title-title">Tk {{shoppingBalance}}</v-list-item-title>
                    <span>Available Balance</span>
                </v-flex>

                <v-flex xs4 class="title-single">
                    <v-list-item-title class="title-title">Tk {{shoppingWallet}}</v-list-item-title>
                    <p @click="shoppingToBvonBalance" style="cursor: pointer;">Shopping Wallet Bvon Balance<v-icon style="cursor: pointer;">mdi-credit-card-multiple-outline</v-icon></p>
                    <shopping-wallet-to-bvon-balance :shoppingWalletToBvonBalance="shoppingWalletToBvonBalance" :merchantUsers="merchantUsers"></shopping-wallet-to-bvon-balance>
                </v-flex>

                <v-flex xs4 class="title-single">
                    <div @click="shoppingVoucherConvert">
                        <v-list-item-title class="title-title">Shopping Voucher Convert to E-wallet</v-list-item-title>
                        <span><v-icon style="cursor: pointer;">mdi-credit-card-check</v-icon></span>
                    </div>
                    <shopping-voucher-convert-to-e-wallet  :shoppingVoucherConvertToEWallet="shoppingVoucherConvertToEWallet"></shopping-voucher-convert-to-e-wallet>
                </v-flex>

                <v-flex xs12 class="second-main-wrapper">
                    <v-layout row wrap>
                        <v-flex xs12 sm12 class="second-title">
                            <h3>Recent Transaction</h3>
                        </v-flex>


                        <v-flex xs12 sm6 class="second-second-part" v-for="transaction in transactions" :key="transaction.id">
                            <v-layout row wrap>
                                <v-flex xs2 class="second-second-part-single">
                                    <v-icon v-if="transaction.amount_type === 'c'" class="second-second-icon">mdi-plus-circle</v-icon>
                                    <v-icon v-else style=" font-size: 25px; padding: 10px; background: red; border-radius: 50%;">mdi-minus-circle</v-icon>
                                </v-flex>
                                <v-flex xs7 class="second-second-part-single">
                                    <p>{{transaction.message}}</p>
                                    <span>{{transaction.check_date}}</span>
                                </v-flex>
                                <v-flex xs3>
                                    <p v-if="transaction.amount_type === 'c'">Tk {{transaction.amount}}</p>
                                    <p v-if="transaction.amount_type === 'd'" style="color: red;">Tk {{transaction.amount}}</p>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <div style="height: 55px; width: 100%;" v-if="transactions.length" v-observe-visibility="handleScrollToBottom"></div>
                    </v-layout>
                </v-flex>
            </v-layout>
        </div>

    </div>
</template>

<script>
    import ShoppingWalletToBvonBalance from './E-wallet/ShoppingWalletToBvonBalance';
    import ShoppingVoucherConvertToEWallet from './E-wallet/ShoppingVoucherConvertToEWallet';
    export default {
        name: "Ewallet",
        data(){
            return{
                shoppingBalance:null,
                shoppingWallet:null,
                transactions:[],
                isLoading:true,
                page:1,
                lastPage:1,
                shoppingWalletToBvonBalance:false,
                merchantUsers:[],
                shoppingVoucherConvertToEWallet: false
            }
        },
        methods:{
            shoppingVoucherConvert(){
              this.shoppingVoucherConvertToEWallet = true;
            },
            shoppingToBvonBalance(){
                this.shoppingWalletToBvonBalance = true;
            },

            async fetch(){
                let shoppingwallet = await axios.get(`/api/vue-shopping-wallet?page=${this.page}`);
                this.isLoading = false;
                this.transactions.push(...shoppingwallet.data.transactions.data);
                this.lastPage = shoppingwallet.data.transactions.last_page;
                this.shoppingBalance = shoppingwallet.data.shoppingBalance;
                this.shoppingWallet = shoppingwallet.data.shoppingWallet;
            },

            handleScrollToBottom(isVisible){
                if(!isVisible) {return}
                if(this.page >= this.lastPage){return}
                this.page++;
                this.fetch();
            },
        },
        mounted() {
            this.fetch();

            axios.get('/api/vue-shopping-wallet/marchent-users')
                .then(res => {
                    this.merchantUsers = res.data;
                })
        },
        created() {
            // axios.get('/api/vue-shopping-wallet')
            //     .then(res => {
            //         console.log(res.data);
            //         this.shoppingBalance = res.data.shoppingBalance;
            //         this.shoppingWallet = res.data.shoppingWallet;
            //         this.transactions = res.data.transactions;
            //     })
            //     .then(error => console.log(error.response.data))
            //     .finally(()=> this.isLoading = false);

            EventBus.$on('shoppingWalletToBvonBalanceClose', ()=>{
                this.shoppingWalletToBvonBalance = false;
            });

            EventBus.$on('shoppingWalletResponse', (e) => {
                this.fetch();
               this.transactions.unshift(e);
            });

            EventBus.$on('shoppingVoucherConvertToEWalletClose', () => {
                this.shoppingVoucherConvertToEWallet = false;
            });

        },

        components:{
            ShoppingWalletToBvonBalance,
            ShoppingVoucherConvertToEWallet
        }
    }
</script>

<style lang="scss" scoped>
    .wallet-wrapper{
        background: #009788;
        color: #fff;
        .wallet-main-wrapper{
            padding: 20px 0 20px 20px;
            .title-single{
                text-align: center;
                padding-bottom: 10px;
                padding-left: 40px;
                .title-title{
                }
            }

        }


        .second-part{
            padding-left: 40px;
            cursor: pointer;
            .second-icon{
                font-size: 25px;
                color: rgb(56, 56, 136);
                background-color: white;
                padding: 8px;
                border-radius: 50%;
            }

        }
        .second-main-wrapper{
            padding: 20px 0 30px 20px;
            margin-bottom: -8px;
            background: #fff;
            color: #000;
            margin-left: -8px;
            border-radius: 30px 30px  0 0;
            .second-title{
                h3{
                    color: #104D3E;
                    padding: 20px 0px 20px 40px;
                }
            }
        }


        .second-second-part{
            padding-left: 50px;
            height: 70px;
            .second-second-part-single{
                p{
                    margin-bottom: 0 !important;
                }
                .second-second-icon{
                    font-size: 25px;
                    padding: 10px;
                    background: #0000FF;
                    border-radius: 50%;
                }
            }
        }
    }

    @media only screen and (max-width: 768px) {
        .wallet-main-wrapper{
            .title-single{
                padding-bottom: 10px;
                padding-left: 0 !important;
            }
        }

        .second-part{
            padding-left: 0 !important;
        }

        .second-main-wrapper{
            .second-title{
                h3{
                    padding-left: 0 !important;
                }
            }
        }

        .second-second-part{
            padding-left: 10px !important;
        }
    }
</style>