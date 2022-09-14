<template>
    <section>
        <div class="container">
            <h1>Our posts</h1>

            <div class="row row-cols-3">
                <div v-for="singlepost in posts" :key="singlepost.id" class="col">
                    <PostCard :post="singlepost" />
                </div>
            </div>

            <nav class="mt-3">
                <ul class="pagination">
                    <li class="page-item" :class="{'disabled': currentPaginationPage == 1}">
                        <a class="page-link" @click="getPosts(currentPaginationPage -1)" href="#">Previous</a>
                    </li>
                    <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                    <li class="page-item" :class="{'disabled': currentPaginationPage == lastPaginationpage}">
                        <a class="page-link" @click="getPosts(currentPaginationPage + 1)" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

    </section>
</template>

<script>
import PostCard from './PostCard.vue'

export default ({
    name: 'Posts',
    components: {
        PostCard
    },
    data() {
        return{
            posts: [],
            currentPaginationPage: 1,
            lastPaginationpage: null
        };
    },

    methods: {

        // funzione che ci da tutti i post
        getPosts(pageNumber){
            axios.get('http://127.0.0.1:8000/api/posts', {
                params: {
                    page:pageNumber
                }
            })
            .then((response) => {
                this.posts = response.data.results.data;
                this.currentPaginationPage = response.data.results.current_page;
                this.lastPaginationpage = responce.data.results.last_page;
            });

        }
    },

    mounted(){
        this.getPosts();
    }
})
</script>
