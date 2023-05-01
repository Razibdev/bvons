<template>
    <div>
        <second-sidebar></second-sidebar>
        <notification-list></notification-list>
    </div>

</template>


<script>

    import SecondSidebar from './SecondSidebar'
    import NotificationList from './notification/Notification_lists'

    export default {
        name: "SecondApp.vue",
        components:{
            SecondSidebar,
            NotificationList
        }
    }
</script>

<style scoped>

</style>