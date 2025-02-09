<script setup>
import Car from "./CarRow.vue";
defineProps(["cars"]);
</script>

<template>
    <table class="w-6xl border-2 border-gray-300">
        <thead class="text-lg">
            <tr class="text-left">
                <td class="w-16 p-2"></td>
                <td class="w-16 p-2">#</td>
                <td class="w-24 p-2">Name</td>
                <td class="w-16 p-2">Registration number</td>
                <td class="w-18 p-2">Is registered</td>
                <td class="w-18 p-2">Created at</td>
                <td class="w-18 p-2">Updated at</td>
                <td class="w-16 p-2">Controls</td>
            </tr>
        </thead>
        <Car v-for="car in cars" :key="car.id" :car="car" />
    </table>
</template>
