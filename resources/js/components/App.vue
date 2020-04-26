<template>
    <div>
        <router-view></router-view>
        <router-link to="/home">Home</router-link>
        <router-link to="/articles">Articles</router-link>
        <router-link to="/my_articles">My articles</router-link>
        <router-link to="/about">About</router-link>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        created() {
            window.token = this.user.api_token;

            axios.interceptors.request.use((config) => {
                console.log(config);

                if(config.method == 'get'){

                    if( config.url.match('/\?./') ){
                        let url = config.url.split("?");
                        let page = url[1];
                        url = url[0];

                        config.url = `${url}?api_token=${this.user.api_token}&${page}`;

                        return config;
                    }

                    config.url = `${config.url}?api_token=${this.user.api_token}`;
                }
                else {
                    config.data = {
                        ...config.data,
                        api_token: this.user.api_token,
                    };
                }

                return config;
            });
        },

    }
</script>
