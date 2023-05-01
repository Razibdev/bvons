import  Salary from '../components/Second/designation/Salary';
import  SalaryHistory from '../components/Second/designation/SalaryHistory';
import Ewallet from '../components/main/transactions/Ewallet'
import ShoppingWallet from '../components/main/transactions/ShoppingWallet'
import MerchantWallet from '../components/main/transactions/MerchantWallet'

//user referral
import ReferralUser from '../components/Auth/ReferralUser';



// dealer order details
import BvonDealerAllOrder from '../components/Second/Orders/AllOrders';
import BvonDealerPendingOrder from '../components/Second/Orders/PendingOrder';
import BvonDealerProcessingOrder from '../components/Second/Orders/ProcessingOrder'
import BvonDealerShippedOrder from '../components/Second/Orders/ShippingOrder'
import BvonDealerCompleteOrder from '../components/Second/Orders/CompleteOrder'
import BvonDealerCancelOrder from '../components/Second/Orders/CancelOrder'
import BvonDealerOrderDetails from '../components/Second/Orders/OrderDetails'
import BvonDealerAllStock from '../components/Second/Stock/AllStock'

// Dealer Employee Area na
import BvonDealerEmployeeAreana from '../components/Second/EmployeeAreana/EmployeeAreana'
import BvonDealerEmployeeAreanaDetails from '../components/Second/EmployeeAreana/EmployeeAreanaDetails'
import BvonDealerEmployeeDownline from '../components/Second/EmployeeAreana/EmployeeDownline'
import BvonDealerEmployeeDownlineDetails from '../components/Second/EmployeeAreana/EmployeeDownlineDetails'

let routes = [
    // designation salary routes
    { path: '/dealer/account/salary', component: Salary },
    { path: '/dealer/account/salary-history', component: SalaryHistory },

    // dealer order details
    { path: '/dealer/account/all-order', component: BvonDealerAllOrder },
    { path: '/dealer/account/pending-order', component: BvonDealerPendingOrder },
    { path: '/dealer/account/processing-order', component: BvonDealerProcessingOrder },
    { path: '/dealer/account/shipped-order', component: BvonDealerShippedOrder },
    { path: '/dealer/account/complete-order', component: BvonDealerCompleteOrder },
    { path: '/dealer/account/cancel-order', component: BvonDealerCancelOrder },
    { path: '/dealer/account-order/details/:id', component: BvonDealerOrderDetails },




    // Referral user
    { path: '/referral-codes/:id', component: ReferralUser },




    //Dealer Stock Section
    { path: '/dealer/stock/all-stock', component: BvonDealerAllStock },

    //Dealer Employee area na
    { path: '/dealer/employee/employee-area-na', component: BvonDealerEmployeeAreana },
    { path: '/dealer/employee-employee-area-na/:id', component: BvonDealerEmployeeAreanaDetails },
    { path: '/dealer/employee/employee-downline', component: BvonDealerEmployeeDownline },
    { path: '/dealer/employee-employee-downline/:id', component: BvonDealerEmployeeDownlineDetails },





    //transactions here
    { path: '/bvon-wallet', component: Ewallet },
    { path: '/bvon-shopping-wallet', component: ShoppingWallet },
    { path: '/bvon-merchant-wallet', component: MerchantWallet },

];

export  default  routes;
