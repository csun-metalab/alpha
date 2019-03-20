<template>
    <form class="needs-validation" method="POST" :action="loginUrl()" accept-charset="UTF-8" novalidate>
        <input name="_token" type="hidden" :value="csrfToken()">
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-sm-7 col-md-5 col-lg-4">
                        <label for="username" class="form-label--required font-weight-bold">Username or Email</label>
                        <input class="form-control" name="username" type="text" id="username" placeholder="Username or Email">
                        <div class="invalid-feedback">
                            Please enter your CSUN username (ie. jos8693) or your CSUN email address.
                        </div>
                    </div>
                </div>
            </div>
                <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-sm-7 col-md-5 col-lg-4">
                        <label for="password" class="form-label--required font-weight-bold">Password</label>
                        <input class="form-control" name="password" type="password" id="password" placeholder="Password">
                        <div class="invalid-feedback">
                            Invalid password. Please try again.
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <loading-button v-bind:title="'Log In'"></loading-button>
                </div>
    </form>
</template>

<script>
export default {
    name: 'login-form',
    methods: {
        csrfToken: function() {
            return window.appToken;
        },
        loginUrl: function() {
            return window.appURL + '/login';
        },
    },
};
</script>
