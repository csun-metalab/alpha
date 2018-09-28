<template>
<div>
    <div class="container pt-5">
        <div class="row justify-content-center">
        <croppa v-model="myCroppa"
                accept="image/*"
                remove-button-color="black"
                :remove-button-size="35"
                :initial-image="this.profileImage"
                prevent-white-space
                placeholder="Select an image."
                :placeholder-font-size="18"
                @init="imageInit"
                @image-remove="disableUploadImageButton"
                @new-image="enableUploadImageButton"
                v-on:image-remove="$emit('image-remove')"
                class="form-group rounded-circle">
        </croppa>
        </div>
        <div class="row justify-content-center">
            <button @click.prevent="uploadPhoto" role="button" class="btn btn-primary type-center" v-if="this.uploadImageBtn">Save Image</button>
            <button role="button" class="btn btn-default text-center" v-else>Save Image</button>
        </div>
        </div>
    </div>
</template>

<script>
import LoadingButton from './LoadingButton';
export default {
    props: ['profileImage', 'displayName', 'emailUri', 'entityType'],
    components: {
        'loading-button': LoadingButton,
    },
    data() {
        return {
            uploadImageBtn: true,
            myCroppa: {},
            imageType: 'avatar',
        };
    },
    methods: {
        uploadPhoto() {
            let base64Img = this.myCroppa.generateDataUrl('image/jpeg', 1);
            window.axios
                .post(this.emailUri + '/image', {
                    profile_image: base64Img,
                    entity_type: this.entityType,
                    image_type: this.imageType,
                })
                .then(response => {
                    if (response.data.success === 'true') {
                        this.$emit('image-upload', {
                            title: 'Success!',
                            message: response.data.message,
                            success: true,
                        });
                    } else {
                        this.$emit('image-upload', {
                            title: 'Oh no!',
                            message: response.data.message,
                            success: false,
                        });
                    }
                })
                .catch(error => {
                    this.$emit('image-upload', {
                        title: 'Oh no!',
                        message: 'An error occurred, please try again.',
                        success: false,
                    });
                });
        },
        imageInit() {
            let elm = this.myCroppa.getCanvas();
            elm.style.borderRadius = '50%';
        },
        disableUploadImageButton() {
            this.uploadImageBtn = false;
        },
        enableUploadImageButton() {
            if (this.uploadImageBtn === false) {
                this.uploadImageBtn = true;
            }
        },
    },
};
</script>
