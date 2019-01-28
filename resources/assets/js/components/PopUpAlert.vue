<template>
    <div class="alert-dismissible" role="alert">
        <button @click="$emit('close-alert')" type="button" class="close" aria-label="Close">
            <i aria-hidden="true" class="fas fa-times"></i>
        </button>
        <strong>{{ this.details.title }}</strong>
        <p v-for="message in this.details.message" >{{ message }}</p>
    </div>
</template>

<script>
    export default {
        name: 'PopUpAlert',
        props: ['details']
    }
</script>
