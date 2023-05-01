<template>
    <div >
        <v-card>
            <v-card-title>
                <h4>Downline: {{totaloff}}</h4>
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
                :items="targetList"
                :search="search"
                class="elevation-1"
        >
            <template #item="{ item }">
                <tr>
                    <td>{{ item.id }}</td>
                    <td>{{item.register_date}}</td>
                    <td>{{ item.month_name }}</td>
                    <td>{{item.count}}</td>
                    <td>{{target}}</td>
                    <td>{{percentage(item.count)}}</td>
                    <!--<td><router-link :to="orderrouterlink(item.user_id)">View SignUp Details</router-link></td>-->

                </tr>
            </template>
        </v-data-table>
    </div>
</template>



<script>
    export default {
        name: "TargetHistory",
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
                        text: 'Date',
                        value: 'delivery_date'
                    },
                    {
                        text: 'Month',
                        value: 'month'
                    },


                    {
                        text: 'Current Reg',
                        value: 'current_reg'
                    },

                    {
                        text: 'Target',
                        value: 'target'
                    },

                    {
                        text: 'Percentage',
                        value: 'percentage'
                    }

                    // {
                    //     text: 'Action',
                    //     value: 'action'
                    // },


                ],

                targetList:[],
                type: '',
                totaloff:0

            }
        },

        created(){
            axios.get('/api/bvon-doctor/section/target-list')
                .then(res => {
                    this.targetList = res.data.data;
                    // this.countrow = res.data.countrow;
                    console.log(res.data);
                    this.type = res.data.type;
                    this.totaloff = res.data.all;
                });
        },

        computed:{
            target(){
                if(this.type ==='district'){
                    return 1500;
                }else if(this.type === 'upazilla'){
                    return 300;
                }else if(this.type ==='field'){
                    return 30
                }
            }
        },
        methods:{

            // targetrouterlink(id, id1, id2) {
            //     if(this.type ==='district'){
            //         return "/dealer/account-order/bvon-doctor-officer-target-list-monthly-history/"+id+'/district';
            //     }else if(this.type === 'upazilla'){
            //         return "/dealer/account-order/bvon-doctor-officer-target-list-monthly-history/"+ id1 +'/upazilla';
            //     }else if(this.type ==='field'){
            //         return "/dealer/account-order/bvon-doctor-officer-target-list-monthly-history/"+ id2 +'/field';
            //     }
            //
            // },

            percentage(count){
                if(this.type ==='district'){
                    var target =  1500;
                }else if(this.type === 'upazilla'){
                    var target =  300;
                }else if(this.type ==='field'){
                    var target =  30
                }
                var percentage = (count / target) * 100;
                return percentage.toFixed(2);
            },




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


            // orderrouterlink(id) {
            //     return "/dealer/account-order/bvon-doctor-officer-signup-list/"+id;
            // }

        }
    }

</script>

<style scoped>

</style>