class AppStorage{

    storeToken(token){
      localStorage.setItem('token', token);
    }

    storeUser(user){
        localStorage.setItem('user', user);
    }

    storePhone(phone){
        localStorage.setItem('phone', phone);
    }

    storeAddress(address){
        localStorage.setItem('address', address);
    }

    storeuserType(userType){
        localStorage.setItem('user_type', userType);
    }
    storeEmail(email){
        localStorage.setItem('email', email);
    }

    storeBlood(blood){
        localStorage.setItem('blood', blood);
    }

    storeDealer(dealer){
        localStorage.setItem('dealer', dealer);
    }

    store(user, token, phone, address, userType, email, blood, dealer){
        this.storeToken(token);
        this.storeUser(user);
        this.storePhone(phone);
        this.storeAddress(address);
        this.storeuserType(userType);
        this.storeEmail(email);
        this.storeBlood(blood);
        this.storeDealer(dealer);
    }

    countSetTime(value){
        localStorage.setItem('count_time', value);
    }

    countGetTime(value){
        return localStorage.getItem('count_time');
    }


    clear(){
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            localStorage.removeItem('phone');
            localStorage.removeItem('address');
            localStorage.removeItem('user_type');
            localStorage.removeItem('email');
            localStorage.removeItem('blood');
            localStorage.removeItem('dealer');
     }


    getToken(){
       return localStorage.getItem('token');
    }

    // getUser(){
    //     return localStorage.getItem('user');
    // }
    // getPhone(){
    //     return localStorage.getItem('phone');
    // }


    // getAddress(){
    //     return localStorage.getItem('address');
    // }


}

export default AppStorage = new AppStorage();