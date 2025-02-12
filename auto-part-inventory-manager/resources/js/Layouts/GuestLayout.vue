<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <Link
            :href="route('home')"
            class="navbar-brand mb-0 ml-4 h1"
            style="margin-left: 1em"
            >Home</Link
        >
        <Link :href="route('inventory.index')" class="navbar-brand mb-0 ml-4 h1"
            >Inventory</Link
        >

        <!-- Navigation Links -->
        <!-- <div class="justify-content-end">
            <Link :href="route('login')" class=""> Login </Link>
            <Link :href="route('register')" class=""> Register </Link>
        </div> -->
    </nav>
    <slot />
</template>
