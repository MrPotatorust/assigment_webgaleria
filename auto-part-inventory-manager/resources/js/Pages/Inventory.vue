<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BaseTable from "@/Components/Inventory/Tables/CarTable.vue";
import InventoryComponent from "@/Components/Inventory/InventoryComponent.vue";
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps(["cars"]);
</script>

<template>
    <Head title="Inventory" />

    <!-- <AuthenticatedLayout> -->
    <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Inventory
            </h2>
        </template> -->

    <GuestLayout>
        <main class="container">
            <h2 class="text-center mt-4">Inventory</h2>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <InventoryComponent :cars="cars" />
                </div>
            </div>
        </main>
    </GuestLayout>
    <!-- </AuthenticatedLayout> -->
</template>
