<script setup>
import {computed} from 'vue';

const props = defineProps({
    resources: {
        type: Object,
        required: false,
        default: () => {
            return {};
        },
    },
    limit: {
        type: Number,
        required: false,
        default: () => {
            return 3;
        },
    },
});

const emit = defineEmits(['paginationChangePage']);

const currentPage = computed(() => props.resources.meta.current_page);
const perPage = computed(() => props.resources.meta.per_page);
const firstPageUrl = computed(() => props.resources.meta.first_page_url);
const from = computed(() => props.resources.meta.from);
const lastPage = computed(() => props.resources.meta.last_page);
const lastPageUrl = computed(() => props.resources.meta.last_page_url);
const nextPageUrl = computed(() => props.resources.meta.next_page_url);
const prevPageUrl = computed(() => props.resources.meta.prev_page_url);
const to = computed(() => props.resources.meta.to);
const total = computed(() => props.resources.meta.total);
const pageRange = computed(() => {
    if (props.limit === -1) {
        return 0;
    }

    if (props.limit === 0) {
        return lastPage.value;
    }

    let current = currentPage.value;
    let last = lastPage.value;
    let delta = props.limit;
    let left = current - delta;
    let right = current + delta + 1;
    let range = [];
    let pages = [];
    let l;

    for (let i = 1; i <= last; i++) {
        if (i === 1 || i === last || (i >= left && i < right)) {
            range.push(i);
        }
    }

    range.forEach(function (i) {
        if (l) {
            if (i - l === 2) {
                pages.push(l + 1);
            } else if (i - l !== 1) {
                pages.push('...');
            }
        }
        pages.push(i);
        l = i;
    });

    return pages;
});

const previousPage = () => {
    selectPage((currentPage.value - 1));
};
const nextPage = () => {
    selectPage((currentPage.value + 1));
};
const selectPage = (page) => {
    if (page === '...') {
        return;
    }

    emit('paginationChangePage', page);
}
</script>

<template>
    <ul
        v-if="total > perPage"
        class="pagination">
        <li class="page-item pagination-prev-nav" :class="{'disabled': !prevPageUrl}" v-if="prevPageUrl">
            <a class="page-link text-secondary" href aria-label="Previous" :tabindex="!prevPageUrl && -1" @click.prevent="previousPage">
                <slot name="prev-nav">
                    <span aria-hidden="true">&laquo;</span>
                </slot>
            </a>
        </li>

        <li class="page-item pagination-page-nav"
            v-for="(page, key) in pageRange"
            :key="key">
            <a class="page-link text-secondary"
               href @click.prevent="selectPage(page)"
               :aria-current="page === currentPage ? 'page' : null"
               :class="{
                'bg-dark': page === currentPage,
                'text-white': page === currentPage,
                'text-white': page === currentPage,
                'border-dark': page === currentPage
            }"
            >
                {{ page }}
            </a>
        </li>

        <li class="page-item pagination-next-nav" :class="{'disabled': !nextPageUrl}" v-if="nextPageUrl">
            <a class="page-link text-secondary" href aria-label="Next" :tabindex="!nextPageUrl && -1" @click.prevent="nextPage">
                <slot name="next-nav">
                    <span aria-hidden="true">&raquo;</span>
                </slot>
            </a>
        </li>

    </ul>
</template>
