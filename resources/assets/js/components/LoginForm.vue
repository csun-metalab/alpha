<template>
    <form method="POST" :action="loginUrl()" accept-charset="UTF-8">
        <input name="_token" type="hidden" :value="csrfToken()">
        <div class="row">
            <div class="col-md-6">
                <div class="form__group">
                    <label for="username" class="label--required">Username or Email</label>
                    <input name="username" type="text" id="username">
                </div>
                <div class="form__group">
                    <label for="password" class="label--required">Password</label>
                    <input name="password" type="password" id="password">
                </div>
                <div class="form__group">
                    <loading-button v-bind:title="'Log-In'"></loading-button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        methods: {
            csrfToken: function () {
                return window.appToken;
            },
            loginUrl: function () {
                return window.appURL + '/login';
            }
        }
    }
</script>
