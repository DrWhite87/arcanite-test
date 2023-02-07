import router from "@/router";
import {useAuthStore} from "@/store/auth";

export default (error) => {
    console.log('error', error);
    const authStore = useAuthStore();
    const statusCode = error.response.status;

    if (statusCode === 401) {
        if (authStore.authenticated) {
            authStore.viewer = {};
            authStore.authenticated = false;
        }
        router.push({name: 'login'});
        return;
    }

    if (statusCode === 404) {
        router.back();
        return;
    }

    throw error;
};
