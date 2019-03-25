<template>
<div>
    <div v-if="this.name_coach_alert" class="alert alert-warning alert-dismissible" role="alert">
        <button @click.prevent="toggleNameCoachAlert()" type="button" class="close" aria-label="Close">
            <i aria-hidden="true" class="fas fa-times"></i>
        </button>
        <p ><i class="fas fa-exclamation-triangle"></i> Please visit <a href="https://cloud.name-coach.com/" target="_blank" rel="noreferrer">NameCoach</a> to record your name pronunciation!</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 pt-5">
            <form>
                <div class="form-group profile-img">
                    <img :src="getImage()" class="rounded-circle img-fluid" :alt="this.display_name + '\'s Profile Image'">
                    <a href="#" class="edit-img" @click.prevent="editImage">Edit Photo</a>
                </div>
                <div>
                    <h2 class="text-center my-5">{{ this.display_name }}
                    <audio ref="name-coach" :src="this.user.name_coach" preload="auto"></audio>
                    <a @click="playSound" href="#"><i class="fas fa-volume-up"></i></a>
                    </h2>
                </div>
                <div class="form-group">
                    <label for="profile-name" class="form-label--required font-weight-bold">Profile Name</label>
                    <input class="form-control" id="profile-name" name="profile-name" type="text" placeholder="Name to display on profile" v-model="display_name">
                </div>
                <div class="form-group">
                    <label for="biography" class="form-label--required font-weight-bold">Biography</label>
                    <textarea class="form-control" rows="5" id="biography" name="biography" placeholder="Tell us about yourself!" v-model="biography"></textarea>
                </div>
                <span v-if="this.user.affiliation === 'student'" class="form-label--required font-weight-bold">Profile Visibility</span>
                <div v-if="this.user.affiliation === 'student'" class="form-check">
                    <input class="form-check-input" type="radio" id="public" :value="false" v-model="confidential_flag">
                    <label class="form-check-label" for="public">Public</label>
                </div>
                <div v-if="this.user.affiliation === 'student'" class="form-check">
                    <input class="form-check-input" type="radio" id="private" :value="true" v-model="confidential_flag">
                    <label class="form-check-label" for="private">Private</label>
                </div>
                <div class="form-group text-center">
                    <button @click.prevent="editInfo" role="button" class="btn btn-primary">Update Information</button>
                </div>
            </form>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'info-form',
    props: ['user'],
    data() {
        return {
            biography: '',
            confidential_flag: Boolean,
            display_name: String,
            email: String,
            name_coach_alert: false
        };
    },
    created() {
        this.display_name = this.user.display_name;
        if (this.user.directory_data != null) {
            this.biography = this.user.directory_data.biography;
        }
        this.confidential_flag = !!this.user.directory_data.confidential;
    },
    methods: {
        editInfo() {
            this.saveValues();
            window.axios
                .post(this.user.email_uri + '/info', {
                    biography: this.biography,
                    confidential: this.confidential_flag,
                    display_name: this.display_name,
                    email: this.user.email,
                })
                .then(response => {
                    if (response.data.success === 'true') {
                        this.$emit('show-alert', {
                            title: 'Success!',
                            message: response.data.message,
                            success: true,
                        });
                    } else {
                        this.$emit('show-alert', {
                            title: 'Oh No!',
                            message: response.data.message,
                            success: false,
                        });
                    }
                    window.scrollTo(0, 0);
                })
                .catch(error => {
                    this.$emit('show-alert', {
                        title: 'Oh No!',
                        message: ['An error occurred please try again.'],
                        success: false,
                    });
                    window.scrollTo(0, 0);
                });
        },
        getImage() {
            return this.user.avatar_image;
        },
        editImage() {
            this.$emit('edit-photo');
        },
        playSound: function () {
            if (this.name_coach_alert !== true) {
                this.$refs['name-coach'].play().catch(() => this.toggleNameCoachAlert());
            }
        },
        toggleNameCoachAlert: function () {
            this.name_coach_alert = !this.name_coach_alert;
        },
        saveValues: function () {
            this.user.display_name = this.display_name;
            this.user.directory_data.biography = this.biography;
            this.user.directory_data.confidential = !! this.confidential_flag;
        }
    }
}
</script>
