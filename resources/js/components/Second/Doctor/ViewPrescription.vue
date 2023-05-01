<template>
    <div>
        <v-card class="mx-auto" color="deep-purple lighten-1" height="100vh" >
            <v-layout row wrap style="text-align: center; align-items: center;">
                <v-flex xs12 >
                    <v-card style=" margin-top: 20px;  padding-right: 10px; padding-top: 20px; margin-left: 20px">
                        <v-text-field
                                v-model="searchQuery"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                                style="padding: 0 20px; margin-right: 10px;"
                        ></v-text-field>
                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        SN
                                    </th>
                                    <th class="text-left">
                                        Doctor Name
                                    </th>
                                    <th class="text-left">
                                       Patients Name
                                    </th>
                                    <th class="text-left">
                                        Message
                                    </th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                        v-for="item in filteredResources"
                                        :key="item.id"
                                >
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.doctor.name }}</td>
                                    <td>{{item.user.name}}</td>
                                    <td>{{item.message}}</td>
                                    <td>Action</td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </v-card>
                </v-flex>
            </v-layout>

        </v-card>
    </div>
</template>

<script>
    export default {
        name: "ViewPrescription",
        data () {
            return {
                searchQuery: '',
                desserts: [],
            }
        },
        mounted() {
            axios.get(`/api/bvon-doctor/section/view-prescription/${this.users}`)
                .then(res => {
                   this.desserts = res.data;
                    console.log(this.desserts);
                });
        },
        computed:{

            filteredResources (){
                if(this.searchQuery){
                    return this.desserts.filter((item)=>{
                        return item.user.name.startsWith(this.searchQuery);
                    })
                }else{
                    return this.desserts;
                }
                },
            users(){
                return User.id()
            }
        }

    }
</script>

<style scoped>

</style>