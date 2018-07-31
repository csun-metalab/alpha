<template>
    <div>
        <button v-if="ok === false" type="submit" @click="buttonPressed" class="btn btn-primary">
            <i class="fa fa-sign-in-alt"></i>
            {{ title }}
        </button>
        <div v-if="ok" class="type--center">
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
    </div>

</template>
<script>
    export default {
        props:['title'],
        data: () => {
            return {
                ok: false
            }
        },
        methods: {
            buttonPressed () {
                this.ok = true
                this.$emit('submitted')
            }
        }
    }
</script>
