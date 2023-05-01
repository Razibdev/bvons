<template>
    <section>
        <div style="width: 100%; overflow:hidden; margin-bottom: 50px; text-align: center; margin-top: 20px">


            <div v-if="isAuth">
                <div v-if="authInfo.doctor_service === 0">
                    <router-link class="router-link-show-now button" to="/bvon-doctor-service">Apply for Doctor Service</router-link>

                </div>
                <div v-else>
                    <router-link class="router-link-show-now button" to="/bvon-doctor-service-token" >Get Doctor Service</router-link>
                </div>

            </div>
            <div v-else>
                <p @click="checkAuthNow" class="router-link-show-now button"  >Apply for Doctor Service </p>
            </div>
        </div>



        <div style="width: 100%; margin-bottom: 10px; overflow:hidden;">
            <img style="width: 100%" src="media/doctor/details/page1.jpeg" alt="">
        </div>
        <div style="width: 100%; overflow:hidden;">
            <img style="width: 100%" src="media/doctor/details/page2.jpeg" alt="">
        </div>
        <div style="width: 100%; overflow:hidden; margin-bottom: 50px; text-align: center; margin-top: 10px">
            <div v-if="isAuth">
                <div v-if="authInfo.doctor_service === 0">
                    <router-link class="router-link-show-now button" to="/bvon-doctor-service">Apply for Doctor Service</router-link>

                </div>
                <div v-else>
                    <router-link class="router-link-show-now button" to="/bvon-doctor-service-token" >Get Doctor Service</router-link>
                </div>

            </div>
            <div v-else>
                <p @click="checkAuthNow" class="router-link-show-now button"  >Apply for Doctor Service </p>
            </div>



        </div>
    </section>
</template>

<script>
    export default {
        name: "DoctorServiceView",
        data(){
            return{
                isAuth: User.loggedIn(),
                authInfo:''
            }
        },
        methods:{
            checkAuthNow(){
                EventBus.$emit('checkAuthDoctorNow');
            }
        },
        created() {
            axios.get(`/api/get-user-info/${User.id()}`)
                .then(res => {
                    this.authInfo = res.data;
                    console.log(this.authInfo);

                })
                .catch(error => console.log( this.testingCode));
        }
    }
</script>

<style scoped>
.router-link-show-now{
    text-decoration: none;
    padding: 20px;
    background: #018EA9;
    color: #ffffff;
}
p{
    text-decoration: none;
    padding: 20px;
    background: #018EA9;
    color: #ffffff;
    display: inline;
    cursor: pointer;
}



.button {
    background-color: #004A7F;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    border: none;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-family: Arial;
    font-size: 20px;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    -webkit-animation: glowing 1500ms infinite;
    -moz-animation: glowing 1500ms infinite;
    -o-animation: glowing 1500ms infinite;
    animation: glowing 1500ms infinite;
}

@keyframes glowing {
    0% { background-color: #018EA9; box-shadow: 0 0 3px #018EA9; }
    50% { background-color: #1B7FD9; box-shadow: 0 0 40px #1B7FD9; }
    100% { background-color: #018EA9; box-shadow: 0 0 3px #018EA9; }
}
</style>