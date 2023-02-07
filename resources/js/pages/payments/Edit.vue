<template>
    <v-container fluid>
        <v-sheet width="800" class="mx-auto">
            <v-card>
                <v-toolbar>
                    <v-toolbar-title class="text-grey-darken-3">Редактирование выплаты</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form @submit.prevent>
                        <v-select
                            v-model="form.user_id"
                            :items="users"
                            label="Логин"
                            item-title="name"
                            item-value="id"
                        ></v-select>
                        <v-textarea
                            bg-color="white"
                            v-model="form.requisites"
                            label="Реквизиты"
                            :error="!!validationErrors.requisites && validationErrors.requisites.length"
                            :error-messages="validationErrors.requisites"
                            @focus="validationErrors.requisites = []"
                        ></v-textarea>
                        <v-text-field
                            bg-color="white"
                            v-model="form.amount"
                            label="Сумма"
                            :error="!!validationErrors.amount && validationErrors.amount.length"
                            :error-messages="validationErrors.amount"
                            @focus="validationErrors.amount = []"
                        ></v-text-field>
                        <v-select
                            v-model="form.currency"
                            :items="currency"
                            label="Валюта"
                            item-title="label"
                            item-value="value"
                            :error="!!validationErrors.currency && validationErrors.currency.length"
                            :error-messages="validationErrors.currency"
                            @focus="validationErrors.currency = []"
                        ></v-select>
                        <v-select
                            v-model="form.status"
                            :items="statuses"
                            label="Статус"
                            item-title="label"
                            item-value="value"
                            :error="!!validationErrors.status && validationErrors.status.length"
                            :error-messages="validationErrors.status"
                            @focus="validationErrors.status = []"
                        ></v-select>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn variant="outlined" color="black" @click="$router.push({name: 'payments.index'})">Назад</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn variant="outlined" color="blue" @click="update">{{ processing ? "Подождите" : "Сохранить" }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-sheet>
    </v-container>

    <v-snackbar
        v-model="updated"
        location="top right"
    >
        Сохранено!

        <template v-slot:actions>
            <v-btn
                color="white"
                variant="text"
                @click="updated = false"
            >
                X
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
import {computed, reactive, ref} from 'vue';
import {usePaymentsStore} from "@/store/payments";
import {useRoute, useRouter} from "vue-router";

export default {
    name: 'PaymentsEdit',
    setup() {
        const PaymentsStore = usePaymentsStore();
        const payment = computed(() => PaymentsStore.payment);
        const statuses = computed(() => {
            return Object.keys(PaymentsStore.statuses).map((key) => {
                return {value: parseInt(key), label: PaymentsStore.statuses[key]};
            })
        });
        const currency = computed(() => {
            return Object.keys(PaymentsStore.currency).map((key) => {
                return {value: key, label: PaymentsStore.currency[key]};
            })
        });
        const users = computed(() => PaymentsStore.users);

        const route = useRoute();
        const router = useRouter();

        PaymentsStore.edit(route.params.payment);

        const form = reactive(payment);

        const validationErrors = ref({});
        const processing = ref(false);
        const updated = ref(false);

        const update = async () => {
            processing.value = true;
            updated.value = false;
            await PaymentsStore.update(route.params.payment, form.value).then(({data}) => {
                validationErrors.value = {};
                updated.value = true;
                setTimeout(() => {
                    router.push({name: 'payments.index'});
                }, 300);
            }).catch(({response}) => {
                if (response.status === 422) {
                    validationErrors.value = response.data.errors;
                } else {
                    validationErrors.value = {};
                }
            }).finally(() => {
                processing.value = false;
            })
        }

        return {
            form,
            validationErrors,
            processing,
            statuses,
            currency,
            users,
            updated,
            update
        }
    }
}
</script>
