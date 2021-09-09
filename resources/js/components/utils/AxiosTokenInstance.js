import axios from 'axios';
import store from '../store/store';
import { GET_USER_TOKEN_GETTER } from '../store/storeconstants';
const axiosInstance = axios.create({});

axiosInstance.interceptors.request.use((config) => {
    // let token = store.getters[`auth/${GET_USER_TOKEN_GETTER}`];
    let token = JSON.parse(localStorage.getItem('userData'))['token']
    config.headers['Authorization'] = 'Bearer ' + token;
    return config;
});

export default axiosInstance;
