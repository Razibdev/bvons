<template>
    <div>
        <v-alert
                :type="typeClass"
                dismissible
                style="background-color: green; z-index: 200;"
                v-if="typeClass === 'success'"
        >{{notification.message}}</v-alert>

        <v-alert
                :type="typeClass"
                dismissible
                style="background-color: red; z-index: 200;"
                v-if="typeClass === 'error'"
        >{{notification.message}}</v-alert>

        <v-alert
                :type="typeClass"
                dismissible
                style="background-color: yellow; z-index: 200;"
                v-if="typeClass === 'warning'"
        >{{notification.message}}</v-alert>

        <v-alert
                :type="typeClass"
                dismissible
                style="background-color: blue; z-index: 200;"
                v-if="typeClass === 'info'"
        >{{notification.message}}</v-alert>
    </div>
</template>

<script>
    export default {
        name: "NotificationMessage",
        props:['notification'],
        data(){
            return{
                timeout: null
            }
        },
        computed :{
            typeClass(){
                return `${this.notification.type}`
            }
        },
        created() {
           this.timeout = setTimeout( () =>{
                this.$store.dispatch('removeNotification', this.notification);
            }, 3000);
        },

        beforeDestroy(){
            clearTimeout(this.timeout)
        }
    }
</script>

<style scoped>

</style>