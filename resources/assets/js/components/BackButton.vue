<template>
    <i v-if="!hideBack"
       class="fa fa-angle-left fa-3x back_button"
       title="Go Back"
       @click="goBack"></i>
</template>

<script>
    export default {
        data () {
            return {
                hideBack: true
            }
        },
        methods: {
            goBack: function () {
                this.$router.go(-1);
            }
        }
    }
</script>
