<template>
    <div>
        <div v-for="post in social" :key="post.id" >
            <final-social :user="post" ></final-social>
        </div>
    </div>

</template>
    <script>
       import FinalSocial from './FinalSocial';
        export default {
            components:{
              FinalSocial
            },
            props:['social'],

            created() {



            }
        }
    </script>

