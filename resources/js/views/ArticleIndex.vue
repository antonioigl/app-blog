<template>
    <div>
        <div class="flex flex-wrap justify-center">
            <div v-for="article of articles" :key="article.id" class="max-w-sm rounded overflow-hidden shadow-lg mx-4">

                <img class="w-full" :src="article.attributes.picture" alt="Sunset in the mountain">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ article.attributes.title }}</div>
                    <p class="text-gray-700 text-base">
                        {{ article.attributes.content }}
                    </p>
                </div>

                <div class="px-6 py-4">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                        #photography
                    </span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                        #travel
                    </span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                        #winter
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                articles: [],
            }
        },

        created() {
            this.fetchArticles();
        },

        methods: {
            fetchArticles(){
                axios.get('/api/articles')
                .then(response => {
                    this.articles = response.data.data;
                })
                .catch(err => {
                   console.log(err);
                });
            }
        }
    }
</script>
