
// User Quizze Section
import GeneralUserQizze from '../components/main/Quizze/General/GeneralQuizze'
import GeneralUserQizzeRank from '../components/main/Quizze/General/GeneralQuizzeRank'
import AttendQuizzeExamStart from '../components/main/Quizze/Exam/AttendQuizzeExam'
import QuizzeExamRank from '../components/main/Quizze/Exam/QuizzeExamRank'
import AttendAllExamView from '../components/main/Quizze/Exam/AttendAllExamView'
import ExamQuestionViewAll from '../components/main/Quizze/Exam/ExamQuestionView'
import ExamOwnDetails from '../components/main/Quizze/Exam/ExamOwnDetails'


//quizze section
import QuizzeExamAdd from '../components/Second/Quizze/Exam/AddExam'
import QuizzeExamView from '../components/Second/Quizze/Exam/ViewExam'
import QuizzeExamEdit from '../components/Second/Quizze/Exam/EditExam'
import QuizzeQuestionView from '../components/Second/Quizze/Question/ViewQuizzeQuestion'
import QuizzeQuestionAdd from '../components/Second/Quizze/Question/AddQuizzeQuestion'
import ExamQuizzeQuestionEdit from '../components/Second/Quizze/Question/EditQuizzeQuestion'


import GeneralQuizzeQuestionAdd from '../components/Second/Quizze/General/Question/AddGeneralQuestion'
import GeneralQuizzeQuestionView from '../components/Second/Quizze/General/Question/ViewGeneralQuestion'
import GeneralQuizzeQuestionEdit from '../components/Second/Quizze/General/Question/EditGeneralQuizzeQuestion'


let routes = [

    { path: '/bvon-general-quizze', component: GeneralUserQizze },
    { path: '/bvon-general-quizze-rank', component: GeneralUserQizzeRank },
    { path: '/bvon-attend-quizze-exam', component: AttendQuizzeExamStart },
    { path: '/bvon-exam-quizze-all-view', component: AttendAllExamView },
    { path: '/bvon-exam-quizze-rank-show/:id', component: QuizzeExamRank },
    { path: '/bvon-exam-quizze-all-question/:id', component: ExamQuestionViewAll },
    { path: '/bvon-exam-quizze-own-details/:id', component: ExamOwnDetails },



    // Second Part Exam And Exam Question
    { path: '/dealer/account/add-bvon-quizze-exam', component: QuizzeExamAdd },
    { path: '/dealer/account/view-bvon-quizze-exam', component: QuizzeExamView },
    { path: '/dealer/account-edit-bvon-quizze-exam/:id', component: QuizzeExamEdit },
    { path: '/dealer/account-add-bvon-quizze-exam-question/:id', component: QuizzeQuestionAdd },
    { path: '/dealer/account-view-bvon-quizze-exam-question/:id', component: QuizzeQuestionView },
    { path: '/dealer/account-order/bvon-edit-exam-quizze-question/:id/:examId', component: ExamQuizzeQuestionEdit },
    //General Question
    { path: '/dealer/account/add-bvon-general-quizze-question', component: GeneralQuizzeQuestionAdd },
    { path: '/dealer/account/view-bvon-general-quizze-question', component: GeneralQuizzeQuestionView },
    { path: '/dealer/account-edit-bvon-edit-quizze-question/:id', component: GeneralQuizzeQuestionEdit},

];

export  default  routes;




