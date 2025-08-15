<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
// import { Head, Link } from '@inertiajs/vue3';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs = [{ title: 'Dashboard', href: '/dashboard' }];

const form = useForm({});

const logout = () => {
    form.post(route('logout'), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Welcome</h5>
                        <p class="card-text">Your personalized dashboard for managing favorite lyrics.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Quick Actions</h5>
                        <p class="card-text">
                            <a href="/favorites" class="btn btn-primary btn-sm">View Favorites</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Stats</h5>
                        <p class="card-text">Track your favorite songs and artists.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button class="btn btn-danger" :disabled="form.processing" @click="logout">Log Out</button>
        </div>
    </AppLayout>
</template>
