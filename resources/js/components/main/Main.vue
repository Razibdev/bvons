<template>
    <div>
        <carousel></carousel>
        <service></service>
    </div>

</template>

<script>
    import Carousel from './slider/Carousel.vue'
    import Service from './slider/Service.vue'

    export default {
        name: "Main.vue",
        components:{
            Carousel,
            Service
        }
    }
</script>

<style scoped>

</style>