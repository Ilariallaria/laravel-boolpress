<template>
    <div class="container">
        <div class="card mt-3">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <div class="card-body">
                <img class="w-100" v-if="post.cover" :src="post.cover" :alt="post.title">
                <h5 class="card-title">{{post.title}}</h5>
                <p class="card-text">{{truncateText(post.content)}}</p>
                <!-- <a href="#" class="btn btn-primary">Read more</a> -->
                <router-link :to="{name: 'single-post', params: {slug: post.slug }}" class="btn btn-primary">Read more</router-link>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostCard',
    props: {
        post: Object
    },
    methods: {
        //funzione che tronca il testo 
        truncateText(text){
            // solo se supera i 100 caratteri 
            if(text.length > 100){
                return text.slice(0, 100) + '...';
            }
            return text;
        },
    }
}
</script>