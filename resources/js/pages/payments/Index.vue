<template>
    <v-container fluid>
        <v-row align="center">
            <v-col>
                <h1>{{ $route.meta.title }}</h1>
            </v-col>
            <v-col cols="5">
                <v-text-field
                    bg-color="white"
                    v-model="search"
                    label="Поиск"
                    @input="onSearchChange"
                ></v-text-field>
            </v-col>
            <v-col cols="1">
                <v-btn variant="outlined" color="blue" @click="$router.push({name: 'payments.create'})">Создать</v-btn>
            </v-col>
        </v-row>
        <v-card>
            <MTable
                :resources="payments"
                rowClass="cursor-pointer"
                @paginationChangePage="onPaginationChangePage"
                :sort="sort"
                :page="page"
                @sortChange="onSortChange"
            >
                <MTColumn attribute="users.name" label="Логин">
                    <template #body="{row}">
                        {{ row.user.name }}
                    </template>
                </MTColumn>
                <MTColumn attribute="requisites" label="Реквизиты"></MTColumn>
                <MTColumn attribute="amount" label="Сумма" :sortable="true"></MTColumn>
                <MTColumn attribute="currency" label="Валюта">
                    <template #body="{row}">
                        {{ currency[row.currency]}}
                    </template>
                </MTColumn>
                <MTColumn attribute="status" label="Статус" :sortable="true">
                    <template #body="{row}">
                        <PaymentStatus
                            :status="row.status"
                            :statuses="statuses"
                            @changeStatus="status => onChangeStatus(row, status)"
                        />
                    </template>
                </MTColumn>
                <MTColumn attribute="actions" label="Действия">
                    <template #body="{row}">
                        <div align="center">
                            <v-icon icon="mdi-cog" class="pointer"></v-icon>
                            <v-menu activator="parent">
                                <v-list>
                                    <v-list-item :to="{name: 'payments.edit', params: {payment: row.id}}" :key="row.id" :value="row.id">Редактировать</v-list-item>
                                    <v-list-item @click.prevent.stop="destroy(row.id)" :key="row.id" :value="row.id">Удалить</v-list-item>
                                </v-list>
                            </v-menu>
                        </div>
                    </template>
                </MTColumn>
            </MTable>
        </v-card>
    </v-container>
</template>

<script>
import {onMounted, computed} from 'vue';
import MTable from "@/components/table/MTable.vue";
import MTColumn from "@/components/table/MTColumn.vue";
import PaymentStatus from "@/components/payments/PaymentStatus.vue";
import {usePaymentsStore} from "@/store/payments";
import {useRoute} from "vue-router";

export default {
    name: "UserPayments",
    components: {PaymentStatus, MTColumn, MTable},
    setup() {
        const PaymentsStore = usePaymentsStore();
        const payments = computed(() => PaymentsStore.payments);
        const statuses = computed(() => PaymentsStore.statuses);
        const currency = computed(() => PaymentsStore.currency);
        const sort = computed(() => PaymentsStore.query.sort || '');
        const search = computed(() => PaymentsStore.query.search || '');
        const page = computed(() => PaymentsStore.query.page || '');
        const route = useRoute();

        PaymentsStore.fetchAll();

        /* destroy user */
        const destroy = (id) => {
            if (confirm("Are you sure you want to Delete")) {
                return PaymentsStore.destroy(id);
            }
        }

        /* change query page */
        const onPaginationChangePage = (page) => {
            PaymentsStore.query.page = page;
            PaymentsStore.fetchAll();
        }

        const onSortChange = (sort) => {
            PaymentsStore.query.sort = sort;
            PaymentsStore.fetchAll();
        };

        /* change query search */
        const onSearchChange = _.debounce((e) => {
            PaymentsStore.query.page = 1;
            PaymentsStore.query.search = e.target.value;
            PaymentsStore.fetchAll();
        }, 300);

        /* change query search */
        const onChangeStatus = async (payment, status) => {
            await PaymentsStore.updateStatus(payment.id, status).then(() => {
                payment.status = parseInt(status);
            });
        };

        return {
            payments,
            statuses,
            currency,
            sort,
            search,
            page,
            destroy,
            onPaginationChangePage,
            onSortChange,
            onSearchChange,
            onChangeStatus
        }
    }
}
</script>
