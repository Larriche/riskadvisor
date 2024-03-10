<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                                Welcome to your admin dashboard!
                            </h1>

                            <p class="mt-6 text-gray-500 leading-relaxed">
                                Here you can view a summary of submissions for quotes made by potential clients and get in touch with them.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                            <div class="text-center">
                                <h1 class="text-7xl text-gray-500">{{ customers ?? 0 }}</h1>
                                <p>Customers</p>
                            </div>

                            <div class="text-center">
                                <h1 class="text-7xl text-gray-500">{{ submissions ?? 0 }}</h1>
                                <p>Submissions for Quotes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps(['submissions', 'customers']);
</script>
