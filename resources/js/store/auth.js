import {defineStore} from 'pinia';
import axios from 'axios';
import router from '@/router';
import {ref} from 'vue';
import handleError from '@/libs/axiosErrorHandler'


export const useAuthStore = defineStore(
    'auth',
    () => {
        const authenticated = ref(false);
        const viewer = ref({});

        const login = async (form) => {
            await axios.get('/sanctum/csrf-cookie');
            return axios.post('/api/login', form).then(({data}) => {
                viewer.value = data.data.user;
                authenticated.value = true;
                router.push({name: 'payments.index'});
            }).catch((error) => {
                viewer.value = {};
                authenticated.value = false;
                handleError(error);
                return error;
            });
        };

        const logout = () => {
            return axios.post('/api/logout').then(() => {
                viewer.value = {};
                authenticated.value = false;
                router.push({name: "login"});
            }).catch((error) => {
                handleError(error);
                return error;
            });
        }

        return {
            authenticated,
            viewer,
            login,
            logout
        }
    },
    {
        persist: true,
    }
);
