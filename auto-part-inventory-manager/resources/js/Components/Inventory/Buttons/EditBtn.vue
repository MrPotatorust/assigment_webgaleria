<script setup>
const isEditing = defineProps(["isEditing"]);

function changeEditing() {
    isEditing.value = !isEditing.value;
}
</script>

<template>
    <button @click="changeEditing">Edit</button>
</template>
