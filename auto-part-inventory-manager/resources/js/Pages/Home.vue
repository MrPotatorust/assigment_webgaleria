<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InventoryComponent from "@/Components/Inventory/InventoryComponent.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <GuestLayout>
        <main class="container my-auto">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <h1 class="display-4 mb-4 text-primary">
                                <i class="bi bi-boxes"></i> Inventory Management
                                System
                            </h1>
                            <p class="lead mb-4">
                                This is an assigment project. It is only a very
                                basic version.
                            </p>
                            <div
                                class="d-grid gap-2 d-sm-flex justify-content-sm-center"
                            >
                                <Link
                                    :href="route('inventory.index')"
                                    class="btn btn-primary btn-lg px-4 gap-3"
                                >
                                    <i class="bi bi-list-ul"></i> View Inventory
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </GuestLayout>
</template>
