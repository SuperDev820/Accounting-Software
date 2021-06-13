import store from '../store'

export default [
    {
        path: '/',
        meta: { authRequired: true },
        name: 'home',
        component: () => import('../contains/settings/company/companies'),
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../contains/auth/login'),
        meta: {
            beforeResolve(routeTo, routeFrom, next) {
                // If the user is already logged in
                if (store.getters['isAuthenticated']) {
                    // Redirect to the home page instead
                    next({ name: 'home' })
                } else {
                    // Continue to the login page
                    next()
                }
            },
        },
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../contains/auth/register'),
        meta: {
            beforeResolve(routeTo, routeFrom, next) {
                // If the user is already logged in
                if (store.getters['isAuthenticated']) {
                    // Redirect to the home page instead
                    next({ name: 'home' })
                } else {
                    // Continue to the login page
                    next()
                }
            },
        },
    },
    {
        path: '/forgot-password',
        name: 'forgot-password',
        component: () => import('../contains/auth/forgot-password'),
        meta: {
            beforeResolve(routeTo, routeFrom, next) {
                // If the user is already logged in
                if (store.getters['isAuthenticated']) {
                    // Redirect to the home page instead
                    next({ name: 'home' })
                } else {
                    // Continue to the login page
                    next()
                }
            },
        },
    },
    {
        path: '/logout',
        name: 'logout',
        meta: {
            authRequired: true,
            beforeResolve(routeTo, routeFrom, next) {
                store.dispatch('logout')
                next({name: 'login'});
            },
        },
    },
    {
        path: '/settings/companies',
        name: 'Companies',
        component: () => import('../contains/settings/company/companies'),
        meta: {
            authRequired: true,
        },
    },
    { 
        path: '*', 
        component: () => import('../contains/404/NotFoundPage.vue'), 
    }
]