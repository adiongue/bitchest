import {
    SET_AUTO_LOGOUT_MUTATION,
    SET_USER_TOKEN_DATA_MUTATION,
} from '../../storeconstants';

export default {
    [SET_USER_TOKEN_DATA_MUTATION](state, payload) {
        state.token = payload.token;
        state.role = payload.role;
        state.expiresIn = payload.expiresIn;
        state.refreshToken = payload.refreshToken;
        state.autoLogout = false;
    },

    [SET_AUTO_LOGOUT_MUTATION](state) {
        state.autoLogout = true;
    },
};
