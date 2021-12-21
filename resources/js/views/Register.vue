<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Register Akun Baru</h1>
                        <div
                            v-if="errors"
                            class="alert bg-danger text-white m-4"
                        >
                            <div v-for="(v, k) in errors" :key="k">
                                <p
                                    v-for="error in v"
                                    :key="error"
                                    class="text-sm"
                                >
                                    {{ error }}
                                </p>
                            </div>
                        </div>
                        <h2 class="text-center">E Service</h2>

                        <div class="text-center">
                            <i
                                class="fas fa-user-plus"
                                style="font-size: 9em"
                            ></i>

                            <form
                                @submit.prevent="submit"
                                class="mt-5 text-left"
                            >
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input
                                        v-model="user.nama"
                                        type="text"
                                        class="form-control"
                                        placeholder="Masukan Nama"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input
                                        type="text"
                                        v-model="user.email"
                                        class="form-control"
                                        placeholder="Masukan Username"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input
                                        type="password"
                                        v-model="user.password"
                                        class="form-control"
                                        placeholder="Masukan Password"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="Foto">Foto</label>
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="form-file"
                                            name="foto"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="customFile"
                                            >Pilih Foto</label
                                        >
                                    </div>
                                    <img
                                        id="img-preview"
                                        width="300px"
                                        class="img-thumbnail img-fluid mb-2"
                                        alt=""
                                    />
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-dark btn-block"
                                >
                                    <i class="fa fa-user-plus"></i> Register
                                </button>
                                <hr />

                                <router-link
                                    class="btn btn-secondary btn-block"
                                    :to="{ name: 'login' }"
                                >
                                    <i class="fa fa-user"></i>
                                    Sudah punya Akun?
                                </router-link>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">
                            <i class="fa fa-copyright"></i>
                            <a href="?page=beranda" class="text-dark"
                                >E Service</a
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
            user: {
                nama: "",
                email: "",
                password: "",
                role: "user",
            },
            errors: null,
        };
    },
    methods: {
        submit() {
            axios
                .post("api/register", this.user)
                .then((response) => {
                    let data = response.data;
                    localStorage.setItem("user", JSON.stringify(data.user));
                    localStorage.setItem("jwt", data.token);
                    this.$router.push({
                        name: "login",
                        params: "/login",
                    });
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
            console.log(this.user);
        },
    },
};
</script>
