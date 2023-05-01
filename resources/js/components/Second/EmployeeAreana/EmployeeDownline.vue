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
                    <td><p style="cursor:pointer; text-decoration: underline;" @click="employDownline(item.user.referral_id)">{{ item.user.name }}</p> </td>
                    <td>{{item.user.phone}}</td>
                    <td>{{item.referral_id}}</td>

                </tr>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "EmployeeDownline",
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
                        value: 'user.name',
                    },

                    {
                        text: 'PHONE',
                        value: 'user.phone'
                    },

                    {
                        text: 'USER A/C NO',
                        value: 'referral_id'
                    },

                ],

                employAreaNa:[],

            }
        },

        created(){
            axios.get('/api/dealer/employee/user-employee-downline')
                .then(res => {
                    this.employAreaNa = res.data;

                    console.log(res.data);
                });
        },

        computed:{

        },
        methods:{
            getImgUrl(id, image){
                return '/media/user/profile_pic/'+id+'/'+image;
            },

         

            employDownline(id){
                axios.get(`/api/dealer/employee-employee-downline/${id}`)
                    .then(res => {
                        this.employAreaNa = res.data.data;
                        window.location = '/dealer/employee-employee-downline/'+res.data.referral_id;
                    });
            },


        }
    }
</script>

<style scoped>

</style>