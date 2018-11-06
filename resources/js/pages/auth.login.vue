<template>
    <div class="container page-container" style="position: relative">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="row">


                <div class="col-md-6 offset-md-3">


                    <form v-on:submit.prevent="onSubmit" style="margin: 25px">

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text"
                                   v-model="email"
                                   class="form-control"
                                   v-bind:class="{ 'is-invalid': errorEmail }"
                                   placeholder="Email">
                            <div class="invalid-feedback">
                                {{ errorEmail }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input v-model="password"
                                   type="password"
                                   class="form-control"
                                   v-bind:class="{ 'is-invalid': errorPassword }"
                                   placeholder="Password">
                            <div class="invalid-feedback">
                                {{ errorPassword }}
                            </div>
                        </div>


                        <button :disabled="app.$store.state.loading" type="submit" class="btn btn-secondary">Login</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        name: "login",
        props: ['app'],
        data()
        {
            return {


                email: '',
                errorEmail: '',

                password: '',
                errorPassword: '',



                errors: []
            }
        },

        mounted()
        {
            if (this.app.user)
            {
                this.app.$router.push({name:'album.index'});
            }
        },

        methods: {
            onSubmit()
            {
                this.errors = [];

                let $this = this;



                if (this.email.length < 6)
                {
                    console.log(this.email.length);
                    this.errorEmail = 'Email has to be at least 6 characters long.';
                    this.errors.push(this.errorEmail);
                }
                else
                {
                    this.errorEmail = null;
                }

                if (!this.password && this.password.length < 6)
                {
                    this.errorPassword = 'Password has to be at least 6 characters long.';
                    this.errors.push(this.errorPassword);
                }
                else
                {
                    this.errorPassword = null;
                }


                if (!this.errors.length)
                {

                    let data = {
                        email: $this.email,
                        password: $this.password,
                    };

                    this.app.request.post('auth/login', data).then(function (response) {


                        if (response.data.id)
                        {
                            $this.app.user = response.data;
                            $this.app.$router.push({name:'album.index'});
                        }
                        else if (response.data.error === 401)
                        {
                            $this.errorPassword = 'Could not log you in.';
                            $this.email = '';
                            $this.password = '';
                        }
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>