<template>
    <div class="text-center">
            <div class="font-sans container">
                <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3x1 md:text-4x1">
                    {{attributes.title}}
                </h1>
                <p class="text-sm md:text-base font-normal text-gray-600">{{attributes.created_at}}</p>
                <p class="py-6">{{attributes.description}}</p>
            </div>
    </div>
</template>

<script>
    export default {

        data(){
          return {
              article: {},
              attributes: {},
          }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(){
                axios.get(`/api/articles/${this.$route.params.slug}`)
                .then(response => {
                    this.article = response.data;
                    this.attributes = response.data.attributes;
                    console.log(response);
                })
                .catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>
