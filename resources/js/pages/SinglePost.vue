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
            // se trova il post
            if(response.data.results){
                // lo stampa
                this.post = response.data.results;
            } else{
                // altrimenti, mi porta alla 404 tramite router.push()
                this.$router.push({name: 'not-found'});
            }

        });
    }
}
</script>