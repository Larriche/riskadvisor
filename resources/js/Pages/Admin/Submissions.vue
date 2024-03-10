<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Consumer Submissions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-2 py-2">
                    <table class="min-w-full text-left text-sm font-light text-surface mb-10">
                        <thead class="border-b border-neutral-200 font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-center">Customer Name</th>
                                <th scope="col" class="px-6 py-4 text-center">Email</th>
                                <th scope="col" class="px-6 py-4 text-center">Phone</th>
                                <th scope="col" class="px-6 py-4 text-center">Preferred Contact</th>
                                <th scope="col" class="px-6 py-4 text-center">Products</th>
                                <th scope="col" class="px-6 py-4 text-center">Address</th>
                                <th scope="col" class="px-6 py-4 text-center">Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-b border-neutral-200" v-for="submission  in submissions.data" :key="submission.id">
                                <td class="whitespace-nowrap px-6 py-4 text-center">{{ submission.consumer.first_name }} {{  submission.consumer.last_name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-center">{{  submission.consumer.email }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-center">{{  submission.phone }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-center">{{  getContactPreferenceText(submission.contact_preference) }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-center">
                                    <ul>
                                        <li v-for="product in submission.products" :key="product.id">{{  product.name }}</li>
                                    </ul>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-center">
                                    <p>{{ submission.apartment }}</p>
                                    <p>{{ submission.street_address }}</p>
                                    <p>{{ submission.city }}, {{ submission.state.code }}</p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-center">{{  $filters.formattedDate(submission.created_at) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <Pagination class="mt-6" :links="submissions.links" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps(['submissions']);

function getContactPreferenceText(name) {
    return name.charAt(0).toUpperCase() + name.slice(1);
}
</script>

