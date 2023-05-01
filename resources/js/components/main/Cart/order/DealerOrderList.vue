<template>
    <v-card>
        <v-card-title>
           Dealer Order List
            <v-spacer></v-spacer>
            <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line

            ></v-text-field>
        </v-card-title>
        <v-layout row wrap>
            <v-flex style="overflow-x: auto">
                <v-data-table
                        :mobile-breakpoint="0"
                        mobile-breakpoint="0"
                        :headers="headers"
                        :items="items"
                        :search="search"
                        class="elevation-1"

                >
                    <template #item="{ item }">
                        <tr>
                            <td>{{item.id}}</td>
                            <td>{{item.serial}}</td>
                            <td>{{item.pin}}</td>
                            <td>{{item.amount}}</td>
                            <td> <span v-if="item.status === 'cancel'">Canceled</span> <span v-else >{{item.status}}</span> </td>
                            <td>
                                <v-dialog
                                        v-model="orderDetailsShow[item.id]"
                                        width="980"
                                        style="overflow: hidden"
                                        height="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                                color="red lighten-2"
                                                dark
                                                v-bind="attrs"
                                                v-on="on"
                                                @click="detailsShowOrder(item.id)"
                                        >
                                            Details
                                        </v-btn>
                                    </template>

                                    <v-card style="overflow: hidden; height: 100%; width: 100%;">
                                        <v-card-text style="overflow:hidden">
                                            <v-layout row wrap style="padding-top:30px; padding-left: 20px; font-size: 18px;">
                                                <v-flex xs12 md12>
                                                    <v-card-title style="margin-top:10px">Order Details</v-card-title>
                                                    <v-spacer></v-spacer>
                                                    <v-icon style="float: right; top: -17px; color: #000 !important; cursor:pointer" @click="closeDetails(item.id)">mdi-close</v-icon>

                                                </v-flex>
                                            </v-layout>
                                            <v-layout row wrap >
                                                <v-flex xs12 md12>

                                                    <v-simple-table>

                                                        <template v-slot:default>

                                                            <thead>
                                                            <tr>
                                                                <th>
                                                                    ID
                                                                </th>
                                                                <th class="text-left">
                                                                    Product Name
                                                                </th>
                                                                <th class="text-left">
                                                                    Product Size
                                                                </th>

                                                                <th class="text-left">
                                                                    Quantity
                                                                </th>

                                                                <th class="text-left">
                                                                    Date
                                                                </th>

                                                                <th class="text-left">
                                                                    Time
                                                                </th>

                                                                <th class="text-left">
                                                                    Price
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="product in single" :key="product.id">
                                                                <td>1</td>
                                                                <td>

                                                                    {{product.product_name}}
                                                                    <!--{{orderProductName(product.product_json[0])}}-->
                                                                    <!--<ul>-->
                                                                    <!--<li v-for="itemss in product.product_json[1].product_details" :key="itemss.id"> {{itemss}}</li>-->
                                                                    <!--</ul>-->
                                                                </td>
                                                                <td>{{product.product_size}}</td>
                                                                <td>{{product.quantity}}</td>
                                                                <td>{{ new Date(product.created_at).toLocaleDateString()  }}</td>
                                                                <td>{{ new Date(product.created_at).toLocaleTimeString() }}</td>
                                                                <td>{{product.price}}</td>
                                                            </tr>
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <td colspan="4" style="text-align:right;">Total Price : </td>
                                                                <td>{{detailsOrderShowPrice}}</td>
                                                            </tr>
                                                            </tfoot>
                                                        </template>
                                                    </v-simple-table>

                                                </v-flex>

                                            </v-layout>
                                        </v-card-text>
                                    </v-card>
                                </v-dialog>

                                <span v-if="item.order_status !== 'complete'">
                                <v-btn v-if="item.order_status !== 'cancel'"  @click="cancelOrder(item.id)">Cancel</v-btn>
                        </span>

                            </td>
                        </tr>






                        <!--<v-btn @click="deleteTutorial(item.id)">-->
                        <!---->
                        <!--</v-btn>-->

                    </template>



                </v-data-table>
            </v-flex>
        </v-layout>
    </v-card>
</template>

<script>
    export default {
        name:'DealerOrderList',
        data () {
            return {
                search: '',
                orderDetailsShow: {},
                headers: [
                    {
                        text: 'S/N',value: 'id',
                    },
                    {
                        text: 'Order Number',value: 'serial',
                    },
                    { text: 'Pin', value: 'pin' },
                    { text: 'Amount', value: 'amount' },
                    { text: 'Status', value: 'status'},
                    { text: "Actions", value: "actions", sortable: false },
                ],

            }
        },
        methods:{
            orderProductName(orderlist){
                // console.log(orderlist[0]['order_details']);
                // return orderlist[0]['order_details'];
                // orderlist.forEach(item =>{
                //     return item;
                // });
               // orderlist.forEach(item =>{
               //     console.log(item);
               // })

                // for (var make in orderlist[1].product_details) {
                //     console.log(orderlist[1].product_details['id']);
                //     return orderlist[make];
                //     // for (var model in orderlist[make]) {
                //     //     return orderlist[make][model].product_name;
                //     //
                //     // }
                // }
            },
            desserts(){
                this.$store.dispatch('getDealerOrderList');
            },

            detailsShowOrder(id){
                this.$store.dispatch('dealerDetailsShowOrder', id);
            },

            cancelOrder(id){
                this.$confirm("Are you sure? You want to cancel the order?").then(() => {
                    this.$store.dispatch('cancelDealerOrder',id);
                    this.desserts();
                });
            },

            closeDetails(id){
                this.orderDetailsShow[id] = false;
            }

        },

        computed:{
            items(){
                return this.$store.state.dealerOrderList;
            },

            detailsOrderShowPrice(){
                return this.$store.getters['dealerDetailsOrderShowPrice'];
            },

            single(){
                return this.$store.state.dealerDetailsOrderShow;
            },

        },
        created(){
            this.desserts();
            this.detailsShowOrder();
            console.log(this.$store.state.dealerDetailsOrderShow)
        },

        mounted() {

        },

    }
</script>

<style scoped>

</style>



