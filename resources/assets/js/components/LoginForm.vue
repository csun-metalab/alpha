<template>
    <form method="POST" :action="loginUrl()" accept-charset="UTF-8">
        <input name="_token" type="hidden" :value="csrfToken()">
            <form>
                <div class="form-group">
                    <label for="username" class="form-control--required">Username or Email</label>
                    <input class="form-control" name="username" type="text" id="username">
                </div>
                <div class="form-group">
                    <label for="password" class="form-control--required">Password</label>
                    <input class="form-control" name="password" type="password" id="password">
                </div>
                <div class="form-group">
                    <loading-button v-bind:title="'Log-In'"></loading-button>
                </div>
            </form>
    </form>
</template>

<script>
export default {
  methods: {
    csrfToken: function() {
      return window.appToken;
    },
    loginUrl: function() {
      return window.appURL + "/login";
    }
  }
};
</script>
