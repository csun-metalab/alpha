<template>
<div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <form>
            <div class="form-group">
                <a href="#" class="profile-avatar profile-img" @click.prevent="editImage">
                <img :src="this.user.directory_data.profile_image" class="rounded-circle img-fluid" :alt="this.user.display_name + '\'s Profile Image'">
                    <!-- <img src="https://via.placeholder.com/200x200" class="rounded-circle img-fluid" :alt="this.user.display_name + '\'s Profile Image'"> -->
                    <div class="edit-img">Edit Image</div>
                </a>
            </div>
            <div>
                <h2 class="text-center display-name">{{ this.user.display_name }}</h2>
            </div>
            <div class="form-group">
                <label for="display-name">Display Name</label>
                <input class="form-control" id="display-name" name="display-name" type="text" placeholder="Name to display on profile" v-model="display_name">
            </div>
            <div class="form-group">
                <label for="nickname">Nickname (Optional)</label>
                <input class="form-control" id="nickname" name="nickname" type="text" placeholder="Nickname" v-model="nickname">
            </div>
            <div class="form-group">
                <label for="biography">Biography</label>
                <textarea class="form-control" rows="5" id="biography" name="biography" placeholder="Tell us about yourself!" v-model="biography"></textarea>
            </div>
            <strong>Profile Visibility</strong>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="public" :value="false" v-model="confidential_flag">
                <label class="form-check-label" for="public">Public</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="private" :value="true" v-model="confidential_flag">
                <label class="form-check-label" for="private">Private</label>
            </div>
            <div class="form-group text-center">
                <button @click.prevent="editInfo" role="button" class="btn btn-primary">Update Information</button>
            </div>
        </form>
    </div>
    </div>
</template>

<script>
export default {
    name: 'InfoForm',
    props: ['user'],
    data() {
        return {
            biography: String,
            confidential_flag: Boolean,
            display_name: String,
            email: String,
            nickname: String,
        };
    },
    created() {
        this.display_name = this.user.display_name;
        this.nickname = this.user.nickname;
        this.biography = this.user.directory_data.biography;
        this.confidential_flag = !!this.user.directory_data.confidential;
    },
    methods: {
        editInfo() {
            window.axios
                .post(this.user.email_uri + '/info', {
                    biography: this.biography,
                    confidential: this.confidential_flag,
                    display_name: this.display_name,
                    email: this.user.email,
                    nickname: this.nickname,
                })
                .then(response => {
                    this.$emit('show-alert', response.data.message);
                })
                .catch(error => {
                    this.$emit(
                        'show-alert',
                        'Oh no! An error occurred please try again.'
                    );
                });
        },
        editImage() {
            this.$emit('edit-photo');
        },
    },
};
</script>
