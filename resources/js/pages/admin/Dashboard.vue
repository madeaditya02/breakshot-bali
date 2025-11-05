<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
const page = usePage()
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="rounded-xl overflow-x-auto p-4">
            <h1 class="text-3xl font-semibold">
                Selamat Datang {{ page.props.auth.user.name }}
            </h1>
        </div>
    </AppLayout>
</template>
