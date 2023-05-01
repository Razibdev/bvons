<template>
    <div class="notification-list">
        <notification-message v-for="notification in notifications" :key="notification.id"  :notification="notification"></notification-message>
    </div>
</template>

<script>
    import NotificationMessage from './NotificationMessage'
    export default {
        name: "Notification_lists",
        components:{
            NotificationMessage
        },
        computed :{
            notifications (){
               return this.$store.state.notifications;
            }
        }
    }
</script>

<style scoped>
.notification-list{
    position: fixed;
    top: 0;
    right: 0;
    margin-right: 15px;
    width: 320px;
    z-index:33;
}
</style>