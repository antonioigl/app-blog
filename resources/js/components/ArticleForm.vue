<template>
    <div class="flex justify-center mt-6">
        <template v-if="article.attributes">

            <form @submit.prevent="submitForm" class="w-full max-w-xl">
                <div v-if="errors.length > 0" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                    <ul>
                        <li v-for="e of errors">{{ e }}</li>
                    </ul>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" v-model="article.attributes.title" name="title">
                </div>
                <div class="md:flex md:items-center mb-6">
                    <textarea rows="10" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-username" v-model="article.attributes.content" name="content"></textarea>
                </div>
                <div class="md:flex justify-center">
                    <button class="w-64 shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        {{ buttonTitle  }}
                    </button>
                </div>
            </form>
        </template>
    </div>
</template>

<script>
    export default {
        props: ['action', 'article'],

        data() {
            return {
                errors: []
            }
        },

        methods: {
            createArticle() {
                this.article.attributes.thumbnail = 'https://picsum.photos/250/200'
                axios.post('/api/articles', this.article.attributes)
                .then(response => {
                    let slug = response.data.slug;
                    this.$router.push({name: 'show', params: { slug }});
                })
                .catch(err => {
                    if(err.response.status === 422){
                        this.getErrors(err.response.data.errors);
                    }
                });
            },

            updateArticle() {
                this.article.attributes.thumbnail = 'https://picsum.photos/250/200'
                axios.put(`/api/articles/${this.article.slug}`, this.article.attributes)
                    .then(response => {
                        let slug = response.data.data.slug;
                        this.$router.push({name: 'show', params: { slug }});
                    })
                    .catch(err => {
                        if(err.response.status === 422){
                            this.getErrors(err.response.data.errors);
                        }
                    });
            },

            submitForm() {
              if (this.action === 'create'){
                  this.createArticle();
              }
              else{
                  this.updateArticle();
              }
            },

            getErrors(errors) {
                this.errors = [];
                Object.values(errors).forEach(value => {
                    this.errors.push(value[0]);
                });
            }
        },

        computed: {
            buttonTitle() {
                return this.action === 'create' ? "Create" : "Update";
            }
        }
    }
</script>
