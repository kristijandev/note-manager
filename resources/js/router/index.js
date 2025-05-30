import { createRouter, createWebHistory } from 'vue-router'
import AuthView from '../components/AuthView.vue'
import Dashboard from '../components/Dashboard.vue'

const routes = [
    { path: '/', component: AuthView },
    { path: '/dashboard', component: Dashboard }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

// Navigation guard
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('token')

    if (to.path === '/dashboard' && !isAuthenticated) {
        next('/')
    }

    else if (to.path === '/' && isAuthenticated) {
        next('/dashboard')
    }

    else {
        next()
    }
})

export default router
