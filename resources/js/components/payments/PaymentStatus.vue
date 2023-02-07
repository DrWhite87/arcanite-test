<template>
    <template v-for="(text, k) in statuses">
        <v-chip
            v-if="status === parseInt(k)"
            class="ma-2 status-activator"
            :color="parseInt(k) === 2 ? 'green' : 'red'"
            text-color="white"
            link
        >
            {{ text }}
        </v-chip>
    </template>

    <v-menu activator="parent">
        <v-list>
            <v-list-item v-for="(text, k) in statuses" :key="k" :value="k">
                <v-list-item-title @click="onStatusClick(k)">{{text}}</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>

<script>
export default {
    name: "PaymentStatus",
    props: {
        status: {
            type: Number,
            required: true
        },
        statuses: {
            type: Object,
            required: true
        }
    },
    emits: ['change-status'],
    setup(props, { emit }){
        const onStatusClick = (status) => {
            if(props.status !== parseInt(status)){
                emit('change-status', status);
            }
        };

        return {
            onStatusClick
        }
    }
}
</script>

<style scoped>

</style>
