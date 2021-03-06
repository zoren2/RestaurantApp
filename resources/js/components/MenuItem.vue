<template>
    <form class="item-form" @submit.prevent="save" novalidate>
        <div>
            <input type="text" placeholder="Item name" v-model="item.name" required>
            <input type="number" min="0" step=".01" v-model="item.price" required>
        </div>
        <div>
            <textarea v-model="item.description" placeholder="Item description" required></textarea>
        </div>
        <div>
            <select v-model="item.category_id" required>
                <option value="">Select a category</option>
                <option v-for="cat in categories" :value="cat.id" :key="cat.id">{{cat.name}}</option>
            </select>
        </div>

        <img v-if="id && item.image" :src="`/storage/images/${item.image}`" width="200">
        <!-- Makes sure we are in editing mode -->
        <vue-dropzone :options="dropzoneOptions" id="dz" ref="dropzone"></vue-dropzone>
        <button type="submit">Save</button>
        <ul>
            <li v-for="(error, index) in errors" :key="index">{{error}}</li>
        </ul>
    </form>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'; // Directory from node_modules folder
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';

    // Doesn't need to be in the Vuex store
    function newItem() {
        return {
            name: '',
            price: 0.00,
            image: '',
            category_id: '',
            description: ''
        };
    }

    export default {
        components: {
            vueDropzone: vue2Dropzone
        },
        props: ['id'],
        data() {
            return {
                dropzoneOptions: {
                    url: '/api/add-image',
                    thumbnailWidth: 200,
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content // Tokenize the image
                    },
                    success(file, res) {
                        file.filename = res;
                    }
                },
                item: newItem(),
                errors: []
            };
        },
        computed: {
            categories() {
                return this.$store.state.categories;
            }
        },
        created() {
            // params: {id: item.id}} If editing, then id will exist. (Won't be part of data)
            if (this.id) {
                axios.get('/api/menu-items/' + this.id)
                    .then(res => this.item = res.data);
            }
        },
        beforeRouteLeave(to, from, next) {
            this.item = newItem();
            next();
        },
        methods: {
            save() {
                let files = this.$refs.dropzone.getAcceptedFiles();
                if (files.length > 0 && files[0].filename) {
                    this.item.image = files[0].filename;
                }

                let url = '/api/menu-items/add';
                if (this.id) { // There's already an item, then update instead
                    url = '/api/menu-items/' + this.id;
                }
                axios.post(url, this.item)
                    .then(res => {
                        this.$router.push('/');
                    })
                    .catch(error => {
                        let messages = Object.values(error.response.data.errors); // Returns an array of arrays - have to dig in to get the error message.
                        this.errors = [].concat.apply([], messages); // Concatenating an empty array with the messages array
                    });
            }
        }
    }

</script>

<style scoped>
    .item-form {
        margin-top: 20px;
    }
</style>