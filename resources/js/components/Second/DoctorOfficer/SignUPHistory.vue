<template>
    <div >
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
                :items="targetList"
                :search="search"
                class="elevation-1"
        >
            <template #item="{ item }">
                <tr>
                    <td>{{ item.id }}</td>
                    <td><img v-if="item.profile_pic" :src="getImageUrl(item.id, item.profile_pic)" width="100px" height="100px" alt=""> </td>
                    <td>{{ item.name }}</td>
                    <td>{{item.referral_id}}</td>
                    <td>{{item.phone}}</td>
                    <td>{{ new Date(item.created_at).toLocaleDateString() }}</td>

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
                        text: 'Image',
                        value: 'image'
                    },
                    {
                        text: 'Name',
                        value: 'name'
                    },


                    {
                        text: 'Account',
                        value: 'referral_id'
                    },

                    {
                        text: 'Phone',
                        value: 'phone'
                    },

                    {
                        text: 'Date',
                        value: 'created_at'
                    },


                ],

                targetList:[],
                type: ''

            }
        },

        created(){
            axios.get('/api/bvon-doctor/section/bvon-doctor-officer-signup-list/'+User.id())
                .then(res => {
                    this.targetList = res.data;
                    // this.countrow = res.data.countrow;
                    console.log(res.data);
                    // this.type = res.data.type;
                });
        },

        computed:{

        },
        methods:{
            getImageUrl(id, image){
                return '/media/user/profile_pic/'+id+'/'+image;
            },


        }
    }

</script>

<style scoped>

</style>