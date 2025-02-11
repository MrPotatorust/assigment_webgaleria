<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BaseTable from "@/Components/Inventory/Tables/CarTable.vue";
import InventoryComponent from "@/Components/Inventory/InventoryComponent.vue";
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
            <div class="justify-items-center">
                <InventoryComponent :cars="cars" />
            </div>
        </main>
    </AuthenticatedLayout>
</template>
