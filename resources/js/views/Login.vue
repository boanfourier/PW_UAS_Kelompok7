<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Login</h1>
                        <div v-if="loginFailed" class="alert alert-danger">
                            Email atau Password Anda salah.
                        </div>
                        <div v-if="verifemail" class="alert alert-danger">
                            Email Belum di verifikasi
                        </div>

                        <div class="text-center">
                            <i
                                class="fas fa-user-circle"
                                style="font-size: 9em"
                            ></i>

                            <form @submit.prevent="submit" class="mt-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon1"
                                            ><i class="fa fa-user"></i
                                        ></span>
                                    </div>
                                    <input
                                        type="email"
                                        v-model="email"
                                        class="form-control"
                                        placeholder="Email"
                                        aria-label="Email"
                                        aria-describedby="basic-addon1"
                                        required
                                    />
                                    <div
                                        v-if="validation.email"
                                        class="mt-2 alert alert-danger"
                                    >
                                        Masukkan Email
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text"
                                            id="basic-addon2"
                                            ><i class="fa fa-lock"></i
                                        ></span>
                                    </div>
                                    <input
                                        type="password"
                                        v-model="password"
                                        class="form-control"
                                        placeholder="Password"
                                        aria-label="Password"
                                        aria-describedby="basic-addon2"
                                    />
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-dark btn-block"
                                >
                                    <i class="fa fa-sign-in-alt"></i> Login
                                </button>
                                <hr />

                                <a
                                    href="/register"
                                    class="btn btn-secondary btn-block"
                                >
                                    <i class="fa fa-user-plus"></i> Buat Akun
                                    baru
                                </a>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">
                            <i class="fa fa-copyright"></i>
                            <a href="?page=beranda" class="text-dark"
                                >E Laporz</a
                            >
                            | Kelompok 7
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            error: "",
            loggedIn: localStorage.getItem("loggedIn"),
            token: localStorage.getItem("token"),
            role: localStorage.getItem("role"),
            loginFailed: null,
            verifemail: null,
            validation: [],
        };
    },
    methods: {
        submit() {
            if (this.email && this.password) {
                axios.get("sanctum/csrf-cookie").then((response) => {
                    axios
                        .post("api/login", {
                            email: this.email,
                            password: this.password,
                        })
                        .then((res) => {
                            console.log(res.data);
                            if (res.data.data == 1) {
                                localStorage.setItem("loggedIn", "true");
                                localStorage.setItem("id", res.data.id);
                                localStorage.setItem("role", res.data.role);
                                this.loginFailed = true;
                                if (res.data.role == "user") {
                                    this.$router.push({ name: "berandauser" });
                                    location.reload();
                                } else if (res.data.role == "admin") {
                                    this.$router.push({ name: "admin" });
                                    location.reload();
                                }
                            } else if (res.data.data == 2) {
                                this.verifemail = true;
                            } else {
                                this.loginFailed = true;
                                console.log("gak mantab");
                            }
                        });
                });
            } else {
                console.log("gak masuk");
            }

            this.validation = [];

            if (!this.email) {
                this.validation.email = true;
            }

            if (!this.password) {
                this.validation.password = true;
            }
        },
    },
    mounted() {
        if (this.loggedIn && this.role == "admin") {
            return this.$router.push({ name: "admin" });
        } else if (this.loggedIn && this.role == "user") {
            return this.$router.push({ name: "home" });
        }
    },
};
</script>
