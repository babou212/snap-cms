<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DeleteImageForm from './Partials/DeleteImageForm.vue';
import UploadImageForm from './Partials/UploadImageForm.vue';

defineProps({
    images: {
        type: Array,
        default: () => {},
    },
});
</script>

<template>
    <Head title="Image Upload" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Images
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <UploadImageForm />
                </div>
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <DeleteImageForm :images="images" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
