<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthSimpleLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthSimpleLayout title="Sign up" description="Create an account to start searching lyrics">
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    placeholder="Your Name"
                    required
                    autofocus
                    tabindex="1"
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-1" />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="form-control"
                    placeholder="email@example.com"
                    required
                    tabindex="2"
                    autocomplete="email"
                />
                <InputError :message="form.errors.email" class="mt-1" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    required
                    tabindex="3"
                    autocomplete="new-password"
                />
                <InputError :message="form.errors.password" class="mt-1" />
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="form-control"
                    placeholder="Confirm Password"
                    required
                    tabindex="4"
                    autocomplete="new-password"
                />
                <InputError :message="form.errors.password_confirmation" class="mt-1" />
            </div>

            <button type="submit" class="btn btn-primary w-100" tabindex="5" :disabled="form.processing">
                <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Sign up
            </button>

            <div class="small mt-3 text-center">
                Already have an account?
                <Link :href="route('login')" class="text-decoration-none">Log in</Link>
            </div>
        </form>
    </AuthSimpleLayout>
</template>
