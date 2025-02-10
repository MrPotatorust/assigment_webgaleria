<script setup>
defineProps(["part"]);
import dayjs from "dayjs";
</script>

<template>
    <tr>
        <td>
            {{ part.name }}
        </td>
        <td>{{ part.serialnumber }}</td>
        <td>{{ dayjs(part.created_at).format("YYYY-MM-DD HH:mm") }}</td>
        <td>{{ dayjs(part.updated_at).format("YYYY-MM-DD HH:mm") }}</td>
    </tr>
</template>
