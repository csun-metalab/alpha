<template>
    <div class="container">
        <div class="row">
        <croppa v-model="myCroppa"
                accept="image/*"
                remove-button-color="black"
                :remove-button-size="35"
                prevent-white-space
                placeholder="Select an image."
                :placeholder-font-size="18"
                @init="imageInit"
                @image-remove="disableUploadImageButton"
                @new-image="enableUploadImageButton"
                v-on:image-remove="$emit('image-remove')"
                class="form__group croppa__image--radius">
            <img crossOrigin="anonymous" :src="this.profileImage" slot="initial" :alt="this.displayName + '\'s Profile Image'">
        </croppa>
        <div class="form__group type--center">
            <button @click.prevent="uploadPhoto" role="button" class="btn btn-primary type--center" v-if="this.uploadImageBtn">Save Image</button>
            <button role="button" class="btn btn-default type--center" v-else>Save Image</button>
        </div>
        </div>
    </div>
</template>

<script>
    import LoadingButton from './LoadingButton'
    export default {
        props: ['profileImage', 'displayName', 'emailUri', 'entityType'],
        components: {
            'loading-button': LoadingButton
        },
        data () {
            return {
                uploadImageBtn: true,
                myCroppa: {},
                imageType: 'avatar'
            }
        },
        methods: {
            uploadPhoto() {
                let base64Img = this.myCroppa.generateDataUrl('image/jpeg', 0.8)
                window.axios.post(this.emailUri + '/image', {
                    profile_image: base64Img,
                    entity_type: this.entityType,
                    image_type: this.imageType
                }).then(response => {
                    this.$emit('image-upload', response.data.message)
                }).catch(error =>  {
                    this.$emit('image-upload', 'Oh no! An error occurred please try again.')
                })
            },
            imageInit() {
                let elm = this.myCroppa.getCanvas();
                elm.style.borderRadius="50%";
            },
            disableUploadImageButton()
            {
                this.uploadImageBtn = false
            },
            enableUploadImageButton()
            {
                if (this.uploadImageBtn === false) {
                    this.uploadImageBtn = true
                }
            }
        }
    }
</script>

<style>
.croppa__image--radius {
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
}
</style>
