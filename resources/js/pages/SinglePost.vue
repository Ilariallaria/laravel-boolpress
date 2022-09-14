<template>
    <div class="container">
        <div v-if="post">
            <h1>{{post.title}}</h1>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data(){
        return {
            post: null
        };
    },

    mounted(){
        axios.get('/api/posts/' + this.$route.params.slug)
        .then((response) => {
            this.post = response.data.results;
        });
    }
}
</script>