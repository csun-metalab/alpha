<template>
<div>
    <div class="container pt-5">
        <div class="row justify-content-center">
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
                    class="form-group rounded-circle">
            </croppa>
        </div>
        <div class="row justify-content-center">
            <div role="group">
                <button @click.prevent="uploadPhoto" role="button" class="btn btn-primary" :class="{'disabled': this.uploadImageBtn}" :disabled="this.uploadImageBtn">Save Image</button>
                <button @click.prevent="$emit('cancel-pressed')" role="button" class="btn btn-secondary ml-2">Cancel</button>
            </div>
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
            imageType: 'avatar'
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
                        message: ['An error occurred, please try again.'],
                        success: false,
                    });
                });
        },
        imageInit() {
            let elm = this.myCroppa.getCanvas();
            elm.style.borderRadius = '50%';
            this.myCroppa.chooseFile();
        },
        disableUploadImageButton() {
            this.uploadImageBtn = true;
        },
        enableUploadImageButton() {
            if (this.uploadImageBtn === true) {
                this.uploadImageBtn = false;
            }
        }
    },
};
</script>
