let Store = {
    state: {
        loading: true,
    },

    mutations: {
        setLoading(state, value) {
            state.loading = value;
        }
    },
};

export default Store;