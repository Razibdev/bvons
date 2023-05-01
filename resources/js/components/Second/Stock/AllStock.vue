<template>
    <div style="padding-left: 20px">
        <v-card >
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
                :items="allStock"
                :search="search"
                class="elevation-1"
        >
            <template #item="{ item }">
                <tr>
                    <td>{{ item.id }}</td>
                    <td> <span v-if="item.media != null"> <img :src="getImgUrl(item.media.product_image)" width="100" height="100" alt="" ></span></td>
                    <td > <span v-if="item.product != null"> {{item.product.product_name}}</span></td>
                    <td> <span>{{item.quantity}}</span></td>
                    <td><v-btn color="primary" @click="addPurchase">Add Purchase</v-btn></td>

                </tr>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "AllStock",
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
                        text: 'Product Image',
                        value: 'product_image',
                    },
                    {
                        text: 'Product Name',
                        value: 'product.product_name',
                    },
                    { text: 'Quantity',
                        value: 'quantity',
                    },
                    {
                        text: 'Action',
                        value: 'action'
                    },

                ],

                allStock:[]
            }
        },

        methods:{
            getImgUrl(image){
                return '/storage/'+image;
            },

            addPurchase(){
                alert('This service coming soon......');
            }
        },

        created(){
            console.log('ok');
            axios.get('/api/dealer/stock/all-stock')
                .then(res => {
                    this.allStock = res.data;
                    console.log(res.data);
                }).catch(error => console.log(error.response.data));
        },
        computed:{


        },

    }
</script>

<style scoped>

</style>