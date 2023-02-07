<script setup>
import MTHeadSort from "./MTHeadSort.vue";

defineProps({
    columns: {
        type: Array,
        required: true,
        default: () => {
            return [];
        },
    },
    sort: {
        type: String,
        required: false,
        default: () => {
            return '';
        },
    },
})

const emit = defineEmits(['sortChange']);

const onSortChange = (sortValue) => {
    emit('sortChange', sortValue);
};

</script>

<template>
    <thead>
    <tr>
        <th
            v-for="(column, index) in columns"
            :key="'thead-' + column.props.attribute"
            scope="col"
        >
            <template v-if="!column.props.sortable">{{ column.props.label }}</template>
            <MTHeadSort
                v-else
                :label="column.props.label"
                :attribute="column.props.attribute"
                :sort="sort"
                @sortChange="onSortChange"
            />
        </th>
    </tr>
    </thead>
</template>



<style scoped>

</style>
