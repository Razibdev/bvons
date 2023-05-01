<template>
    <div>
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
                <tr v-for="(item) in history" :key="item.id" style="font-weight: bold">
                    <td>{{item.created_at}}</td>
                    <td>{{item.package}}</td>
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
               history:null
            }
        },
        created() {
            axios.get('/api/dealer/account/salary-get-history')
                .then(res => {
                    // console.log(res.data);
                    this.history = res.data;
                })
                .catch(error => console.log(error.response.data));
        }
    }
</script>

<style scoped>

</style>