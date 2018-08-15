<template>

<!-- Copy content from here -->
    <!--
        <div class="header">
        <nav class="primary-nav">
            <div class="container">
                <div class="primary-nav__mobile">
                    <div class="primary-nav__btn" @click.prevent="setActiveClass()">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                    <a href="//www.csun.edu" class="primary-nav__brand"><span class="sr-only">California State University, Northridge (CSUN)</span></a>
                    <a :href="this.url" class="primary-nav__sub-brand">{{ this.appName }}</a>
                    <a class="sr-only" href="#main">Skip to main content</a>
                </div>
                <ul class="primary-nav__links" :class="{ 'primary-nav__links--open': activeClass }">
                    <li><a :href="this.url" class="primary-nav__link active">Home</a></li>
                    <li><a :href="this.url + '/logout'" class="primary-nav__link">Logout</a></li>
                </ul>
            </div>
        </nav>
    </div> -->



        <nav class="navbar navbar-metaphor navbar-expand-sm">
        <a class="navbar-brand" href="//www.csun.edu"> <span class="sr-only">CSUN Logo</span> </a> <span class="navbar-brand__sub-brand">Alpha</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav text-center">
            <a class="nav-item nav-link active" href="#">Home</a>
            <a class="nav-item nav-link" href="#">Features</a>
            <a class="nav-item nav-link" href="#">Pricing</a>
            </div>
        </div>
        </nav>




</template>

<script>
import BackButton from './BackButton';
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
