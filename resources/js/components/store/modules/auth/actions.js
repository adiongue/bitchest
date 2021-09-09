import Axios from 'axios';
import LoginValidations from '../../../utils/LoginValidations';
import {
    AUTH_ACTION,
    AUTO_LOGIN_ACTION,
    LOGIN_ACTION,
    LOGOUT_ACTION,
    SET_USER_TOKEN_DATA_MUTATION,
} from '../../storeconstants';

export default {
    [LOGOUT_ACTION](context) {
        context.commit(SET_USER_TOKEN_DATA_MUTATION, {
            email: null,
            token: null,
            expiresIn: null,
            refreshToken: null,
            userId: null,
        });
        localStorage.removeItem('userData');
    },

    async [LOGIN_ACTION](context, payload) {
        return context.dispatch(AUTH_ACTION, {
            ...payload,
            url: `http://127.0.0.1:8000/api/login`,
        });
    },

    [AUTO_LOGIN_ACTION](context) {
        let userDataString = localStorage.getItem('userData');

        if (userDataString) {
            let userData = JSON.parse(userDataString);
            context.commit(SET_USER_TOKEN_DATA_MUTATION, userData);
        }
    },

    async [AUTH_ACTION](context, payload) {
        let postData = {
            email: payload.email,
            password: payload.password,
            returnSecureToken: true,
        };
        let response = '';
        try {
            response = await Axios.post(payload.url, postData);
        } catch (err) {
            throw LoginValidations.getErrorMessageFromCode(
                err.response.data.message,
            );
        }

        if (response.status === 200) {
            let expirationTime = +response.data.expiresIn * 1000;

            let tokenData = {
                role: response.data.role,
                token: response.data.token,
                expiresIn: expirationTime,
                refreshToken: response.data.refreshToken,
            };

            localStorage.setItem('userData', JSON.stringify(tokenData));
            context.commit(SET_USER_TOKEN_DATA_MUTATION, tokenData);
        }
    },
};
