<template>
    <form @submit.prevent="saveCategories">
        <h2>Drag and drop to reorder categories.</h2>
        <a @click="addCategory" class="add">+ Add Category</a>
        <draggable v-model="categories">
            <transition-group>
                <div v-for="(category, index) in categories" :key="category.id" class="cards">
                    <p><strong>Category: {{index + 1}} </strong></p>
                    <input type="text" v-model="category.name" :ref="category.name">
                    <a @click="removeCategory(index)" class="remove">Delete</a>
                    <div>
                        <img v-if="category.image" :src="`/images/${category.image}`" width="100">
                        <label v-else>Image:</label>
                        <input type="text" v-model.lazy="category.image">
                    </div>
                    <hr>
                </div> <!-- End v-for -->
            </transition-group>
        </draggable>
        <button type="submit">Save</button>
        <div>{{ feedback }}</div>
    </form>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        computed: {
            categories: {
                get() {
                    return this.$store.state.categories;
                },
                set(value) {
                    this.$store.commit('UPDATE_LIST', _.cloneDeep(value)); // Avoid mutating props
                }
            },
            feedback() {
                return this.$store.state.feedback;
            }
        },
        components: {
            draggable
        },
        methods: {
            removeCategory(index) {
                if (confirm('Are you sure?')) {
                    this.$store.dispatch('removeCategory', index);
                }
            },
            addCategory() {
                this.$store.commit('ADD_CATEGORY', {
                    id: 0,
                    name: '',
                    image: '',
                    display_order: this.categories.length + 1
                });
                this.$nextTick(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                    this.$refs[''][0].focus();
                });
            },
            saveCategories() {
                this.$store.dispatch('saveCategories');
            }, // End save categories
        }
    }
</script>

<style scoped>
    .cards {
        font-size: 16px;
    }
    .cards:hover {
        margin: 5px;
        background-image: linear-gradient(315deg, #f3f3f3 0%, #ffffff 74%);
    }

    hr {
        margin-bottom: 30px;
    }

    img {
        vertical-align: middle;
    }
</style>