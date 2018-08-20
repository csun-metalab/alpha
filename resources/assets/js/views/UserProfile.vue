<template>
    <div>
        <pop-up-alert v-if="showAlert"
                      v-bind:message="this.alertMessage"
                      v-on:close-alert="showAlert = !showAlert"/>
        <div class="row">
            <div>
                <info-form v-if="this.uploadPicture == false"
                           v-bind:user="this.user"
                           v-on:edit-photo="editPhoto"
                           v-on:show-alert="showPopUpAlert"
                />
                <image-upload v-else
                    v-bind:profile-image="this.user.directory_data.profile_image"
                    v-bind:display-name="this.user.display_name"
                    v-bind:entity-type="this.user.affiliation"
                    v-bind:email-uri="this.user.email_uri"
                    v-on:image-upload="showPopUpAlert"
                    v-on:image-remove="showAlert = false"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ImageUpload from '../components/ImageUpload';
import InfoForm from '../components/InfoForm';
import PopUpAlert from '../components/PopUpAlert';
export default {
    props: ['user-info'],
    components: {
        'image-upload': ImageUpload,
        'info-form': InfoForm,
        'pop-up-alert': PopUpAlert,
    },
    data() {
        return {
            user: JSON.parse(this.userInfo),
            display_name: '',
            biography: '',
            nickname: '',
            confidential_flag: false,
            uploadPicture: false,
            showAlert: false,
            alertMessage: '',
        };
    },
    created() {
        this.display_name = this.user.display_name;
        this.biography = this.user.directory_data.biography;
    },
    methods: {
        editPhoto() {
            this.uploadPicture = true;
        },
        showPopUpAlert(type) {
            this.alertMessage = type;
            this.showAlert = true;
        },
    },
};
</script>
