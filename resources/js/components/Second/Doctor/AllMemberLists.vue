<template>
    <div>
        <v-card class="mx-auto" color="deep-purple lighten-1" height="100vh" >
            <v-layout row wrap style="text-align: center; align-items: center;">
                <v-flex xs12 >
                    <v-card style=" margin-top: 20px; padding-top: 20px; padding-right: 10px; margin-left: 20px">
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
                                    <th class="text-center">
                                        SN
                                    </th>
                                    <th class="text-center">
                                        Name
                                    </th>
                                    <th class="text-center">
                                        Phone
                                    </th>
                                    <th class="text-center">
                                        Age
                                    </th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Member List</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                        v-for="item in filteredResources"
                                        :key="item.id"
                                >
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{item.phone}}</td>
                                    <td>{{item.age}}</td>
                                    <td>{{item.gender}}</td>
                                    <td>



                                        <div class="text-center">
                                        <v-dialog
                                                v-model="dialog[item.id]"
                                                width="500"
                                        >
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn
                                                        color="red lighten-2"
                                                        dark
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        style="width: 100%; margin-top: -2px;"

                                                >
                                                    Details
                                                </v-btn>
                                            </template>
                                            <v-card>
                                                <v-card-title class="text-h5 grey lighten-2">
                                                    Privacy Policy
                                                </v-card-title>

                                                <v-card-text>

                                                    <v-simple-table>
                                                        <template v-slot:default >
                                                            <thead>
                                                            <tr>
                                                                <th class="text-left">
                                                                    Name
                                                                </th>
                                                                <th class="text-left">
                                                                    Relation
                                                                </th>
                                                                <th class="text-left">
                                                                    Age
                                                                </th>
                                                                <th class="text-left">
                                                                    Occupation
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr
                                                                    v-for="member in item.members"
                                                                    :key="item.id"
                                                            >
                                                                <td>{{ member.name }}</td>
                                                                <td>{{ member.relation }}</td>
                                                                <td>{{ member.age }}</td>
                                                                <td>{{ member.occupation }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </template>
                                                    </v-simple-table>
                                                    </v-card-text>

                                                    <v-divider></v-divider>

                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn
                                                                color="primary"
                                                                text
                                                                @click="closeMemeberList(item.id)"
                                                        >
                                                           Close
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                                </v-dialog>
                                              </div>
                                        </td>

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
        name: "AllMemberLists",
        data () {
            return {
                searchQuery: '',
                desserts: [],
                dialog:{}
            }
        },
        methods:{
            closeMemeberList(id){
                this.dialog[id] = false;
            }
        },
        mounted() {
            axios.get(`/api/bvon-doctor/section/all-member-list/`)
                .then(res => {
                    this.desserts = res.data;
                    console.log(this.desserts);
                });
        },
        computed:{
            filteredResources (){
                if(this.searchQuery){
                    return this.desserts.filter((item)=>{
                        return item.phone.startsWith(this.searchQuery);
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