<script setup>
defineProps(["part"]);
</script>

<template>
    <tr>
        <td>
            {{ part.name }}
        </td>
        <td>{{ part.serialnumber }}</td>
        <td>{{ part.created_at }}</td>
        <td>{{ part.updated_at }}</td>
    </tr>
</template>
