import store from '../store'

// import AuthLayout from '@/contain/auth/AuthLayout.vue';
// import AdminLayout from '@/contain/admin/Layout/Layout.vue';
// GeneralViews
import NotFound from '@/contain/404/NotFoundPage.vue';

// Pages
const Login = () => import(/* webpackChunkName: "pages" */ '@/contain/auth/login.vue');
const Register = () => import(/* webpackChunkName: "pages" */ '@/contain/auth/register.vue');
const ForgotPassword = () => import(/* webpackChunkName: "pages" */ '@/contain/auth/forgot-password.vue');

let authPages = {
  path: '/',
  component: AuthLayout,
  name: 'Authentication',
  children: [
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: {
        beforeResolve(routeTo, routeFrom, next) {
            // If the user is already logged in
            if (store.getters['isAuthenticated']) {
                // Redirect to the home page instead
                if (store.getters['currentRole'] == 'Admin') {
                    next({ name: 'AdminUsers' })
                } else if (store.getters['currentRole'] == 'Passenger') {
                    next({ name: 'Passenger' })
                }
            } else {
                // Continue to the login page
                next()
            }
        },
      },
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
      meta: {
        beforeResolve(routeTo, routeFrom, next) {
            // If the user is already logged in
            if (store.getters['isAuthenticated']) {
                // Redirect to the home page instead
                if (store.getters['currentRole'] == 'Admin') {
                    next({ name: 'AdminUsers' })
                } else if (store.getters['currentRole'] == 'Passenger') {
                    next({ name: 'Passenger' })
                }
            } else {
                // Continue to the login page
                next()
            }
        },
      },
    },
    {
      path: '/forgot-password',
      name: 'ForgotPassword',
      component: ForgotPassword
    },
    {
      path: '/logout',
      name: 'logout',
      meta: {
        authRequired: true,
        beforeResolve(routeTo, routeFrom, next) {
            store.dispatch('logout')
            // const authRequiredOnPreviousRoute = routeFrom.matched.some(
            //     (route) => route.push({ name: 'Login' })
            // )
            // // Navigate back to previous page, or home as a fallback
            // next(authRequiredOnPreviousRoute ? { name: 'AdminUsers' } : { ...routeFrom })
            next({name: 'Login'});
        },
      },
    },
    { path: '*', component: NotFound }
  ]
};

const routes = [
  {
    path: '/',
    component: AdminLayout,
    redirect: '/admin/users',
    meta: {
      authRequired: true,
      beforeResolve(routeTo, routeFrom, next) {
          if (store.getters['currentRole'] == 'Admin') {
              next()
          } else {
              next({ name: 'Login' })
          }
      },
    },
    children: [
    //   {
    //     path: 'users',
    //     name: 'AdminUsers',
    //     component: () => import('../contain/admin/users/users.vue'),
    //   },
    ]
  },
  authPages,
];

export default routes;
