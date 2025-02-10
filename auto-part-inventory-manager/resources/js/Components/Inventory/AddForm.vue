<script setup>
import { router } from "@inertiajs/vue3";

const createErrors = ref();

function handleCreate() {
    console.log(this.form);
    // router.post(route('inventory.store', ));
}
</script>

<template>
    <form @submit.prevent="handleCreate">
        <input type="text" name="name" required />
        <input type="text" name="registration_number" required />
        <select name="is_registered" required>
            <option value="true">true</option>
            <option value="false">false</option>
        </select>
    </form>
</template>
