<template>
    <div class="xyzsdf">
        <v-menu v-model="menu" offset-y :close-on-content-click="false" class="add-quizze-exam-system" style="background-color: #1976D2;">
            <template v-slot:activator="{ on }"  >
                <v-icon v-on="on" color="primary" >mdi-calendar</v-icon>
            </template>
            <v-date-picker v-model="picker" @click="menu = false" class="add-quizze-exam-system" />
        </v-menu>
    </div>

</template>
<script>
    export default {
        props: {
            value: {
                type: String,
                default: new Date().toISOString().substr(0, 10),
            },
        },
        data() {
            return {
                menu: false,
            };
        },
        computed: {
            picker: {
                get() {
                    return this.value;
                },
                set(val) {
                    this.menu = false;
                    this.$emit("input", val);
                },
            },
        },
    };
</script>

<style lang="sass">
    .v-picker__title
        background-color: #1976D2 !important
    .v-input__append-outer
        position: absolute !important
        float: right !important
        right: 14px !important
</style>

