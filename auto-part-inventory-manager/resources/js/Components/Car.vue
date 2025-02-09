<script setup>
import Part from "./Part.vue";

defineProps(["car"]);
</script>

<template>
    <!-- {{ car }} -->
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">
                    {{ car.name }}
                </th>
                <th>
                    {{ car.registration_number }}
                </th>
                <th>{{ car.is_registered }}</th>
                <th>{{ car.created_at }}</th>
                <th>{{ car.updated_at }}</th>
            </tr>
        </thead>
        <tbody>
            <Part v-for="part in car.parts" :key="part.id" :part="part" />
        </tbody>
    </table>
</template>