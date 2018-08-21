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
        <p>Loggin in...</p>
            <!-- <i class="fas fa-spinner fa-spin fa-3x fa-blue"></i> -->
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
