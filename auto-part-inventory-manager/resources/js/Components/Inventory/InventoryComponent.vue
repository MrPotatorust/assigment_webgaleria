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

<style scoped>
@import url("https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css");
</style>
