<template>
   <div>
       <v-card class="mx-auto" color="deep-purple lighten-1" height="100vh" >
           <v-layout row wrap style="text-align: center; align-items: center;">
               <v-flex xs1></v-flex>
               <v-flex xs8 >
                   <v-form @submit.prevent="prescription" method="post">
                   <v-card style=" margin-top: 35px;">
                       <v-col cols="12">
                           <h3>New Prescription</h3>
                       </v-col>
                       <v-col
                               cols="12"
                       >
                           <v-autocomplete
                                   :items="items"
                                   dense
                                   filled
                                   label="Choose User"
                                   :item-text="getFieldText"
                                   item-value="id"
                                   v-model="form.username"
                                   disable-lookup
                           ></v-autocomplete>
                       </v-col>



                       <v-col cols="12">
                           <v-select
                                   :items="members"
                                   solo
                                   item-text="name"
                                   item-value="id"
                                   label="Family Member"
                                   v-model="form.selectMember"
                           ></v-select>
                       </v-col>

                       <v-col cols="12">
                           <v-textarea
                                   solo
                                   name="input-7-4"
                                   label="Prescription Note"
                                   class="presctiption_text_field"
                                   v-model="form.message"
                           ></v-textarea>
                       </v-col>
                       <v-col cols="12" style="text-align: right">
                           <v-btn
                                   depressed
                                   color="primary"
                                   type="submit"
                           >
                               Send Message
                           </v-btn>
                       </v-col>
                   </v-card>
                   </v-form>
               </v-flex>
               <v-flex xs3></v-flex>

           </v-layout>

       </v-card>
   </div>
</template>

<script>
    export default {
        name: "DoctorPrescription",
        data: () => ({
            items: [],
            form:{
                username:null,
                message:null,
                selectMember:null
            },
            members:[],
            inwidth:false,
            showNavbar:false


        }),
        watch : {
            username : function(value){
                axios.get('/api/doctor-prescription-sub-member?member_id='+value)
                    .then(res =>{
                        this.members = res.data;
                        console.log(this.members);
                    });
            }
        },
        computed:{
          username(){
              return this.form.username;
            }
        },
        methods:{
            getFieldText (item)
            {
                return `${item.name} - ${item.phone}`
            },
            prescription(){

                axios.post('/api/bvon-doctor/section/add-prescription', this.form)
                    .then(res =>{
                        this.$store.dispatch('addNotification', {
                            type: 'success',
                            message: res.data.message
                        });

                            let messages = "B Doctor: "+this.form.message;

                        let details = {
                            number: res.data.phone,
                            message: messages,
                            key:'a7348e9751efeb8e6108339c84b6d9ac2ebbc14c',
                            type: 'sms',
                            devices:'105|0',
                            prioritize:0
                        };
                        let data = new FormData();
                        for ( let key in details ) {
                            data.append(key, details[key]);
                        }
                        fetch('https://bulksms.brotherit.net/services/send.php', {
                            method: 'POST',
                            mode: 'cors',
                            body: data
                        })
                            .then(response => response.json())
                            .then(data => {console.log(data)});

                    })
                    .catch(error => console.log(error.response.data));




            },

            handle() {
                this.inwidth = window.innerWidth >= 990;
                this.showNavbar = window.innerWidth <= 990;

            },
        },

        created() {

                var calssname = document.getElementsByClassName('v-list-item__content');
                calssname.style.marginTop = '500px';

        },
        mounted() {
            axios.get('/api/bvon-doctor/section/bvon-doctor/user-list-view')
                .then(res => {
                    this.items = res.data;
                }).catch(error => console.log(error.response.data));
        }
    }
</script>

<style scoped>

</style>