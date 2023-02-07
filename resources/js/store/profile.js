import {defineStore} from 'pinia';
import axios from 'axios';
import {ref} from 'vue';
import handleError from '@/libs/axiosErrorHandler';

export const useProfileStore = defineStore(
    'profile',
    () => {
        const profile = ref({});
        const token = ref('');

        const fetch = () => {
            return axios.get('/api/user').then(({data}) => {
                if (data.success) {
                    profile.value = data.data;
                }
            }).catch((error) => {
                handleError(error);
            });
        };

        const getToken = () => {
            return axios.post('/api/token').then(({data}) => {
                if (data.success) {
                    token.value = data.data.token;
                }
            }).catch((error) => {
                handleError(error);
            });
        };


        return {
            fetch,
            getToken,
            profile,
            token
        }
    }
);
