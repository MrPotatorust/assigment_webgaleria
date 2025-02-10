<script setup>
import AddForm from "./AddForm.vue";
import CarTable from "./Tables/CarTable.vue";
defineProps(["isPublic"]);
</script>
<template>
    <div>
        <AddForm />
        <CarTable />
    </div>
</template>
