<template>
    <div>
        <loader v-if="isLoading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#ffffff" objectbg="#999793" opacity="100" disableScrolling="true" name="dots"></loader>
        <div class="wallet-wrapper">
            <v-layout row wrap class="wallet-main-wrapper">
                <v-flex xs6 class="title-single">
                    <v-list-item-title class="title-title">Tk {{balance}}</v-list-item-title>
                    <span>Available Balance</span>
                </v-flex>

                <v-flex xs6 class="title-single">
                    <v-list-item-title class="title-title">Tk {{pending_balance}}</v-list-item-title>
                    <span>Pending for Withdraw</span>
                </v-flex>

                <v-flex xs3 class="second-part" @click="dialogWithdrawMethod">
                    <v-icon class="second-icon">mdi-card-account-details</v-icon>
                    <p>Withdraw</p>
                    <withdraw :dialogWithdraw="dialogWithdraw"></withdraw>
                </v-flex>
                <v-flex xs3 class="second-part" @click="dialogSendBalances">
                    <v-icon class="second-icon">mdi-send</v-icon>
                    <p>Send</p>
                    <send-balance :dialogSendBalance="dialogSendBalance" :users="users"></send-balance>
                </v-flex>
                <v-flex xs3 class="second-part" @click="dialogPayments">
                    <v-icon class="second-icon">mdi-credit-card</v-icon>
                    <p>Payment</p>
                    <payment :dialogPayment="dialogPayment" :merchantUsers="merchantUsers"></payment>
                </v-flex>
                <v-flex xs3 class="second-part">
                    <v-icon class="second-icon">mdi-history</v-icon>
                    <p>History</p>
                </v-flex>

                <v-flex xs12 class="second-main-wrapper">
                    <v-layout row wrap>
                        <v-flex xs12 sm12 class="second-title">
                            <h3>Recent Transaction</h3>
                        </v-flex>
                        <v-flex xs12 sm6 class="second-second-part" v-for="(transaction, index) in transactions" :key="index">
                            <v-layout row wrap>
                                <v-flex xs2 class="second-second-part-single">
                                    <v-icon v-if="transaction.amount_type === 'c'" class="second-second-icon">mdi-plus-circle</v-icon>
                                    <v-icon v-else style=" font-size: 25px; padding: 10px; background: red; border-radius: 50%;">mdi-minus-circle</v-icon>
                                </v-flex>
                                <v-flex xs7 class="second-second-part-single">
                                    <p>{{transaction.message}}</p>
                                    <span>{{transaction.created_at}}</span>
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
    import Withdraw from './E-wallet/Withdraw'
    import SendBalance from './E-wallet/SendBalance'
    import Payment from './E-wallet/Payment'
    export default {
        name: "Ewallet",
        data(){
            return{
                balance:null,
                pending_balance:null,
                transactions:[],
                isLoading:true,
                page: 1,
                lastPage:1,
                users:[],
                payments:[],
                merchantUsers:[],
                dialogWithdraw: false,
                dialogSendBalance:false,
                dialogPayment:false

            }
        },
        methods:{
            async fetch(){
                let ewallet = await axios.get(`/api/vue-wallet?page=${this.page}`);
                // console.log(ewallet);
                // console.log(ewallet.data.transactions.data);
                this.transactions.push(...ewallet.data.transactions.data);
                this.lastPage = ewallet.data.transactions.last_page;
                this.balance = ewallet.data.balance;
                this.pending_balance = ewallet.data.pending_balance;
                this.isLoading = false;

            },
            dialogWithdrawMethod(){
                this.dialogWithdraw = true;
            },

            dialogSendBalances(){
                this.dialogSendBalance = true;
            },
            dialogPayments(){
                this.dialogPayment = true;
            },
            handleScrollToBottom(isVisible){
                if(!isVisible) {return}
                if(this.page >= this.lastPage){return}
                this.page++;
                this.fetch();
            },

            allType(){
                axios.get('/api/vue-wallet/users')
                    .then(res => {
                        this.users = res.data.users;
                        this.payments = res.data.payments;
                        this.merchantUsers = res.data.merchantUsers;
                        // console.log(res.data.merchantUsers)
                    })
                    .catch(error => console.log(error.response.data))
            }

        },
        mounted(){
            this.fetch();
            setTimeout(() => {  this.allType(); }, 2000);
        },
        created() {
            EventBus.$on('withdrawCloses', () => {
                this.dialogWithdraw = false;
            });

            EventBus.$on('sendBalanceClose', () => {
                this.dialogSendBalance = false;
            });

            EventBus.$on('paymentClose', ()=>{
                this.dialogPayment = false;
            });
            EventBus.$on('withdrawRequest', () => {
                this.fetch();
            });

            EventBus.$on('sendBalanceRequest', (e)=>{
                this.fetch();
                this.transactions.unshift(e);
            })


            // axios.get('/api/vue-wallet')
            //     .then(res => {
            //         // console.log( res.data);
            //         // console.log(res.data.balance);
            //         // console.log(res.data.pending_balance);
            //         this.balance = res.data.balance;
            //         this.pending_balance = res.data.pending_balance;
            //         this.transactions = res.data.transactions;
            //         // console.log(this.transactions);
            //     })
            //     .catch(error => console.log(error.response.data))
            //     .finally(()=> this.isLoading = false);
        },
        components:{
            Withdraw,
            SendBalance,
            Payment

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