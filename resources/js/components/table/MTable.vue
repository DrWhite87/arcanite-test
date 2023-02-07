<script setup>
import MThead from "./MThead.vue";
import MTBody from "./MTBody.vue";
import MTPagination from "./MTPagination.vue";
import {computed, useSlots, ref, watch} from 'vue';

const props = defineProps({
    resources: {
        type: Object,
        required: false,
        default: () => {
            return {};
        },
    },
    paginatorLimit: {
        type: Number,
        required: false,
        default: () => {
            return 3;
        },
    },
    sort: {
        type: String,
        required: false,
        default: () => {
            return '';
        },
    },
    rowClass: {
        type: [String, Object],
        required: false,
        default: () => {
            return {};
        },
    },
    page: {
        type: Number,
        required: false,
        default: () => {
            return null;
        },
    },
});

const slots = useSlots();

const pageModel = ref(props.page);

const columns = computed(() => {
    let result = [];

    if (slots.default) {
        slots.default().forEach(item => {
            result.push(item);
        })
    }

    return result;
});

const emit = defineEmits(['clickRow', 'sortChange', 'paginationChangePage']);

const onClickRow = (row) => {
    emit('clickRow', row);
}

watch(pageModel, () => {
    onPaginationChangePage(pageModel);
})

const onPaginationChangePage = (page) => {
    emit('paginationChangePage', page);
}

const onSortChange = (sortValue) => {
    emit('sortChange', sortValue);
};
</script>

<template>
    <div>
        <slot></slot>
        <v-table>
            <MThead
                :columns="columns"
                :sort="sort"
                @sortChange="onSortChange"
            />
            <MTBody
                :columns="columns"
                :resources="resources.data"
                @clickRow="onClickRow"
                :rowClass="rowClass"
            />
        </v-table>
    </div>
    <div class="text-center mt-6 mb-4" v-if="resources.meta">
        <v-pagination
            v-model="pageModel"
            :length="resources.meta.last_page"
            :total-visible="7"
        ></v-pagination>
    </div>
</template>


<style scoped>

</style>
