<script setup>
import PartRow from "../Rows/PartRow.vue";

defineProps(["car"]);
</script>

<template>
    <tr>
        <td colspan="100%">
            <table class="w-full border-2 text-left">
                <tr class="font-italic">
                    <th>Part name</th>
                    <th>Serial number</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                <PartRow
                    v-for="part in car.parts"
                    :key="part.id"
                    :part="part"
                />
            </table>
        </td>
    </tr>
</template>
