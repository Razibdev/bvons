<template>
    <v-row justify="center">
        <v-dialog
                v-model="dialogApplyIdCard"
                persistent
                max-width="400px"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                        color="primary"
                        dark
                        v-bind="attrs"
                        v-on="on"
                        style="margin-top: 5px; background: #232F3E;"
                >
                    Login
                </v-btn>
            </template>
            <v-card>
                <form @submit.prevent="login" method="post">
                    <v-card-title style="background: teal">
                        <span style="margin: auto; color:white;" class="text-h5">LogIn Bvon</span>
                        <v-icon style="float: right; cursor:pointer;" @click="dialogLogIn = false">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                            label="Phone/Username/Account Number"
                                            single-line
                                            type="text"
                                            v-model="form.phone"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                            label="Password"
                                            class="login-style"
                                            single-line
                                            v-model="form.password"
                                            :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
                                            @click:append="() => (value = !value)"
                                            :type="value ? 'password' : 'text'"
                                    ></v-text-field>
                                    <!--<v-icon style="color: #000; position: absolute; right: 17px; top: 30px;" @click="showLoginPassword">{{passwordShow}}</v-icon>-->
                                </v-col>
                            </v-row>
                            <!--<v-divider></v-divider>-->
                            <div>
                                <a href="#" @click="forgotClick">Forgot Password?</a>

                                <v-btn
                                        style="background-color:teal; float:right;"
                                        dark
                                        text
                                        @click="dialogLogIn = false"
                                        type="submit"
                                >
                                    LogIn
                                </v-btn>


                            </div>
                        </v-container>

                    </v-card-text>
                    <v-card-actions style="text-align: center; align-items: center; overflow: hidden;">
                        <p style="margin-top: 10px; margin-left: 98px; text-align: center" @click="doneoknow" >Not a member? &nbsp; &nbsp; </p><register></register>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    export default {
        name: "ApplyIDCart"
    }
</script>

<style scoped>

</style>