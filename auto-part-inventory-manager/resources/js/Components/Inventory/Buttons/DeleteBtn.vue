<script setup>
import { router } from "@inertiajs/vue3";

const url = defineProps(["url"]);

function deleteCar() {
    if (confirm("Are you sure?")) {
        router.delete(route(url, props.car.id));
    }
}
</script>

<template>
    <button @click="deleteCar">Delete</button>
</template>
