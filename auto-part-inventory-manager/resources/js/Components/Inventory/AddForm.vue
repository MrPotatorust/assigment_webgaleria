<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const createErrors = ref();
const success = ref(false);
const car = ref({
    name: "",
    registration_number: "",
    is_registered: "false",
});

function handleCreate() {
    router.post(route("inventory.car.store"), car.value, {
        onSuccess: () => {
            car.value = {
                name: "",
                registration_number: "",
                is_registered: "false",
            };
            createErrors.value = null;
            success.value = true;
        },
        onError: (errors) => {
            createErrors.value = errors;
        },
        preserveScroll: true,
    });
}
</script>

<template>
    <form @submit.prevent="handleCreate" class="mb-4">
        <h2 class="h4 pt-5">Create car</h2>
        <div class="form-group">
            <label>Name</label>
            <input
                v-model="car.name"
                type="text"
                class="form-control"
                name="name"
                required
            />
        </div>
        <div class="form-group">
            <label>Registration number</label>
            <input
                v-model="car.registration_number"
                type="text"
                class="form-control"
                name="registration_number"
                required
            />
        </div>
        <div class="form-group">
            <label>Is registered</label>
            <select
                v-model="car.is_registered"
                class="form-control"
                name="is_registered"
                required
            >
                <option value="true">true</option>
                <option value="false">false</option>
            </select>
        </div>
        <button class="btn btn-primary mt-3">Create</button>
        <ul v-if="createErrors" class="mt-2 list-unstyled">
            <li v-for="error in createErrors" class="text-danger">
                {{ error }}
            </li>
        </ul>
        <p v-if="success" class="text-success mt-2">
            Successfully created a car.
        </p>
    </form>
</template>
