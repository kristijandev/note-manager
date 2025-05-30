<template>
    <div class="p-6 bg-gray-50 min-h-screen">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <button @click="logout"
                    class="text-red-600 hover:text-red-800">Logout</button>
        </header>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Notes list -->
            <div class="bg-white p-4 rounded shadow space-y-4">
                <h2 class="text-xl font-semibold mb-2">All Notes</h2>
                <div class="mb-4">
                    <label for="userFilter" class="block text-sm font-medium text-gray-700">Filter by User</label>
                    <select v-model="selectedUserId" id="userFilter"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            @change="filterNotes">
                        <option value="">All Users</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>
                <ul class="space-y-2">
                    <li v-for="note in notes" :key="note.id"
                        class="p-3 border rounded hover:bg-gray-50">
                        <h3 class="font-semibold">{{ note.title }}</h3>
                        <p class="text-sm text-gray-600">{{ note.body }}</p>
                        <p class="text-xs text-gray-400">By: {{ note.user.name }}</p>
                    </li>
                </ul>
            </div>

            <!-- New note form -->
            <div class="bg-white p-4 rounded shadow space-y-4">
                <h2 class="text-xl font-semibold mb-2">Create New Note</h2>
                <form @submit.prevent="createNote" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-1">User</label>
                        <select v-model="newNote.user_id"
                                class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            <option v-for="u in users" :value="u.id">{{ u.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Title</label>
                        <input v-model="newNote.title" type="text"
                               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Body</label>
                        <textarea v-model="newNote.body" rows="3"
                                  class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded disabled:opacity-50"
                            :disabled="creating">
                        {{ creating ? 'Saving...' : 'Save Note' }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            users: [],
            notes: [],
            selectedUserId: '',
            newNote: { user_id: null, title: '', body: '' },
            creating: false,
        }
    },
    async created() {
        await this.loadUsers()
        await this.loadNotes()
    },
    methods: {
        async loadUsers() {
            const res = await axios.get('/api/users', { headers: authHeader() })
            this.users = res.data
        },
        async loadNotes() {
            let url = '/api/notes'
            if (this.selectedUserId) {
                url += `?user_id=${this.selectedUserId}`
            }
            const res = await axios.get(url, { headers: authHeader() })
            this.notes = res.data
        },
        filterNotes() {
            this.loadNotes()
        },
        async createNote() {
            this.creating = true
            try {
                const res = await axios.post('/api/notes', this.newNote, { headers: authHeader() })
                this.notes.push(res.data)
                this.newNote = { user_id: null, title: '', body: '' }
            } finally { this.creating = false }
        },
        logout() {
            localStorage.removeItem('token')
            this.$router.push('/')
        }
    }
}
function authHeader() {
    return { Authorization: `${localStorage.getItem('token')}` }
}
</script>
