<template>
    <div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="exampleModalLabel">
                            Edit User
                        </h5>
                        <br />
                        <div v-if="IsSukses" class="alert alert-success">
                            Edit berhasil
                        </div>
                        <div
                            v-if="IsSukses == false"
                            class="alert alert-danger"
                        >
                            Edit Gagal
                        </div>
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
                <form @submit.prevent="updateusers">
                    <input
                        type="hidden"
                        name="user_id"
                        value="<?= $po['id']; ?>"
                    />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                v-model="book.name"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input
                                type="text"
                                v-model="book.email"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <label for="Foto">Foto</label>
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input form-file"
                                    id="form-file"
                                    @change="tambahfoto"
                                    name="foto"
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
                                class="img-thumbnail img-fluid mb-2 img-preview"
                                alt=""
                            />
                        </div>

                        <div class="form-group">
                            <label for="Role">Role</label>
                            <select name="role" class="custom-select">
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <router-link
                            :to="{ name: 'user' }"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </router-link>
                        <button
                            type="submit"
                            name="btnEditUser"
                            class="btn btn-info"
                        >
                            <i class="fa fa-edit"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            book: {},
            IsSukses: null,
            errors: null,
            foto: null,
            previewfoto: null,
        };
    },
    created() {
        axios
            .get(`/api/edituser/${this.$route.params.id}`)
            .then((response) => {
                this.book = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        tambahfoto() {
            let files = event.target.files[0];
            this.previewfoto = URL.createObjectURL(files);
            this.foto = files;
        },
        updateusers() {
            let formData = new FormData();
            if (this.foto != null) {
                console.log("oke");
                formData.append("name", this.book.name);
                formData.append("email", this.book.email);
                formData.append("role", this.book.role);
                formData.append("id", this.$route.params.id);
                formData.append("foto", this.foto);
                formData.append("hapusfoto", this.book.foto);
            } else {
                console.log("gak oke");
                formData.append("name", this.book.name);
                formData.append("email", this.book.email);
                formData.append("role", this.book.role);
                formData.append("id", this.$route.params.id);
            }
            axios
                .post("/api/updateuser", formData)
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
