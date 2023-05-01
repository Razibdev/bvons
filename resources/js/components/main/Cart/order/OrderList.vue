<template>
    <v-card>
        <v-card-title>
            Order List
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
                        :headers="headers"
                        :items="items"
                        :search="search"
                        disable-pagination
                        :hide-default-footer="true"
                        class="elevation-1"
                        :mobile-breakpoint="0"

                >
                    <template v-slot:[`item.actions`]="{ item }">


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
                                                <v-cart-title style="margin-top:10px"> Order Details</v-cart-title>
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
                                                                Date and Time
                                                            </th>

                                                            <th class="text-left">
                                                               Price
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="product in single" :key="product.id">
                                                            <td>{{product.product.product_name}}</td>
                                                            <td>{{product.size}}</td>
                                                            <td>{{product.product_quantity}}</td>
                                                            <td>{{product.created_at}}</td>
                                                            <td>{{product.product_price}}</td>
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
        data () {
            return {
                search: '',
                orderDetailsShow: {},
                headers: [
                    {
                        text: 'Order Number',value: 'order_serial',
                    },
                    { text: 'Amount', value: 'order_amount' },
                    { text: 'Status', value: 'order_status'},
                    { text: 'Payment Status', value: 'payment_status' },
                    { text: "Actions", value: "actions", sortable: false },
                ],

            }
        },
        methods:{
            desserts(){
                this.$store.dispatch('getOrderList', User.id());
            },

            detailsShowOrder(id){
                this.$store.dispatch('detailsShowOrder', id);
            },

            cancelOrder(id){
                this.$confirm("Are you sure? You want to cancel the order?").then(() => {
                    this.$store.dispatch('cancelOrder',id);
                    this.desserts();
                });
            },

            closeDetails(id){
                this.orderDetailsShow[id] = false;
            }

        },

        computed:{
            items(){
                return this.$store.state.orderList;
            },

            detailsOrderShowPrice(){
              return this.$store.getters['detailsOrderShowPrice'];
            },

            single(){
                return this.$store.state.detailsOrderShow;
            },

        },
        created(){
            this.desserts();
            this.detailsShowOrder();
        },

        mounted() {

        },

    }
</script>

<style scoped>

</style>



