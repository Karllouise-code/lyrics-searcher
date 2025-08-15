<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthSimpleLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthSimpleLayout title="Log in to your account" description="Enter your email and password below to log in">
        <Head title="Log in" />

        <div v-if="status" class="alert alert-success mb-3" role="alert">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="form-control"
                    placeholder="email@example.com"
                    required
                    autofocus
                    tabindex="1"
                    autocomplete="email"
                />
                <InputError :message="form.errors.email" class="mt-1" />
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="password" class="form-label">Password</label>
                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-decoration-none small" tabindex="5">
                        Forgot password?
                    </Link>
                </div>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    required
                    tabindex="2"
                    autocomplete="current-password"
                />
                <InputError :message="form.errors.password" class="mt-1" />
            </div>

            <div class="mb-3 form-check">
                <input
                    id="remember"
                    v-model="form.remember"
                    type="checkbox"
                    class="form-check-input"
                    tabindex="3"
                />
                <label for="remember" class="form-check-label">Remember me</label>
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
                tabindex="4"
                :disabled="form.processing"
            >
                <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Log in
            </button>

            <div class="text-center mt-3 small">
                Don't have an account?
                <Link :href="route('register')" class="text-decoration-none">Sign up</Link>
            </div>
        </form>
    </AuthSimpleLayout>
</template>