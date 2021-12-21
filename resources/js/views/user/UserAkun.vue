<template>
    <div>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-user"></i> Profile
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 mb-2">
                            <img
                                v-bind:src="'img/' + user.foto"
                                class="img-fluid rounded-circle d-block mx-auto"
                                style="width: 150px; height: 150px"
                                alt=""
                            />
                        </div>
                        <div class="col-lg-8">
                            <div class="text-center mb-2">
                                <a
                                    @click="edituser(user.id)"
                                    class="btn btn-info"
                                    data-toggle="modal"
                                    data-target="#editProfile"
                                    ><i class="fa fa-edit"></i> Edit Profile</a
                                >
                                <a
                                    href=""
                                    class="btn btn-warning"
                                    data-toggle="modal"
                                    data-target="#editProfilePassword"
                                    ><i class="fa fa-lock"></i> Edit Password</a
                                >
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ user.name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ user.email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="editProfile"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Edit Profile
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateakun(user.id)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    v-model="user.name"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    v-model="user.email"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="Foto">Foto</label>
                                <div class="custom-file">
                                    <input
                                        type="file"
                                        class="custom-file-input"
                                        id="form-file"
                                        name="fotoupdate"
                                        @change="updatefoto"
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
                                    src="<?= $avatar_data['foto']; ?>"
                                    alt=""
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
                                name="btnEditProfile"
                                class="btn btn-info"
                            >
                                <i class="fa fa-edit"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="editProfilePassword"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Edit Password
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Password Baru</label>
                                <input
                                    type="password"
                                    name="password"
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
                                name="btnEditProfilePassword"
                                class="btn btn-warning"
                            >
                                <i class="fa fa-edit"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            token: localStorage.getItem("id"),
            user: [],
            fotoupdate: null,
        };
    },
    created() {
        console.log("id" + this.token);
        if (this.token != null) {
            axios.get(`api/edituser/${this.token}`).then((response) => {
                console.log(response.data);
                this.user = response.data;
            });
        }
    },

    methods: {
        edituser(id) {},
        updatefoto(event) {
            let files = event.target.files[0];
            this.previewupdate = URL.createObjectURL(files);
            this.fotoupdate = files;
            console.log(files);
        },
        updateakun() {
            let formData = new FormData();
            if (this.fotoupdate != null) {
                console.log(" oke " + this.fotoupdate);
                formData.append("email", this.user.email);
                formData.append("name", this.user.name);
                formData.append("role", this.user.role);
                formData.append("id", this.token);
                formData.append("foto", this.fotoupdate);
                formData.append("hapusfoto", this.user.foto);
            } else {
                console.log("gak oke");
                formData.append("email", this.user.email);
                formData.append("name", this.user.name);
                formData.append("role", this.user.role);
                formData.append("id", this.token);
            }
            axios
                .post("api/updateuser", formData)
                .then((response) => {
                    let data = response.data;
                    console.log(data);
                    this.IsSukses = true;
                    location.reload();
                })
                .catch((error) => {
                    this.IsSukses = false;
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
