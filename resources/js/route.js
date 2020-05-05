import redirectIfAuthenticated from "./middleware/redirectIfAuthenticated";
import auth from "./middleware/auth";

export default [
    {
        path: '/login',
        name: 'login',
        component: require('./components/LoginFamilyComponent.vue').default,
        meta: {
            middleware: [
                redirectIfAuthenticated
            ]
        }
    },
    {
        path: '/register',
        name: 'register',
        component: require('./components/RegisterFamilyComponent.vue').default,
        meta: {
            middleware: [
                redirectIfAuthenticated
            ]
        }
    },
    {
        path: '/',
        name: 'profile',
        component: require('./components/FamilyProfileComponent.vue').default,
        meta: {
            middleware: [
                auth
            ]
        }
    },
    {
        path: '/update',
        name: 'update',
        component: require('./components/UpdateFamilyComponent.vue').default,
        meta: {
            middleware: [
                auth
            ]
        }
    },
    {
        path: '/students',
        name: 'students',
        component: require('./components/StudentListComponent.vue').default,
        meta: {
            middleware: [
                auth
            ]
        }
    }
]
