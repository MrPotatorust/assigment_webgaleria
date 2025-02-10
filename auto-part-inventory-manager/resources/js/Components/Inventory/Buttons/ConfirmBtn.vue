<script setup>
import { router } from "@inertiajs/vue3";

const [url, carId, editedCar] = defineProps(["url", "carId", "editedCar"]);

function updateCar() {
    if (confirm("Are you sure?")) {
        router.put(route("inventory.update", props.car.id), editedCar.value, {
            onSuccess: () => {
                isEditing.value = false;
            },
        });
        changeEditing();
    }
}
</script>

<template>
    <button @click="updateCar">Confirm</button>
</template>
