const store = {
    state: {
        loading: false,

    },

    mutations: {
        setLoading (state, value) {
            state.loading = value;
        },

    }
};

export default store;