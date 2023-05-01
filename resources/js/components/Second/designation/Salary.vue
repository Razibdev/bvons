<template>
    <div >
        <v-simple-table>
            <template v-slot:default>
                <thead>
                <tr>
                    <th class="text-left">
                        Date
                    </th>
                    <th class="text-left">
                        Package
                    </th>
                    <th>MO</th>
                    <th>SMO</th>
                    <th>MEx</th>
                    <th>SMEx</th>
                    <th>RMM</th>
                    <th>MM</th>
                    <th>SMM</th>
                    <th>AGM</th>
                    <th>GM</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">Amount Distribution</td>

                    <td>0</td>
                    <td v-for="(n, index) in  setting_value" :key="index">{{n}}</td>

                </tr>


                <tr
                        v-for="item in daily_values"
                        :key="item.id"
                >
                    <td>{{ item.created_at }}</td>
                    <td>{{ item.package }}</td>
                    <td>{{item.MO}}</td>
                    <td>{{item.SMO}}</td>
                    <td>{{item.MEx}}</td>
                    <td>{{item.SMEx}}</td>
                    <td>{{item.RMM}}</td>
                    <td>{{item.MM}}</td>
                    <td>{{item.SMM}}</td>
                    <td>{{item.AGM}}</td>
                    <td>{{item.GM}}</td>
                </tr>

                <tr v-for="(item) in total" :key="item.SMO+1" style="font-weight: bold">
                    <td colspan="2">Total</td>
                    <td>{{item.MO}}</td>
                    <td>{{item.SMO}}</td>
                    <td>{{item.MEx}}</td>
                    <td>{{item.SMEx}}</td>
                    <td>{{item.RMM}}</td>
                    <td>{{item.MM}}</td>
                    <td>{{item.SMM}}</td>
                    <td>{{item.AGM}}</td>
                    <td>{{item.GM}}</td>
                </tr>

                <tr v-for="item in user_count" :key="10" style="font-weight: bold">
                    <td colspan="2">Total User</td>
                    <td>{{item.MO}}</td>
                    <td>{{item.SMO}}</td>
                    <td>{{item.MEx}}</td>
                    <td>{{item.SMEx}}</td>
                    <td>{{item.RMM}}</td>
                    <td>{{item.MM}}</td>
                    <td>{{item.SMM}}</td>
                    <td>{{item.AGM}}</td>
                    <td>{{item.GM}}</td>
                </tr>

                <tr v-for="(item) in achievement" :key="item.SMO" v-if="item.created_at" style="font-weight: bold">
                    <td colspan="2">User Achievement</td>
                    <td>{{item.MO}}</td>
                    <td>{{item.SMO}}</td>
                    <td>{{item.MEx}}</td>
                    <td>{{item.SMEx}}</td>
                    <td>{{item.RMM}}</td>
                    <td>{{item.MM}}</td>
                    <td>{{item.SMM}}</td>
                    <td>{{item.AGM}}</td>
                    <td>{{item.GM}}</td>
                </tr>



                </tbody>
            </template>
        </v-simple-table>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                setting_value:null,
                daily_values: null,
                user_count: null,
                total:null,
                achievement:null,
                date:null

            }
        },
        methods:{
            printDate: function () {
                return new Date().toLocaleDateString();
            },
        },
        mounted(){
            this.date = this.printDate();
        },

        created() {
            axios.get('/api/dealer/account/salary-get-setting')
                .then(res => {
                    this.setting_value = res.data;
                })
                .catch(error => console.log(error.response.data));

            axios.get('/api/dealer/account/salary-get-daily')
                .then(res => {
                    console.log(res.data);
                    this.daily_values = res.data;
                })
                .catch(error => console.log(error.response.data));

            axios.get('/api/dealer/account/salary-user-count')
                .then(res => {
                    this.user_count = res.data;
                })
                .catch(error => console.log(error.response.data));

            axios.get('/api/dealer/account/salary-user-total')
                .then(res => {
                    this.total = res.data;
                })
                .catch(error => console.log(error.response.data));

            axios.get('/api/dealer/account/salary-user-achievement')
                .then(res => {
                    this.achievement = res.data;
                })
                .catch(error => console.log(error.response.data));
        }
    }
</script>

<style scoped>

</style>