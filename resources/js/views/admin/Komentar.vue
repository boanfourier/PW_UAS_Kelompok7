<template>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Komentar</th>
                    <th>User</th>
                    <th>Created</th>
                    <th class="text-center">
                        <i class="fa fa-cog"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="komentar in komentars" :key="komentar.id">
                    <td>{{ komentar.judul }}</td>
                    <td>{{ komentar.komentar }}</td>
                    <td>{{ komentar.name }}</td>
                    <td>{{ komentar.created_at }}</td>
                    <td class="text-center">
                        <a
                            @click="hapusposting(komentar.id)"
                            class="btn btn-danger"
                        >
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            komentars: [],
        };
    },
    created() {
        axios
            .get("api/getkomentarall")
            .then((response) => {
                this.komentars = response.data.data;
                console.log(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    methods: {
        hapusposting(id) {
            axios
                .delete(`/api/hapuskomentar/${id}`)
                .then((response) => {
                    console.log(response);
                    location.reload();
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    },
};
</script>
