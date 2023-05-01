import Token from './Token';
import  AppStorage from './AppStorage';
import store from '../Store';
class User{

    login(data){
        axios.post('/api/login', data)
            .then(res => {
                if(res.data.type === 'success') {
                    store.dispatch('addNotification', {
                        type: 'success',
                        message: res.data.message
                    });

                    this.loginAfterReceive(res);
                }else{
                    store.dispatch('addNotification', {
                        type: 'error',
                        message: res.data.message
                    });
                }



            })

    }

    loginAfterReceive(res){
        console.log(res);
        const  access_token = res.data.token.original.access_token;
        const username = res.data.token.original.user;
        const phone = res.data.token.original.phone;
        const address = res.data.token.original.address;
        const user_type = res.data.token.original.user_type;
        const email = res.data.token.original.email;
        const blood = res.data.token.original.blood;
        const dealer = res.data.token.original.dealer;
        if(Token.isValid(access_token)){
            AppStorage.store(username, access_token, phone, address, user_type,email, blood, dealer);

            window.location='/';
        }
    }


    register(data){
        axios.post('/api/register', data)
            .then(res => this.loginAfterReceive(res))
            .catch(error => console.log(error.response.data));
    }

    hasToken(){
        const token = AppStorage.getToken('token');
        if(token){
            return Token.isValid(token) ? true : this.logOut();
        }
        return false;
    }

    loggedIn(){
        return this.hasToken();
    }

   logOut(){
        AppStorage.clear();
        window.location="/";
   }

    id(){
        if(this.loggedIn()){
            const token  = Token.payload(AppStorage.getToken());
            return token.sub;
        }
    }

   Officer(){
     return  axios.get('/api/second-page-doctor-officer-check')
      .then(function(result) {  return  result.data.data });

    }


    own(id){
        return this.id() == id;
    }

    admin(){
        return this.id() == 1;
    }

    user(){
        return localStorage.getItem('user');
    }

    phone(){
        return localStorage.getItem('phone');
    }

    email(){
        return localStorage.getItem('email');
    }

    blood(){
        return localStorage.getItem('blood');
    }

    address(){
        return localStorage.getItem('address');
    }

    user_type(){
        return localStorage.getItem('user_type');
    }
    dealer(){
        return localStorage.getItem('dealer');
    }

    countSetTime(value){
        return AppStorage.countSetTime(value);
    }

    countGetTime(){
        return AppStorage.countGetTime();
    }

}

export  default User = new User();