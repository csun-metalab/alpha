<template>
    <div>
        <pop-up-alert class="alert alert-success"
                      v-if="successAlert"
                      v-bind:details="this.alertDetails"
                      v-on:close-alert="successAlert = !successAlert"/>
        <pop-up-alert class="alert alert-danger"
                      v-if="dangerAlert"
                      v-bind:details="this.alertDetails"
                      v-on:close-alert="dangerAlert = !dangerAlert"/>
        <info-form v-if="this.uploadPicture == false"
                   v-bind:user="this.user"
                   v-on:edit-photo="editPhoto"
                   v-on:show-alert="showPopUpAlert"/>
        <image-upload v-else
            v-bind:profile-image="this.user.avatar_image"
            v-bind:display-name="this.user.display_name"
            v-bind:entity-type="this.user.affiliation"
            v-bind:email-uri="this.user.email_uri"
            v-on:image-upload="showPopUpAlert"
            v-on:cancel-pressed="toggleView"/>
    </div>
</template>

<script>
import ImageUpload from '../components/ImageUpload';
import InfoForm from '../components/InfoForm';
import PopUpAlert from '../components/PopUpAlert';
export default {
    name: 'user-profile',
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
            successAlert: false,
            dangerAlert: false,
            alertDetails: null
        }
    },
    created() {
        this.display_name = this.user.display_name;
        if (this.user.directory_data.biography != null) {
            this.biography = this.user.directory_data.biography;
        }
    },
    methods: {
        editPhoto() {
            this.resetAlerts();
            this.uploadPicture = true;
        },
        toggleView() {
            this.resetAlerts();
            this.uploadPicture = false;
        },
        showPopUpAlert(type) {
            if (type.success) {
                this.successAlert = type.success;
            } else {
                // type.success is false so let's
                // show the alert by taking the
                // compliment of type.success
                this.dangerAlert = !type.success;
            }
            this.alertDetails = type;
        },
        resetAlerts() {
            this.successAlert = false;
            this.dangerAlert = false;
        }
    }
}
</script>
