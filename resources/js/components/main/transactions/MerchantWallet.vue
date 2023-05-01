<template>
    <div>
        <div class="wallet-wrapper">
            <v-layout row wrap class="wallet-main-wrapper">
                <v-flex xs6 class="title-single">
                    <v-list-item-title class="title-title">Tk {{marchantBalance}}</v-list-item-title>
                    <span>Available Balance</span>
                </v-flex>

                <v-flex xs6 class="title-single">
                    <!--<p></p>-->
                    <v-btn @click="dialogSellMarchantAmountClick" >Sell Merchant Amount</v-btn>
                    <sell-marchant-amount :dialogSellMarchantAmount="dialogSellMarchantAmount" :users="getUserInfoDetails"></sell-marchant-amount>
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
    import SellMarchantAmount from './E-wallet/SellMarchantAmount'
    export default {
        name: "Ewallet",

        data(){
            return{
                lastPage:1,
                transactions:[],
                page:1,
                marchantBalance:null,
                getUserInfoDetails:null,
                dialogSellMarchantAmount:false
            }
        },
        methods:{

            dialogSellMarchantAmountClick(){
                this.dialogSellMarchantAmount = true;
            },
            async fetch(){
                let marchantwallet = await axios.get(`/api/vue-shopping-wallet/marchent-transactions?page=${this.page}`);

                this.transactions.push(...marchantwallet.data.transactions.data);
                this.lastPage = marchantwallet.data.transactions.last_page;
                this.marchantBalance = marchantwallet.data.marchantBalance;
                // this.shoppingBalance = marchantwallet.data.shoppingBalance;
                // this.shoppingWallet = marchantwallet.data.shoppingWallet;
                // console.log(marchantwallet);
            },

            handleScrollToBottom(isVisible){
                if(!isVisible) {return}
                if(this.page >= this.lastPage){return}
                this.page++;
                this.fetch();
            },

            getUserInfo(){
                axios.get('/api/get-user-info')
                    .then(res =>{
                       this.getUserInfoDetails = res.data;
                    });
            }

        },
        mounted() {
            this.fetch();
            setTimeout(() => {  this.getUserInfo(); }, 2000);
        },
        components:{
            SellMarchantAmount
        },
        created() {
            EventBus.$on('sellMarchantAmountClose', ()=>{
                this.dialogSellMarchantAmount = false;
            });

            EventBus.$on('sellMarchantAmountRequest', (e) => {
                this.fetch();
                this.transactions.unshift(e);
            });
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
