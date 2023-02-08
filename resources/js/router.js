import {createRouter, createWebHistory} from 'vue-router';
import {useAuthStore} from '@/store/auth';

const Login = () => import('./pages/auth/Login.vue');
const Register = () => import('./pages/auth/Register.vue');
const Profile = () => import('./pages/Profile.vue');
const PaymentsIndex = () => import('./pages/payments/Index.vue');
const PaymentsCreate = () => import('./pages/payments/Create.vue');
const PaymentsEdit = () => import('./pages/payments/Edit.vue');
const PageNotFound = () => import('./pages/PageNotFound.vue');

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: { name: 'payments.index' },
        },
        {
            name: "login",
            path: "/login",
            component: Login,
            meta: {
                middleware: "guest",
                title: 'Авторизация'
            }
        },
        {
            name: "register",
            path: "/register",
            component: Register,
            meta: {
                middleware: "guest",
                title: 'Регистрация'
            }
        },
        {
            name: 'profile',
            path: '/profile',
            component: Profile,
            meta: {
                middleware: "auth",
                title: 'Профиль'
            },
        },
        {
            name: 'payments.index',
            path: '/payments',
            component: PaymentsIndex,
            meta: {
                middleware: "auth",
                title: 'Выплаты'
            },
        },
        {
            name: 'payments.create',
            path: '/payments/create',
            component: PaymentsCreate,
            meta: {
                middleware: "auth",
                title: 'Создание выплаты'
            },
        },
        {
            name: 'payments.edit',
            path: '/payments/:payment/edit',
            component: PaymentsEdit,
            meta: {
                middleware: "auth",
                title: 'Редактирование выплаты'
            },
        },
        {
            path: "/:pathMatch(.*)",
            name: "page404",
            component: PageNotFound
        }
    ]
})

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();

    document.title = to.meta.title;

    console.log('to', to);

    if (to.meta.middleware === "guest") {
        if (authStore.authenticated) {
            next({name: "payments.index"})
        }
        next()
    } else {
        if (authStore.authenticated) {
            next()
        } else {
            next({name: "login"})
        }
    }
})

export default router
