<template>
    <v-row justify="center">
        <v-dialog
                v-model="dialogAddPayment"
                persistent
                max-width="400px"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                        color="primary"
                        dark
                        v-bind="attrs"
                        v-on="on"
                        style="margin-top: 5px; background: teal; margin-left: 10px"
                        @click="withdrawClose"

                >
                    Add Payment System
                </v-btn>
            </template>
            <v-card>
                <form @submit.prevent="addPayment" method="post">
                    <v-card-title style="background: teal">
                        <span style="margin: auto; color:white;" class="text-h5">Add Payment</span>
                        <v-icon style="float: right; cursor:pointer;" @click="dialogAddPayment = false">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="withdraw-select-payment">
                                    <v-select
                                            :items="items"
                                            label="Choose Payment Method"
                                            solo
                                            v-model="form.method_type"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                            label="Payment Method Name(any)"
                                            single-line
                                            type="text"
                                            v-model="form.method_name"

                                    ></v-text-field>
                                </v-col>


                                <v-col cols="12">
                                    <v-text-field
                                            label="Payment Method Number"
                                            single-line
                                            type="text"
                                            v-model="form.method_number"
                                    ></v-text-field>

                                </v-col>
                            </v-row>
                            <v-divider></v-divider>
                        </v-container>

                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                                style="background-color:teal;"
                                dark
                                text
                                @click="dialogAddPayment = false"
                                type="submit"
                        >
                            Add Payment
                        </v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    export default {
        name: "AddPayment",
        data: () => ({
            items: ['bKash', 'Rocket', 'Nagad'],
            dialogAddPayment: false,
            form: {
                method_type: null,
                method_name: null,
                method_number: null
            }
        }),
        methods:{
            withdrawClose(){
                EventBus.$emit('withdrawCloses');
                this.dialogAddPayment = true;

            },

            addPayment(){
                axios.post('/api/vue-wallet/add-payment', this.form)
                    .then(res => {
                        console.log(res.data);
                    })
            }
        }
    }
</script>

<style scoped>

</style>