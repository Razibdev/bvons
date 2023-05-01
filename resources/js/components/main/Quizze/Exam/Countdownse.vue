<template>
    <!--<div class="block">-->
        <!--<p class="digit">{{ days | two_digits }}</p>-->
        <!--<p class="text">Days</p>-->
    <!--</div>-->
    <!--<div class="block">-->
        <!--<p class="digit">{{ hours | two_digits }}</p>-->
        <!--<p class="text">Hours</p>-->
    <!--</div>-->
    <div>
        <div class="block">
            <p class="digit">{{ minutes | two_digits }}</p>
            <p class="text">Minutes</p>
        </div>
        <div class="block">
            <p class="digit">{{ seconds | two_digits }}</p>
            <p class="text">Seconds</p>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Countdown",
        props:['timeCountNow'],
        // props : {
        //     timeCountNow : {
        //         type: Number,
        //         coerce: str => Math.trunc(Date.parse(str) / 1000)
        //     }
        // },
        data() {
            return {
                now: User.countGetTime()
            }
        },

        computed: {

            seconds() {
                return (this.timeCountNow - this.now) % 60;
            },

            minutes() {
                return Math.trunc((this.timeCountNow - this.now) / 60) % 60;
            },

        },
        filters: {
            two_digits: function(value) {
                if(value.toString().length <= 1)
                {
                    return "0"+value.toString();
                }
                return value.toString();
            }
        },
        created() {
            console.log(this.timeCountNow);


               var intaval = setInterval(() => {
                    if(this.timeCountNow - this.now > 0) {

                        this.now ++;
                        User.countSetTime(this.now);
                        console.log(this.now);
                    }
                    if(this.timeCountNow - this.now == 0) {
                        EventBus.$emit('examFormSubmit');
                        clearInterval(intaval);
                    }

                },1000);


        }

    }
</script>

<style scoped>
    @import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:400|Roboto:100);

    .block {
        display: inline;
        margin: 20px;
    }

    .text {
        color: #1abc9c;
        font-size: 18px;
        font-family: 'Roboto Condensed', serif;
        font-weight: 40;
        margin-top:10px;
        margin-bottom: 10px;
        text-align: center;
        display: inline;
    }

    .digit {
        color: #ecf0f1;
        font-size: 50px;
        font-weight: 100;
        font-family: 'Roboto', serif;
        margin: 10px;
        text-align: center;
        display: inline;
    }
</style>