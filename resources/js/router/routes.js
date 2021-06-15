import store from '../store'

export default [
    {
        path: '/',
        meta: { authRequired: true },
        name: 'home',
        component: () => import('../contains/home'),
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
    // {
    //     path: '/forgot-password',
    //     name: 'forgot-password',
    //     component: () => import('../contains/auth/forgot-password'),
    //     meta: {
    //         beforeResolve(routeTo, routeFrom, next) {
    //             // If the user is already logged in
    //             if (store.getters['isAuthenticated']) {
    //                 // Redirect to the home page instead
    //                 next({ name: 'home' })
    //             } else {
    //                 // Continue to the login page
    //                 next()
    //             }
    //         },
    //     },
    // },
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
        path: '/settings/company/create',
        name: 'CompanyCreate',
        component: () => import('../contains/settings/company/company-create'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/company/edit/:companyId',
        name: 'CompanyEdit',
        component: () => import('../contains/settings/company/company-edit'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/series-invoices',
        name: 'SeriesInvoices',
        component: () => import('../contains/settings/series-invoice/series-invoices'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/series-invoice/create',
        name: 'SeriesInvoiceCreate',
        component: () => import('../contains/settings/series-invoice/series-invoice-create'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/series-invoice/edit/:serieId',
        name: 'SeriesInvoiceEdit',
        component: () => import('../contains/settings/series-invoice/series-invoice-edit'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/sale-conditions',
        name: 'SaleConditions',
        component: () => import('../contains/settings/sale-condition/sale-conditions'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/sale-condition/create',
        name: 'SaleConditionCreate',
        component: () => import('../contains/settings/sale-condition/sale-condition-create'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/sale-condition/edit/:conditionId',
        name: 'SaleConditionEdit',
        component: () => import('../contains/settings/sale-condition/sale-condition-edit'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/payment-methods',
        name: 'PaymentMethods',
        component: () => import('../contains/settings/payment-method/payment-methods'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/payment-method/create',
        name: 'PaymentMethodCreate',
        component: () => import('../contains/settings/payment-method/payment-method-create'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/payment-method/edit/:paymentMethodId',
        name: 'PaymentMethodEdit',
        component: () => import('../contains/settings/payment-method/payment-method-edit'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/banks',
        name: 'Banks',
        component: () => import('../contains/settings/bank/banks'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/bank/create',
        name: 'BankCreate',
        component: () => import('../contains/settings/bank/bank-create'),
        meta: {
            authRequired: true,
        },
    },
    {
        path: '/settings/bank/edit/:bankId',
        name: 'BankEdit',
        component: () => import('../contains/settings/bank/bank-edit'),
        meta: {
            authRequired: true,
        },
    },
    { 
        path: '*', 
        component: () => import('../contains/404/NotFoundPage.vue'), 
    }
]