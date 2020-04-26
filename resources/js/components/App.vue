<template>
    <div>
        <router-view></router-view>
        <router-link to="/home">Home</router-link>
        <router-link to="/articles">Articles</router-link>
        <router-link to="/about">About</router-link>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        created() {
            window.token = this.user.api_token;
        },

    }
</script>
