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
            console.log(errors);
            createErrors.value = errors;
        },
    });
}
</script>

<template>
    <form @submit.prevent="handleCreate">
        <h2 class="text-xl pt-5">Create car</h2>
        <label>
            Name
            <input v-model="car.name" type="text" name="name" required />
        </label>
        <label>
            Registration number
            <input
                v-model="car.registration_number"
                type="text"
                name="registration_number"
                required
            />
        </label>
        <label>
            Is registered
            <select v-model="car.is_registered" name="is_registered" required>
                <option value="true">true</option>
                <option value="false">false</option>
            </select>
        </label>
        <button class="border-2">Create</button>
        <ul v-if="createErrors">
            <li v-for="error in createErrors" class="text-red-500">
                {{ error }}
            </li>
        </ul>
        <p v-if="success" class="text-green-500">Successfully created a car.</p>
    </form>
</template>
