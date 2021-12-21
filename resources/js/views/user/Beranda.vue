<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <a
                    href=""
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#addPosting"
                >
                    <i class="fa fa-pencil-alt"></i> Posting</a
                >

                <div
                    class="modal fade"
                    id="addPosting"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h5
                                        class="modal-title"
                                        id="exampleModalLabel"
                                    >
                                        Tambah Postingan Baru
                                    </h5>

                                    <div
                                        v-if="IsSukses"
                                        class="alert alert-success"
                                    >
                                        Posting berhasil
                                    </div>
                                    <div
                                        v-if="IsSukses == false"
                                        class="alert alert-danger"
                                    >
                                        Posting Gagal
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
                            <form @submit.prevent="submit">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            v-model="judul"
                                            name="judul"
                                            class="form-control"
                                            placeholder="Masukan Judul"
                                            required
                                        />
                                    </div>
                                    <div class="form-group">
                                        <textarea
                                            v-model="deskripsi"
                                            name="deskripsi"
                                            class="form-control"
                                            placeholder="Masukan Deskripsi"
                                            cols="30"
                                            rows="10"
                                            required
                                        ></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="Gambar">Gambar</label>
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input"
                                                name="foto"
                                                @change="handleFileUpload"
                                            />
                                            <label
                                                class="custom-file-label"
                                                for="customFile"
                                                >Pilih Gambar</label
                                            >
                                        </div>
                                        <img
                                            :src="previewimage"
                                            width="300px"
                                            class="img-thumbnail img-fluid mb-2"
                                        />
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
                                    <button
                                        type="submit"
                                        name="btnPosting"
                                        class="btn btn-primary"
                                    >
                                        <i class="fa fa-paper-plane"></i> Kirim
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2" v-for="posting in postings" :key="posting.id">
            <div class="col-lg-8 mx-auto mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar">
                                <div class="d-flex">
                                    <div class="avatar-photo">
                                        <img
                                            v-bind:src="'img/' + posting.foto"
                                            width="50px"
                                            height="50px"
                                            class="rounded-circle"
                                            alt=""
                                        />
                                    </div>
                                    <div class="avatar-data ml-2">
                                        <strong>
                                            {{ posting.name }}
                                        </strong>
                                        <p>{{ posting.created_at }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="edit">
                                <a
                                    v-if="posting.createdby == token"
                                    class="text-info"
                                    data-toggle="modal"
                                    @click="editposting(posting.id)"
                                    data-target="#editPostingan"
                                    ><i class="fa fa-edit"></i
                                ></a>
                                <div
                                    class="modal fade"
                                    id="editPostingan"
                                    tabindex="-1"
                                    aria-labelledby="exampleModalLabel"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="exampleModalLabel"
                                                >
                                                    Edit Postingan
                                                </h5>
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
                                            <form
                                                @submit.prevent="
                                                    updateposting(id)
                                                "
                                            >
                                                <input
                                                    type="hidden"
                                                    name="postingan_id"
                                                    value="<?= $vp['id']; ?>"
                                                />
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="judul"
                                                            >Judul</label
                                                        >
                                                        <input
                                                            type="text"
                                                            name="judul"
                                                            class="form-control"
                                                            placeholder="Masukan Judul"
                                                            v-model="judul"
                                                            required
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi"
                                                            >Deskripsi</label
                                                        >
                                                        <textarea
                                                            v-model="deskripsi"
                                                            class="form-control"
                                                            placeholder="Masukan Deskripsi"
                                                            cols="30"
                                                            rows="10"
                                                            required
                                                        >
text area diskripsi</textarea
                                                        >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Gambar"
                                                            >Gambar</label
                                                        >
                                                        <div
                                                            class="custom-file"
                                                        >
                                                            <input
                                                                name="fotoupdate"
                                                                @change="
                                                                    updatefoto
                                                                "
                                                                type="file"
                                                                class="custom-file-input form-file"
                                                                id="form-file"
                                                            />
                                                            <label
                                                                class="custom-file-label"
                                                                for="customFile"
                                                                >Pilih
                                                                Gambar</label
                                                            >
                                                        </div>
                                                        <img
                                                            width="300px"
                                                            :src="previewupdate"
                                                            class="img-thumbnail img-preview img-fluid mb-2"
                                                        />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="status"
                                                            >Status</label
                                                        >
                                                        <select
                                                            name="status"
                                                            required
                                                            v-model="status"
                                                            class="custom-select"
                                                        >
                                                            <option
                                                                value="finished"
                                                            >
                                                                finished
                                                            </option>
                                                            <option
                                                                value="unfinished"
                                                            >
                                                                unfinished
                                                            </option>
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
                                                    <button
                                                        type="submit"
                                                        name="btnEditPosting"
                                                        class="btn btn-info"
                                                    >
                                                        <i
                                                            class="fa fa-edit"
                                                        ></i>
                                                        Edit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <p class="text-right">
                            Status :

                            <template v-if="posting.status == 'finished'">
                                <span class="badge badge-secondary"
                                    ><i class="fas fa-check-circle"></i>
                                    Finished</span
                                >
                            </template>

                            <template v-if="posting.status == 'unfinished'">
                                <span class="badge badge-secondary"
                                    ><i class="fas fa-minus-circle"></i>
                                    Unfinished</span
                                >
                            </template>
                        </p>
                        <h4 class="text-center">{{ posting.judul }}</h4>
                        <img
                            v-bind:src="'img/' + posting.gambar"
                            class="img-fluid d-block }mx-auto mb-2"
                            alt=""
                            height="200"
                        />
                        <div class="content text-justify">
                            {{ posting.deskripsi }}
                        </div>
                        <hr />

                        <div class="comment">
                            <a
                                class="btn btn-default mb-2"
                                data-toggle="collapse"
                                href="#collapseExample"
                                role="button"
                                @click="clickkomentar(posting.id)"
                                aria-expanded="false"
                                aria-controls="collapseExample"
                            >
                                jumlah komentar
                            </a>

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

                            <div class="collapse" id="collapseExample">
                                <div
                                    class="card card-body mb-2"
                                    v-for="getkomentar in getkomentars"
                                    :key="getkomentar.id"
                                >
                                    <div class="d-flex justify-content-between">
                                        <div class="avatar-komentar">
                                            <strong>{{
                                                getkomentar.name
                                            }}</strong>
                                            <p>{{ getkomentar.komentar }}</p>
                                        </div>
                                        <div class="waktu-komentar">
                                            <p>{{ getkomentar.created_at }}</p>
                                        </div>
                                    </div>
                                </div>

                                <form
                                    @submit.prevent="submitkomentar(posting.id)"
                                >
                                    <input
                                        type="hidden"
                                        name="postn_id"
                                        value="<?= $post_id ?>"
                                    />
                                    <textarea
                                        name="komentar"
                                        v-model="komentar"
                                        class="form-control"
                                        placeholder="Komentar"
                                        required
                                    ></textarea>

                                    <button
                                        type="submit"
                                        name="btnKomentar"
                                        class="btn btn-primary mt-2 float-right"
                                    >
                                        Kirim
                                    </button>
                                </form>
                            </div>
                        </div>
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
            judul: "",
            deskripsi: "",
            token: localStorage.getItem("id"),
            IsSukses: null,
            id: null,
            postings: [],
            user: {},
            nama: "",
            status: "",
            fotoupdate: null,
            foto: null,
            previewimage: null,
            previewupdate: null,
            komentar: "",
            getkomentars: [],
            errors: null,
        };
    },

    created() {
        axios
            .get(`api/readpostingall`)
            .then((response) => {
                this.postings = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },

    methods: {
        submitkomentar(id) {
            axios
                .post("api/tambahkomentar", {
                    posting_id: id,
                    user_id: this.token,
                    komentar: this.komentar,
                })
                .then((response) => {
                    location.reload();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        clickkomentar(id) {
            axios
                .get(`api/getkomentar/${id}`)
                .then((response) => {
                    this.getkomentars = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleFileUpload(event) {
            let files = event.target.files[0];
            this.previewimage = URL.createObjectURL(files);
            this.foto = files;
        },
        updatefoto(event) {
            let files = event.target.files[0];
            this.previewupdate = URL.createObjectURL(files);
            this.fotoupdate = files;
        },
        submit() {
            let formData = new FormData();

            if (this.foto != null) {
                console.log("oke");
                formData.append("foto", this.foto);
                formData.append("judul", this.judul);
                formData.append("deskripsi", this.deskripsi);
                formData.append("createdby", this.token);
            } else {
                console.log("gak oke");
                formData.append("judul", this.judul);
                formData.append("deskripsi", this.deskripsi);
                formData.append("createdby", this.token);
            }

            axios
                .post("api/posting", formData)
                .then((response) => {
                    let data = response.data;
                    this.IsSukses = true;
                    location.reload();
                    console.log(data);
                })
                .catch((error) => {
                    this.IsSukses = false;
                    this.errors = error.response.data.errors;
                });
        },
        updateposting() {
            let formData = new FormData();

            if (this.fotoupdate != null) {
                console.log(" oke " + this.fotoupdate);

                formData.append("foto", this.fotoupdate);
                formData.append("judul", this.judul);
                formData.append("status", this.status);
                formData.append("deskripsi", this.deskripsi);
                formData.append("hapusfoto", this.foto);
                formData.append("id", this.id);
            } else {
                console.log("gak oke");

                formData.append("judul", this.judul);
                formData.append("status", this.status);

                formData.append("deskripsi", this.deskripsi);
                formData.append("id", this.id);
            }
            axios
                .post("api/updateposting", formData)
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
        editposting(id) {
            this.id = id;
            axios
                .get(`api/postingdetail/${this.id}`)
                .then((response) => {
                    this.judul = response.data.data.judul;
                    this.foto = response.data.data.gambar;
                    this.deskripsi = response.data.data.deskripsi;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
