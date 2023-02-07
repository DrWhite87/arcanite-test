import {defineStore} from 'pinia';
import axios from 'axios';
import {ref, reactive} from 'vue';
import handleError from '@/libs/axiosErrorHandler';

export const usePaymentsStore = defineStore(
    'payments',
    () => {
        const payment = ref({});
        const payments = ref({});
        const statuses = ref([]);
        const currency = ref([]);
        const users = ref([]);
        const query = reactive({
            page: 1
        });

        const fetchAll = () => {
            axios.get('/api/payments?' + (new URLSearchParams(query))).then(({data}) => {
                if (data.success) {
                    payments.value = data.data.payments;
                    statuses.value = data.data.statuses;
                    currency.value = data.data.currency;
                }
            }).catch((error) => {
                handleError(error);
            });
        };

        const create = () => {
            return axios.get('/api/payments/create').then(({data}) => {
                if (data.success) {
                    currency.value = data.data.currency;
                    users.value = data.data.users;
                }
            }).catch((error) => {
                handleError(error);
            });
        };

        const store = (data) => {
            return axios.post('/api/payments', data).catch((error) => {
                handleError(error);
            });
        };

        const edit = (id) => {
            return axios.get('/api/payments/' + id + '/edit').then(({data}) => {
                if (data.success) {
                    payment.value = data.data.payment;
                    statuses.value = data.data.statuses;
                    currency.value = data.data.currency;
                    users.value = data.data.users;
                }
            }).catch((error) => {
                handleError(error);
            });
        };

        const update = (id, data) => {
            return axios.patch('/api/payments/' + id, data).catch((error) => {
                handleError(error);
            });
        };

        const updateStatus = (id, status) => {
            return axios.patch('/api/payments/' + id + '/updateStatus', {status}).catch((error) => {
                handleError(error);
            });
        };

        const destroy = (id) => {
            return axios.delete('/api/payments/' + id).then(({data}) => {
                if (data.success) {
                    fetchAll();
                }
            }).catch((error) => {
                handleError(error);
            });
        };

        return {
            payment,
            payments,
            statuses,
            currency,
            users,
            query,
            fetchAll,
            create,
            store,
            edit,
            update,
            updateStatus,
            destroy
        }
    },
    {
        persist: {
            paths: ['query'],
        },
    }
);
