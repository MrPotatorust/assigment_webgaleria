<script setup>
import AddForm from "./AddForm.vue";
import CarTable from "./Tables/CarTable.vue";
defineProps(["cars"]);
</script>
<template>
    <div class="pb-10">
        <AddForm />
        <CarTable :cars="cars" />
    </div>
</template>
