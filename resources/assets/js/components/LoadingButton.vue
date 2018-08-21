<template>
    <div>
        <button v-if="submitted === false" type="submit" @click="buttonPressed" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i>
            {{ title }}
        </button>
        <div v-if="submitted" class="type-center">
        <button type="submit" @click="buttonPressed" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i>
            {{ title }}
        </button>
        <i class="fas fa-spinner fa-spin fa-lg login__spinner"></i>
        </div>
    </div>

</template>
<script>
export default {
    props: ['title'],
    data: () => {
        return {
            submitted: false,
        };
    },
    methods: {
        buttonPressed() {
            this.submitted = true;
            this.$emit('submitted');
        },
    },
};
</script>
