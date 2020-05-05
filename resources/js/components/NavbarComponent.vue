<template>
    <nav v-if="!!this.$store.getters.getUser" class="mb-5 navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                TURKAI
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'profile'}">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'students'}">Students</router-link>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <span v-text="getUsername"></span>    <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                            <router-link class="dropdown-item" :to="{name:'update'}">Edit</router-link>


                            <a @click="logout" class="dropdown-item" href="#">Logout</a>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "NavbarComponent",
        data() {
            return {

            }
        },
        computed: {
            getUsername() {
                return this.$store.getters.getUser.first_name
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(res => {
                        console.log(res)
                        this.$router.push({name: 'login'})
                    }).catch(err => {
                        console.log(err)
                    })
            }
        }
    }
</script>

<style scoped>

</style>