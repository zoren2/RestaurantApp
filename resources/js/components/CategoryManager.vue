<template>
    <form @submit.prevent="saveCategories">
        <a @click="addCategory" class="add">+ Add Category</a>
        <div v-for="(category, index) in categories" :key="category.id">
            <input type="text" v-model="category.name" :ref="category.name">
            <input type="number" v-model="category.display_order">
            <a @click="removeCategory(index)" class="remove">Delete</a>
            <div>
                <img v-if="category.image" :src="`/images/${category.image}`" width="100">
                <label v-else>Image:</label>
                <input type="text" v-model.lazy="category.image">
            </div>
            <hr>
        </div>
        <button type="submit">Save</button>
        <div>{{ feedback }}</div>
    </form>
</template>

<script>
    export default {
        computed: {
            categories() {
                return this.$store.state.categories;
            },
            feedback() {
                return this.$store.state.feedback;
            }
        },
        methods: {
            removeCategory(index) {
                if (confirm('Are you sure?')) {
                    this.$store.dispatch('removeCategory', index);
                }
            },
            addCategory() {
                this.categories.push({
                    id: 0,
                    name: '',
                    image: '',
                    display_order: this.categories.length + 1
                });
                this.$nextTick(() => { // Callback to wait until DOM updates
                    window.scrollTo(0, document.body.scrollHeight);
                    this.$refs[''][0].focus(); // Binding to ref variable declared in text field (rather than the DOM)
                });
            },
            saveCategories() {
                this.$store.dispatch('saveCategories');
            } // End save categories


        }
    }
</script>

<style scoped>
    hr {
        margin-bottom: 30px;
    }

    img {
        vertical-align: middle;
    }
</style>