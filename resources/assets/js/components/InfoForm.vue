<template>
    <div class="row">
        <div class="col-md-4 col-md-push-4">
            <div class="form__group profile-avatar profile-img">
                <img :src="this.user.profile_image" class="img--circle" :alt="this.user.display_name + '\'s Profile Image'">
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
                        <input type="radio" id="public" :value="true" v-model="confidential_flag">
                        <label class="radio-inline" for="public">Public</label>
                    </div>
                    <div class="col-md-4">
                        <input type="radio" id="private" :value="false" v-model="confidential_flag">
                        <label class="radio-inline" for="private">Private</label>
                    </div>
                </div>
            </div>
            <div class="form__group type--center">
                <button @click.prevent="editInfo" role="button" class="btn btn-primary">Update Information</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'InfoForm',
        props: ['user'],
        data () {
            return {
                display_name: String,
                nickname: String,
                biography: String,
                confidential_flag: false,
            }
        },
        created () {
          this.display_name = this.user.display_name
          this.nickname = this.user.nickname
          this.biography = this.user.directory_data.biography
        },
        methods: {
            editInfo () {
                window.axios.post(this.user.email_uri + '/info', {
                    display_name: this.display_name,
                    biography: this.biography,
                    nickname: this.nickname,
                    confidential: this.confidential_flag
                }).then(response => {
                    this.$emit('show-alert', response.data.message)
                })
            },
            editImage () {
                this.$emit('edit-photo')
            }
        }
    }
</script>
