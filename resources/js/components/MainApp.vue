<template>
    <div id="main-app">

        <v-container class="main-container-main-vue">
        <the-header-app></the-header-app>
        <router-view></router-view>
        <footer-app></footer-app>
        </v-container>
        <notification-list></notification-list>
    </div>

</template>


<script>
    import FooterApp from './FooterApp'
    import TheHeaderApp from './TheHeaderApp'
    // import NotificationList from './notification/Notification_lists'


    export default {
        data: () => ({
            loading: false,
            selection: 1,

        }),

        methods: {
            reserve () {
                this.loading = true;
                setTimeout(() => (this.loading = false), 2000)
            },
        },
        components:{
            FooterApp,
            TheHeaderApp
            // NotificationList
        },
        created() {
            console.log(this.$route.path)
        },
        computed:{
            mainRouteGet(){
                return this.$route.path;
            }
        }
    }
</script>
<style scoped lang="scss">
    .main-container-main-vue{
        padding:0 !important;
        padding-left:0 !important;
        padding-right:0 !important;
        overflow: hidden;
        position:relative;

    }


    .v-toolbar__content .v-btn.v-btn--icon.v-size--default, .v-toolbar__extension .v-btn.v-btn--icon.v-size--default{
        height: 0 !important;
        width: 0 !important;
    }
</style>

<style lang="sass">
    .v-toolbar__content, .v-toolbar__extension
     padding: 0 !important


     .v-toolbar__content
      .v-btn.v-btn--icon.v-size--default
       height: 0 !important
       width: 0 !important
    .v-toolbar__extension
        .v-btn.v-btn--icon.v-size--default
            height: 0 !important
            width: 0 !important


</style>