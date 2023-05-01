<template>
    <div>
        <v-card>
            <v-card-title>
                <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        placeholder="Search....."
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
        </v-card>

        <v-data-table
                mobile-breakpoint="0"
                :headers="headers"
                :items="processingOrder"
                :search="search"
                class="elevation-1"
        >
            <template #item="{ item }">
                <tr>
                    <td>{{ item.id }}</td>
                    <td>{{ item.order_serial }}</td>
                    <td>
                        <table style="background: #0a0a0a; color: #ffffff;">
                            <tr>
                                <td>Customer Name</td>&nbsp;
                                <td>{{item.order_user.name}}</td>
                            </tr>
                            <tr>
                                <td>Customer Phone</td> &nbsp;
                                <td>{{item.order_user.phone}}</td>
                            </tr>
                        </table>
                    </td>
                    <td>{{item.order_amount}}</td>
                    <td>{{item.order_status}}</td>
                    <td>{{item.delivery_date}}</td>
                    <td><router-link :to="orderrouterlink(item.id)">View Details</router-link></td>

                </tr>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "ProcessingOrder",
        data () {
            return {
                search: '',
                headers: [
                    {
                        text: '#',
                        align: 'start',
                        value: 'id',
                    },
                    {
                        text: 'ORDER SERIAL',
                        value: 'order_serial',
                    },
                    { text: 'CUSTOMER INFO',
                        value: 'order_user',

                    },
                    {
                        text: 'ORDER AMOUNT',
                        value: 'order_amount'
                    },

                    {
                        text: 'ORDER STATUS',
                        value: 'order_status'
                    },

                    {
                        text: 'ORDER DATE',
                        value: 'delivery_date'
                    },
                    {
                        text: 'ACTION',
                        value:'action'
                    }

                ],

                processingOrder:[]
            }
        },

        created(){
            axios.get('/api/dealer/account/processing-order-dealer')
                .then(res => {
                    this.processingOrder = res.data;
                    console.log(res.data);
                });
        },
        computed:{

        },
        methods:{
            orderrouterlink(id) {
                return "/dealer/account-order/details/"+id;
            }
        }
    }
</script>

<style scoped>

</style>