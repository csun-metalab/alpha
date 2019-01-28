<template>
    <nav class="container navbar navbar-metaphor navbar-expand-sm">
        <a class="navbar-brand" :href="this.url">
            <span class="sr-only">CSUN Logo</span>
            <span class="navbar-brand__subbrand">{{ this.appName }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav text-center" :class="{ 'nav-item nav-link active': activeClass }">
            <a class="nav-item nav-link active" :href="this.url">Home</a>
            <a class="nav-item nav-link" :href="this.url + '/logout'">Logout</a>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            url: '',
            activeClass: false,
        };
    },
    created() {
        this.url = window.appURL;
    },
    components: {
        'back-button': BackButton,
    },
    methods: {
        setActiveClass: function() {
            this.activeClass = !this.activeClass;
        },
    },
    props: ['app-name'],
};
</script>
