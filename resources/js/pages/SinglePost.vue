<template>
    <div class="container">
        <div v-if="post">
            <h1>{{post.title}}</h1>

            <div v-if="post.category" class="mb-1">Category: {{post.category.name}}</div>

            <p>{{post.content}}</p>

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