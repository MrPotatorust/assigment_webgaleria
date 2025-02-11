<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InventoryComponent from "@/Components/Inventory/InventoryComponent.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <GuestLayout>
        <div class="min-h-screen flex items-center justify-center">
            <div class="text-center max-w-2xl">
                <!-- Laravel-style logo -->
                <div class="mb-8 flex justify-center">
                    <svg
                        class="h-16 w-16 text-red-600"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"
                        />
                    </svg>
                </div>

                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    Welcome to the Inventory System
                </h1>

                <p class="text-xl text-gray-600 mb-8">
                    Please head over to the
                    <span class="text-red-600 font-medium">Inventory Tab</span>
                    in the navigation to manage your products.
                </p>

                <a
                    :href="route('inventory.index')"
                    class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition-colors text-lg font-medium shadow-sm hover:shadow-md"
                >
                    Go to Inventory →
                </a>
            </div>
        </div>
    </GuestLayout>
</template>
