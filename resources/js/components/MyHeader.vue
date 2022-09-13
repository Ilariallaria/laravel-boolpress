<template>
    <div>
        <ul class="nav nav-tabs">
            <li v-for="link, index in navLinks" :key="index" class="nav-item">
                <router-link :to="{name: link.name}" class="nav-link">{{link.label}}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'MyHeader',
    data() {
        return{
            navLinks:[
                {
                    name:'home',
                    label: 'Home'
                },
                {
                    name:'blog',
                    label: 'Blog'
                },
                {
                    name:'about',
                    label: 'About us'
                },
            ],
        };
    },
}
</script>