<template>
    <div className="fixed inset-0 flex items-center justify-center bg-gray-100">
        <component :is="showLogin ? 'LoginForm' : 'RegisterForm'"
                   @switch="toggleForm"
                   @login-success="gotoDashboard"/>
    </div>
</template>

<script>
import LoginForm from './Auth/LoginForm.vue'
import RegisterForm from './Auth/RegisterForm.vue'

export default {
    components: {LoginForm, RegisterForm},
    data() {
        return {showLogin: true}
    },
    methods: {
        toggleForm() {
            this.showLogin = !this.showLogin
        },
        gotoDashboard() {
            this.$router.push('/dashboard')
        }
    }
}
</script>
