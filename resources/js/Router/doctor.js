//second part
import BvonDoctorPrescription from '../components/Second/Doctor/DoctorPrescription'
import BvonViewPrescription from '../components/Second/Doctor/ViewPrescription'
import AllMemberList from '../components/Second/Doctor/AllMemberLists'


// Doctor Officer Target List second part
import DoctorOfficerTargetList from '../components/Second/DoctorOfficer/TargetHistory'
import DoctorOfficerMonthlyRegister from '../components/Second/DoctorOfficer/MontlyRegisterUser'
import DoctorOfficerSignUPHistory from '../components/Second/DoctorOfficer/SignUPHistory'

// user section
import ApplyRegistration from '../components/main/Doctor/ApplyRegistration'
import DoctorService from '../components/main/Doctor/DoctorService'
import DoctorServiceDetails from '../components/main/Doctor/DoctorServiceView'

let routes = [
    //bvon doctor service
    { path: '/bvon-doctor/section/new-prescription', component: BvonDoctorPrescription },
    { path: '/bvon-doctor/section/view-prescription', component: BvonViewPrescription },
    { path: '/bvon-doctor/section/all-member-list', component: AllMemberList },

    // Doctor officer list
    { path: '/dealer/account/bvon-doctor-officer-target-list', component: DoctorOfficerTargetList },
    { path: '/dealer/account/bvon-doctor-officer-signup-list/', component: DoctorOfficerSignUPHistory },
    { path: '/dealer/account-order/bvon-doctor-officer-target-list-monthly-history/:id/:type', component: DoctorOfficerMonthlyRegister },

    { path: '/bvon-doctor-service', component: ApplyRegistration },
    { path: '/bvon-doctor-service-token', component: DoctorService },
    { path: '/bvon-doctor-service-view', component: DoctorServiceDetails },
];

export  default  routes;