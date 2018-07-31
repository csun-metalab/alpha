<template>
    <div class="alert alert--success type--white">
        <strong>Success!</strong> {{ this.message }}
        <a href="#" @click="$emit('close-alert')" class="alert__close" data-alert-close>&times;</a>
    </div>
</template>

<script>
    export default {
        name: 'PopUpAlert',
        props: ['message']
    }
</script>
