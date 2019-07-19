import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        categories: [],
        items: []
    },
    mutations: {
        SET_CATEGORIES(state, categories) {
            state.categories = categories;
        },
        ADD_CATEGORIES(state, categories) {
            state.categories.push(category);
        },
        REMOVE_CATEGORY(state, index) {
            state.categories.splice(index, 1);
        },
        UPDATE_CATEGORY(state, {index, property, value}) {
            state.categories[index][property] = value;
        },
        SET_FEEDBACK(state, feedback) {
            state.feedback = feedback;
        }
    },
    actions: {
        saveCategories() {
            axios.post('/api/categories/upsert', {
                categories: this.categories
            })
                .then((res) => { // Callback - think AJAX
                    if (res.data.success) {
                        commit('SET_FEEDBACK', 'Changes saved.');
                        setTimeout(() => commit('SET_FEEDBACK', ''), 2000);
                        commit('SET_CATEGORIES', 'res.data.categories'); // Make id's are synced with the new category data
                    }
                });
        },
        removeCategory({commit, state}, index) { // Context object , index
            let id = this.categories[index].id; // Block scoped
            if (id > 0) { // Once user confirms delete, then actually delete the resource
                return axios.delete('/api/categories/' + id).then((res) => commit('REMOVE_CATEGORY'), index);
            }
            commit('REMOVE_CATEGORY', index);
        }
    }
})