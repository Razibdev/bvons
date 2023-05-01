<template>
   <div>
      <v-layout row wrap style="padding: 20px;">
         <v-flex xs12 md8>
           <div style="margin: 0 10px;">
              <h2 class="content-heading">
                 Order Serial: <strong>{{orders.order_serial}} </strong> <br>
                 Order Placed: <strong>{{orders.created_at}}</strong> <br>
              </h2>
              <div style="height: 300px; overflow: auto">
                 <v-simple-table>
                    <template v-slot:default>
                       <thead>
                       <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Image</th>
                          <th class="text-left">
                             Product
                          </th>
                          <th class="text-left">
                             Size
                          </th>
                          <th class="text-left">
                             Color
                          </th>
                          <th class="text-left">
                             Qty
                          </th>
                          <th class="text-left">
                             Price
                          </th>
                          <th class="text-left">
                             Total Price
                          </th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr
                               v-for="order in orderDetails"
                               :key="order.id"
                       >
                          <td>{{order.id}}</td>
                          <td><img :src="getProductImgUrl(order.media.product_image)" width="100" height="75"  alt=""></td>
                          <td>{{ order.product.product_name }}</td>
                          <td>{{ order.size }}</td>
                          <td>{{ order.color }}</td>
                          <td>{{ order.product_quantity }}</td>
                          <td>{{ order.product_price }}</td>
                          <td>{{totalPrice(order.product_quantity, order.product_price)}}</td>
                       </tr>
                       </tbody>
                    </template>
                 </v-simple-table>
              </div>

               <div v-if="payments.length > 0">
                  <h2>Payment Details (1)</h2>
                  <v-simple-table>
                     <template v-slot:default>
                        <thead>
                        <tr>
                           <th class="text-left">
                              ID
                           </th>
                           <th class="text-left">
                              ORDER TYPE
                           </th>
                           <th class="text-left">TRANSACTION_ID</th>
                           <th class="text-left">AMOUNT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                                v-for="payment in payments"
                                :key="payment.id"
                        >
                           <td>{{ payment.id }}</td>
                           <td>{{ payment.order_type }}</td>
                           <td>{{ payment.transaction_id }}</td>
                           <td>{{ payment.amount }}</td>
                        </tr>
                        </tbody>
                     </template>
                  </v-simple-table>
               </div>

           </div>
         </v-flex>
         <v-flex xs12 md4>
            <div style="margin: 0 15px;">
               <div style=" padding: 20px 0; margin-bottom: 18px;">
                  <h2 class="content-heading">Addresses</h2>
                  <h4 class="content-heading" >Shipping Address</h4>
               </div>


               <v-simple-table>
                  <template v-slot:default>
                     <thead>
                     <tr>
                        <th class="text-left">
                           Name
                        </th>
                        <td class="text-left" v-if="orders.order_user">
                           {{orders.order_user.name}}
                        </td>
                     </tr>

                     <tr>
                        <th class="text-left">
                           Phone
                        </th>
                        <td class="text-left" v-if="orders.order_user">
                           {{orders.order_user.phone}}
                        </td>
                     </tr>

                     <tr>
                        <th class="text-left">
                           District
                        </th>
                        <td class="text-left" v-if="orders.districts">
                           {{orders.districts.name}}
                        </td>
                     </tr>

                     <tr>
                        <th class="text-left">
                           City
                        </th>
                        <td class="text-left"  v-if="orders.thana ">
                           {{orders.thana.name}}
                        </td>
                     </tr>


                     <tr>
                        <th class="text-left">
                           Full Address
                        </th>
                        <td class="text-left" v-if="orders.address">
                           {{orders.address}}
                        </td>
                     </tr>


                     </thead>

                  </template>
               </v-simple-table>
            </div>

         </v-flex>

         <v-flex xs12 md10>
            <v-layout row wrap style="overflow: hidden; margin-top: 20px">

               <v-flex xs6 md2>

                  <v-btn
                          class="ma-2"
                          disabled
                          color="primary"
                  >
                     Pending Order
                  </v-btn>

               </v-flex>

               <v-flex xs6 md2 >


                  <div v-if="not_purchase.length == 0 && product_name.length == 0">


                  <v-form method="get" @submit.prevent="processingSubmit" >
                  <v-btn
                          style="margin-right: 10px !important;"
                          class="ma-2"
                          outlined
                          color="primary"
                          type="submit"
                          v-if="orders.order_status == 'pending'"
                  >
                     Processing Order
                  </v-btn>

                     <v-btn
                             class="ma-2"
                             color="primary"
                             v-else-if="orders.order_status == 'processing'"
                             style="margin-right: 10px !important;"
                     >
                        Processing Order
                     </v-btn>
                  <v-btn
                          class="ma-2"
                          color="primary"
                         v-else
                          disabled
                          style="margin-right: 10px !important;"
                  >
                     Processing Order
                  </v-btn>
                  </v-form>
                  </div>
                  <div v-else-if="orders.order_status == 'complete' || orders.order_status == 'cancel' ">
                     <v-btn
                             class="ma-2"
                             color="primary"
                             disabled
                             style="margin-right: 10px !important;"
                     >
                        Processing Order
                     </v-btn>
                  </div>
                  <div v-else>
                     <v-btn
                             style="margin-right: 10px !important;"
                             class="ma-2"
                             outlined
                             color="primary"
                             @click="productOutOfStock"
                     >
                        Processing Order
                     </v-btn>
                  </div>



         </v-flex>


               <v-flex xs6 md2 >
                  <div v-if="not_purchase.length == 0 && product_name.length == 0">
                  <v-form method="get" @submit.prevent="shippedSubmit">
                  <v-btn
                          class="ma-2"
                          outlined
                          color="primary"
                          type="submit"
                          v-if="orders.order_status == 'pending' || orders.order_status == 'processing'"
                  >
                     Shipped Order
                  </v-btn>

                     <v-btn
                             class="ma-2"
                             color="primary"
                             v-else-if="orders.order_status == 'shipped' "
                     >
                        Shipped Order
                     </v-btn>

                  <v-btn
                          class="ma-2"
                          color="primary"
                          v-else
                          disabled
                  >
                     Shipped Order
                  </v-btn>
                  </v-form>
                  </div>

                  <div v-else-if="orders.order_status == 'complete' || orders.order_status == 'cancel' ">
                     <v-btn
                             class="ma-2"
                             color="primary"
                             disabled
                     >
                        Shipped Order
                     </v-btn>
                  </div>

                  <div v-else>
                     <v-btn
                             class="ma-2"
                             outlined
                             color="primary"
                             @click="productOutOfStock"
                     >
                        Shipped Order
                     </v-btn>
                  </div>

               </v-flex>







               <v-flex xs6 md2 >

                  <div v-if="not_purchase.length == 0 && product_name.length == 0">
                  <v-form method="get" @submit.prevent="completeSubmit">
                  <v-btn
                          class="ma-2"
                          outlined
                          color="success"
                          type="submit"
                          v-if="orders.order_status == 'pending' || orders.order_status == 'processing' || orders.order_status == 'shipped'"
                  >
                     Complete Order
                  </v-btn>

                  <v-btn
                          class="ma-2"
                          color="success"
                          v-else-if="orders.order_status == 'complete'"
                  >
                     Complete Order
                  </v-btn>

                     <v-btn
                             class="ma-2"
                             color="success"
                             disabled
                             v-else
                     >
                        Complete Order
                     </v-btn>
                  </v-form>
                  </div>

                  <div v-else-if="orders.order_status == 'complete'" >
                     <v-btn
                             class="ma-2"
                             color="success"
                     >
                        Complete Order
                     </v-btn>
                  </div>
                  <div v-else-if="orders.order_status == 'cancel'">
                     <v-btn
                             class="ma-2"
                             color="success"
                             disabled
                     >
                        Complete Order
                     </v-btn>
                  </div>

                  <div v-else >
                     <v-btn
                             class="ma-2"
                             outlined
                             color="success"
                             @click="productOutOfStock"
                     >
                        Complete Order
                     </v-btn>
                  </div>
               </v-flex>



               <v-flex xs6 md2>
                  <v-form @submit.prevent="cancleSubmit" method="get">
                  <v-btn
                          class="ma-2"
                          color="error"
                          v-if="orders.order_status == 'complete'"
                          disabled
                  >
                     Cancel Order
                  </v-btn>

                  <v-btn
                          class="ma-2"
                          color="error"
                          v-else-if="orders.order_status == 'cancel'"
                  >
                     Cancel Order
                  </v-btn>

                  <v-btn
                          class="ma-2"
                          outlined
                          color="error"
                          type="submit"
                          v-else
                  >
                     Cancel Order
                  </v-btn>

                  </v-form>
               </v-flex>
               <v-flex xs1></v-flex>
            </v-layout>
         </v-flex>
         <v-flex xs12 md2></v-flex>

      </v-layout>





      <template>
         <div class="text-center">
            <v-dialog
                    v-model="dialog"
                    width="500"
            >
               <v-card>
                  <v-card-title class="text-h5 grey lighten-2">
                     Product not available
                  </v-card-title>

                  <v-card-text v-for="(notavailable, index) in product_name" v-if="product_name.length > 0" :key="index">
                     <img :src="getImgUrl(notavailable)" width="100px" height="100px" alt="">
                 <span style="color:red"> {{productName(notavailable)}} </span> Product Stock Not available
                  </v-card-text>

                  <v-card-text v-for="(notavailable, index) in not_purchase" v-if="not_purchase.length > 0" :key="index">
                     <img :src="getImgUrl(notavailable)" width="100px" height="100px" alt="">
                     <span style="color:red"> {{productName(notavailable)}} </span> Product not Purchase
                  </v-card-text>

                  <v-divider></v-divider>

                  <v-card-actions>
                     <v-spacer></v-spacer>
                     <v-btn
                             color="success"
                             text
                             @click="dialog = false"
                     >
                        Close
                     </v-btn>
                  </v-card-actions>
               </v-card>
            </v-dialog>
         </div>
      </template>






   </div>
</template>

<script>
    export default {
        name: "OrderDetails",
       data () {
          return {
             dialog: false,
             orders:[],
             values: 0,
             image:null,
             orderDetails:[],
             payments:[],
             not_purchase:[],
             product_name:[],
             processing:{
                processing:'processing',
                id: this.$route.params.id
             },

             shipped:{
                shipped:'shipped',
                id: this.$route.params.id
             },
             complete:{
                complete:'complete',
                id: this.$route.params.id
             },
             cancel:{
                cancel:'cancel',
                id: this.$route.params.id
             }

          }
       },
       methods:{

          getImgUrl(image){
             let pimage = image.split(",")[1];
             return '/storage/'+pimage;
          },

          getProductImgUrl(image){

             return '/storage/'+image;
          },
          productName(name){
             return name.split(",")[0];
          },
          totalPrice(qty, price){
             return qty * price;
          },
          productOutOfStock(){
             this.dialog = true;
          },
          processingSubmit(){
             axios.get(`/api/dealer/account-order/details-dealer-processing/${ this.processing.processing}/${this.processing.id}`,)
                     .then(res => {
                        if(res.data.type === 'success') {
                           this.$store.dispatch('addNotification', {
                              type: 'success',
                              message: res.data.message
                           });
                          window.location = "/dealer/account-order/details/"+res.data.id;

                        }else{
                           this.$store.dispatch('addNotification', {
                              type: 'error',
                              message: res.data.message
                           });
                        }

                     })
                     .catch(error => console.log(error.response.data));
          },


          shippedSubmit(){
             axios.get(`/api/dealer/account-order/details-dealer-shipped/${this.shipped.shipped}/${this.shipped.id}`)
                     .then(res => {
                        if(res.data.type === 'success') {
                           this.$store.dispatch('addNotification', {
                              type: 'success',
                              message: res.data.message
                           });
                           window.location = "/dealer/account-order/details/"+res.data.id;

                        }else{
                           this.$store.dispatch('addNotification', {
                              type: 'error',
                              message: res.data.message
                           });
                        }

                     })
                     .catch(error => console.log(error.response.data));
          },

          completeSubmit(){
             axios.get(`/api/dealer/account-order/details-dealer-complete/${this.complete.complete}/${this.complete.id}`)
                     .then(res => {
                        if(res.data.type === 'success') {
                           this.$store.dispatch('addNotification', {
                              type: 'success',
                              message: res.data.message
                           });
                           window.location = "/dealer/account-order/details/"+res.data.id;

                        }else{
                           this.$store.dispatch('addNotification', {
                              type: 'error',
                              message: res.data.message
                           });
                        }

                     })
                     .catch(error => console.log(error.response.data));
          },
          cancleSubmit(){
             axios.post(`/api/dealer/account-order/details-dealer-cancel/${this.cancel.cancel}/${this.cancel.id}`)
                     .then(res => {
                        if(res.data.type === 'success') {
                           this.$store.dispatch('addNotification', {
                              type: 'success',
                              message: res.data.message
                           });
                           window.location = "/dealer/account-order/details/"+res.data.id;

                        }else{
                           this.$store.dispatch('addNotification', {
                              type: 'error',
                              message: res.data.message
                           });
                           window.location = "/dealer/account-order/details/"+res.data.id;
                        }

                     })
                     .catch(error => console.log(error.response.data));
          }
       },
        created() {
            axios.get(`/api/dealer/account-order/details-dealer/${this.$route.params.id}`)
                    .then(res => {
                           this.orders = res.data.order;
                           this.orderDetails = res.data.orderDetails;
                           this.payments = res.data.payment;
                           this.values = res.data.value;
                           this.not_purchase = res.data.not_purchase;
                           this.product_name = res.data.product_name;

                           // this.product_name_all.forEach(item =>{
                           //    this.product_name = item.split(",")[0];
                           //    this.image = item.split(",")[1];
                           //    console.log( this.image);
                           // });

                           // console.log(res.data);
                           // // console.log(this.image);
                           // console.log(this.product_name_all);
                       console.log(res.data);
                    })
                    .catch(error => console.log(error.response.data));
        },
       computed:{

       }
    }
</script>

<style scoped>

</style>