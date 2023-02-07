<script setup>
import {computed, ref, watch} from "vue";

const props = defineProps({
    label: {
        type: String,
        default: "",
    },
    attribute: {
        type: String,
        default: "",
    },
    sort: {
        type: String,
        required: false,
        default: () => {
            return '';
        },
    },
});

const emit = defineEmits(['sortChange']);

const disableColor = 'lightgray';
const enableColor = 'black';

const downFill = computed(() => props.sort === props.attribute ? enableColor : disableColor);
const upFill = computed(() => props.sort === "-" + props.attribute ? enableColor : disableColor);

const setSortColors = () => {

}

watch(() => props.sort, () => {
    setSortColors();
})

const onSort = () => {
    let sortValue = props.sort;
    if (sortValue === props.attribute) {
        sortValue = '-' + sortValue;
    } else if (sortValue === "-" + props.attribute) {
        sortValue = '';
    } else {
        sortValue = props.attribute;
    }
    emit('sortChange', sortValue);
};
</script>

<template>
    <div class="d-flex align-center">
        <a href @click.prevent="onSort" class="text-grey-darken-1">{{ label }}</a>
        <div class="d-flex flex-column arrows">
            <svg
                class="d-inline-block arrow"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 15 15"
                fill="none"
            >
                <path d="M7.5 3L15 11H0L7.5 3Z" :fill="upFill"/>
            </svg>
            <svg
                class="d-inline-block arrow"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 15 15"
                fill="none"
            >
                <path
                    d="M7.49988 12L-0.00012207 4L14.9999 4L7.49988 12Z"
                    :fill="downFill"
                />
            </svg>
        </div>
    </div>
</template>

<style scoped lang="scss">
.arrows {
    margin-left: 0.5rem;
}

.arrow {
    width: 0.5rem;
    height: 0.5rem;
}
</style>
