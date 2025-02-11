<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Logo -->

        <a :href="route('inventory.index')" class="navbar-brand mb-0 ml-4 h1"
            >Inventory</a
        >

        <!-- Navigation Links -->
        <!-- <div class="justify-content-end">
            <Link :href="route('login')" class=""> Login </Link>
            <Link :href="route('register')" class=""> Register </Link>
        </div> -->
    </nav>
    <slot />
</template>
