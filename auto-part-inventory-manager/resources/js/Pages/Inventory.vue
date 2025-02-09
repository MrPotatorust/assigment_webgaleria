<script setup>
import Car from "@/Components/Car.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps(["cars"]);
</script>

<template>
    <Head title="Inventory" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Inventory
            </h2>
        </template>

        <main>
            <Car v-for="car in cars" :key="car.id" :car="car" />
        </main>
    </AuthenticatedLayout>
</template>
