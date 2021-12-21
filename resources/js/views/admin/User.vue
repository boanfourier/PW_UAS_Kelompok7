<template>
    <div>
        <div v-if="IsDaftar == true" class="alert alert-success">
            User berhasil terdaftar
        </div>
        <a
            data-toggle="modal"
            data-target="#addUser"
            class="btn btn-primary float-right"
        >
            <i class="fa fa-plus"></i> Tambah</a
        >
        <div
            class="modal fade"
            id="addUser"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Tambah User Baru
                        </h5>
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

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="tambahuser">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input
                                    type="text"
                                    v-model="user.name"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    v-model="user.email"
                                    class="form-control"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="Foto">Foto</label>
                                <div class="custom-file">
                                    <input
                                        name="foto"
                                        @change="tambahfoto"
                                        type="file"
                                        class="custom-file-input"
                                        id="form-file"
                                    />
                                    <label
                                        class="custom-file-label"
                                        for="customFile"
                                        >Pilih Foto</label
                                    >
                                </div>
                                <img
                                    :src="previewfoto"
                                    width="300px"
                                    class="img-thumbnail img-fluid mb-2"
                                    alt=""
                                />
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    v-model="user.password"
                                    class="form-control"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="Role">Role</label>
                                <select
                                    name="role"
                                    v-model="user.role"
                                    class="custom-select"
                                    required
                                >
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i> Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th class="text-center">
                            <i class="fa fa-cog"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.name }}</td>
                        <td class="text-center">
                            <img
                                v-bind:src="'img/' + user.foto"
                                width="100px"
                                class="mx-auto d-block"
                                alt=""
                            />
                        </td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>

                        <td>
                            <router-link
                                :to="{
                                    name: 'edituser',
                                    params: { id: user.id },
                                }"
                                class="btn btn-info"
                                >Edit
                            </router-link>

                            <a
                                @click="submit(user.id)"
                                href=""
                                class="btn btn-warning"
                                data-toggle="modal"
                                data-target="#editPassword"
                                ><i class="fa fa-lock"></i
                            ></a>
                            <div
                                class="modal fade"
                                id="editPassword"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div>
                                                <h5
                                                    class="modal-title"
                                                    id="exampleModalLabel"
                                                >
                                                    Edit Password
                                                </h5>
                                                <br />

                                                <div
                                                    v-if="IsSukses"
                                                    class="alert alert-success"
                                                >
                                                    Ganti password berhasil
                                                </div>
                                            </div>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <form @submit.prevent="editpassword">
                                            <input
                                                type="hidden"
                                                name="user_id"
                                                value="<?= $po['id']; ?>"
                                            />
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama"
                                                        >Password Baru</label
                                                    >
                                                    <input
                                                        placeholder="enter password"
                                                        type="password"
                                                        v-model="password"
                                                        class="form-control"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                >
                                                    Batalkan
                                                </button>
                                                <button
                                                    type="submit"
                                                    name="btnEditPassword"
                                                    class="btn btn-warning"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a
                                @click="hapususer(user.id)"
                                class="btn btn-danger"
                            >
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            user: {
                name: "",
                email: "",
                password: "",
                role: "",
            },
            password: "",
            idpassword: null,
            IsDaftar: null,
            IsSukses: null,
            foto: null,
            previewfoto: null,
            errors: null,
        };
    },
    created() {
        axios
            .get("api/getuserall")
            .then((response) => {
                this.users = response.data.data;
                console.log(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    methods: {
        tambahfoto() {
            let files = event.target.files[0];
            this.previewfoto = URL.createObjectURL(files);
            this.foto = files;
        },
        tambahuser() {
            let formData = new FormData();
            if (this.foto != null) {
                console.log("oke" + this.foto);
                formData.append("name", this.user.name);
                formData.append("email", this.user.email);
                formData.append("password", this.user.password);
                formData.append("role", this.user.role);
                formData.append("email_verified_at", Date.now());
                formData.append("foto", this.foto);
            } else {
                console.log("gak oke");
                formData.append("name", this.user.name);
                formData.append("email", this.user.email);
                formData.append("password", this.user.password);
                formData.append("role", this.user.role);
                formData.append("email_verified_at", Date.now());
            }
            axios
                .post("api/register", formData)
                .then((response) => {
                    let data = response.data;
                    this.IsDaftar = true;
                    location.reload();
                })
                .catch((error) => {
                    console.log(error);
                    this.IsDaftar = false;
                    this.errors = error.response.data.errors;
                });
            console.log(this.user);
        },
        hapususer(id) {
            axios
                .delete(`/api/delete/${id}`)
                .then((response) => {
                    location.reload();
                })
                .catch(function (error) {
                    console.error(error);
                });
        },

        submit(id) {
            this.idpassword = id;
        },

        editpassword() {
            console.log(this.idpassword + "tester" + this.password);
            axios
                .post("api/updatepassword", {
                    password: this.password,
                    id: this.idpassword,
                })
                .then((response) => {
                    let data = response.data;
                    this.IsSukses = true;
                    console.log(data);
                })
                .catch((error) => {
                    this.IsSukses = false;
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
