<template>
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
    </div>
</template>

<script>
    import BackButton from './BackButton'
    export default {
        data () {
            return {
                url: '',
                activeClass: false
            }
        },
        created () {
          this.url = window.appURL
        },
        components: {
            'back-button': BackButton
        },
        methods: {
            setActiveClass: function () {
                this.activeClass = !this.activeClass;
            }
        },
        props: ['app-name']
    }
</script>
