<template>
    <div>            <div class="form__group profile-avatar profile-img">
                <img :src="this.user.directory_data.profile_image" class="img--circle" :alt="this.user.display_name + '\'s Profile Image'">
                <a href="#" class="edit-img" @click.prevent="editImage">Edit Image</a>
            </div>
            <div class="form__group">
                <label for="display-name">Display Name</label>
                <input id="display-name" name="display-name" type="text" v-model="display_name">
            </div>
            <div class="form__group">
                <label for="nickname">Nickname</label>
                <input id="nickname" name="nickname" type="text" v-model="nickname">
            </div>
            <div class="form__group">
                <label for="biography">Biography</label>
                <textarea id="biography" name="biography" v-model="biography"></textarea>
            </div>
            <div class="form__group">
                <strong>Profile Visibility</strong>
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" id="public" :value="false" v-model="confidential_flag">
                        <label class="radio-inline" for="public">Public</label>
                    </div>
                    <div class="col-md-4">
                        <input type="radio" id="private" :value="true" v-model="confidential_flag">
                        <label class="radio-inline" for="private">Private</label>
                    </div>
                </div>
            </div>
            <div class="form__group type--center">
                <button @click.prevent="editInfo" role="button" class="btn btn-primary">Update Information</button>
            </div>
    </div>
</template>

<script>
    export default {
        name: 'InfoForm',
        props: ['user'],
        data () {
            return {
                biography: String,
                confidential_flag: Boolean,
                display_name: String,
                email: String,
                nickname: String
            }
        },
        created () {
          this.display_name = this.user.display_name
          this.nickname = this.user.nickname
          this.biography = this.user.directory_data.biography
          this.confidential_flag = !!this.user.directory_data.confidential
        },
        methods: {
            editInfo () {
                window.axios.post(this.user.email_uri + '/info', {
                    biography: this.biography,
                    confidential: this.confidential_flag,
                    display_name: this.display_name,
                    email: this.user.email,
                    nickname: this.nickname
                }).then(response => {
                    this.$emit('show-alert', response.data.message);
                }).catch(error => {
                    this.$emit('show-alert', 'Oh no! An error occurred please try again.')
                })
            },
            editImage () {
                this.$emit('edit-photo')
            }
        }
    }
</script>
