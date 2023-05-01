<template>
    <div style="margin-bottom: 30px; overflow: hidden;">
        <v-simple-table>
            <template v-slot:default>
                <thead>
                <tr>
                    <th class="text-left">
                        Name
                    </th>
                    <th class="text-left">
                        Family Member
                    </th>
                    <th class="text-left">
                        Doctor Name
                    </th>
                    <th class="text-left">
                    Prescription
                </th>
                    <th class="text-left">
                        Date Time
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr
                        v-for="item in prescriptions"
                        :key="item.name"
                >
                    <td>{{ item.user.name }}</td>
                    <td> <span v-if="item.submember">{{ item.submember.name }}</span> <span v-else>None</span></td>
                    <td>{{ item.doctor.name }}</td>
                    <td>{{ item.message }}</td>
                    <td>{{ item.created_at }}</td>
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
                prescriptions: [],
            }
        },

        created() {
            axios.get(`/api/bvon-doctor-prescription-list/${User.id()}`)
                .then(res => {
                    this.prescriptions = res.data;
                    console.log(res.data);
                });
        }
    }
</script>

<style scoped>

</style>