
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
                :items="employAreaNa"
                :search="search"
                class="elevation-1"
        >
            <template #item="{ item }">
                <tr>
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td><img :src="getImgUrl(item.id,item.profile_pic)" width="100" height="100" alt=""> </td>
                    <td>{{item.phone}}</td>
                    <td>{{item.referral_id}}</td>
                    <td v-if="item.referral_id != null"><p v-if="countrow[item.id] != 0 && countrow[item.id] != [] ">{{countrow[item.id]}} <router-link :to="orderrouterlink(item.referral_id)">View Details</router-link></p></td>
                </tr>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "EmployeeAreanaDetails",
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
                        text: 'Name',
                        value: 'name',
                    },
                    { text: 'Image',
                        value: 'profile_pic',

                    },
                    {
                        text: 'PHONE',
                        value: 'phone'
                    },

                    {
                        text: 'USER A/C NO',
                        value: 'referral_id'
                    },

                    {
                        text: 'TOTAL USER',
                        value: 'delivery_date'
                    },


                ],

                employAreaNa:[],
                countrow:[],

            }
        },

        created(){
            axios.get('/api/dealer/employee-employee-area-na/'+this.$route.params.id)
                .then(res => {
                    this.employAreaNa = res.data.data;
                    this.countrow = res.data.countrow;
                    console.log(res.data);
                });

            console.log(this.$route.params.id);
            console.log('ok');
        },

        computed:{
            // countReferral: (app)=> (salut)=> {
            //     axios.get('/api/dealer/employee/employee-area-na/'+salut)
            //         .then(res => {
            //             // console.log(res.data);
            //             // this.count = res.data;
            //             return res.data;
            //         });
            // }
        },
        methods:{
            getImgUrl(id, image){
                return '/media/user/profile_pic/'+id+'/'+image;
            },

            // totalUserCount(id){
            //     axios.get('/api/dealer/employee/employee-area-na/'+id)
            //         .then(res => {
            //             // console.log(res.data);
            //             this.referral = res.data.referral_id;
            //             this.count = res.data.count;
            //             // console.log(this.referral);
            //
            //         });
            // },


            orderrouterlink(id) {
                return "/dealer/employee/employee-area-na/"+id;
            }

        }
    }
</script>

<style scoped>

</style>