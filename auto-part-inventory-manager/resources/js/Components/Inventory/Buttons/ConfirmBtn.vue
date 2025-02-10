<script setup>
import { router } from "@inertiajs/vue3";

const props = defineProps(["url", "carId", "editedCar", "isEditing"]);

function updateCar() {
    if (confirm("Are you sure?")) {
        router.put(route(props.url, props.editedCar.id), props.editedCar.value);
        props.isEditing = false;
    }
}
</script>

<template>
    <button @click="updateCar">Confirm</button>
</template>
