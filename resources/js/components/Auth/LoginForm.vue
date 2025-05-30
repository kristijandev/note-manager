<template>
    <form @submit.prevent="submit"
          class="bg-white rounded-xl shadow-lg max-w-sm w-full p-6 sm:p-8 space-y-6 mx-4">
        <h2 class="text-2xl font-bold text-gray-800 text-center">Sign In</h2>

        <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <input v-model="form.email" type="email" required
                   class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
            <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Password</label>
            <input v-model="form.password" type="password" required
                   class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
            <p v-if="errors.password" class="mt-1 text-sm text-red-600">{{ errors.password }}</p>
        </div>

        <button type="submit" :disabled="loading"
                class="w-full flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md disabled:opacity-50">
            <svg v-if="loading" class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
            </svg>
            <span>{{ loading ? 'Signing in...' : 'Sign In' }}</span>
        </button>

        <p class="text-center text-gray-600 text-sm">
            Don’t have an account?
            <button type="button" @click="$emit('switch')"
                    class="text-blue-600 hover:text-blue-800 underline ml-1">Register</button>
        </p>

        <p v-if="serverError" class="mt-2 text-center text-sm text-red-600">{{ serverError }}</p>
    </form>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return { form: { email: '', password: '' }, errors: {}, serverError: '', loading: false }
    },
    methods: {
        async submit() {
            this.errors = {}; this.serverError = ''; this.loading = true
            try {
                const { data } = await axios.post('/api/login', this.form)
                localStorage.setItem('token', data.api_token)
                this.$emit('login-success')
            } catch (e) {
                if (e.response?.status === 422) this.errors = e.response.data.errors
                else this.serverError = e.response?.data?.message || 'Unexpected error'
            } finally { this.loading = false }
        }
    }
}
</script>
