<template>
    <div class="type--white">
        <strong>{{ this.details.title }}</strong> {{ this.details.message }}
        <a href="#" @click="$emit('close-alert')" class="alert__close" data-alert-close>&times;</a>
    </div>
</template>

<script>
    export default {
        name: 'PopUpAlert',
        props: ['details']
    }
</script>
