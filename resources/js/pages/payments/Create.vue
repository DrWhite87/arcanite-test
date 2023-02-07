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
                            :error="!!validationErrors.user_id && validationErrors.user_id.length"
                            :error-messages="validationErrors.user_id"
                            @focus="validationErrors.user_id = []"
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
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn variant="outlined" color="black" @click="$router.push({name: 'payments.index'})">Назад</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn variant="outlined" color="blue" @click="store">{{ processing ? "Подождите" : "Сохранить" }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-sheet>
    </v-container>
</template>

<script>
import {computed, reactive, ref} from 'vue';
import {usePaymentsStore} from "@/store/payments";
import {useRoute, useRouter} from "vue-router";

export default {
    name: 'PaymentsEdit',
    setup() {
        const PaymentsStore = usePaymentsStore();
        const currency = computed(() => {
            return Object.keys(PaymentsStore.currency).map((key) => {
                return {value: key, label: PaymentsStore.currency[key]};
            })
        });
        const users = computed(() => PaymentsStore.users);

        const router = useRouter();

        PaymentsStore.create();

        const form = reactive({
            user_id: "",
            requisites: "",
            amount: "",
            currency: "",
        });

        const validationErrors = ref({});
        const processing = ref(false);
        const updated = ref(false);

        const store = async () => {
            processing.value = true;
            await PaymentsStore.store(form).then(({data}) => {
                validationErrors.value = {};
                router.push({name: 'payments.index'});
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
            currency,
            users,
            updated,
            store
        }
    }
}
</script>
