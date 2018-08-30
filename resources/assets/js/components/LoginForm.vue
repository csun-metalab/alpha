<template>
    <form class="needs-validation" method="POST" :action="loginUrl()" accept-charset="UTF-8" novalidate>
        <input name="_token" type="hidden" :value="csrfToken()">
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-sm-7 col-md-5 col-lg-4">
                        <label for="username" class="form-label--required">Username or Email</label>
                        <input class="form-control" name="username" type="text" id="username" placeholder="Username or Email" required>
                        <div class="invalid-feedback">
                            Please enter your CSUN username (ie. jos8693) or your CSUN email address.
                        </div>
                    </div>
                </div>
            </div>
                <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-sm-7 col-md-5 col-lg-4">
                        <label for="password" class="form-label--required">Password</label>
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
    methods: {
        csrfToken: function() {
            return window.appToken;
        },
        loginUrl: function() {
            return window.appURL + '/login';
        },
    },
};

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener(
        'load',
        function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(
                    'submit',
                    function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    },
                    false
                );
            });
        },
        false
    );
})();
</script>
