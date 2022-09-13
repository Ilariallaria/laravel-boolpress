<template>
    <div>
        <header>
            <MyHeader/>
        </header>

        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import MyHeader from '../components/MyHeader.vue';

export default {
    name: 'App',
    components: {
        MyHeader
    }
}
</script>
