<template>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th class="text-center">
                        <i class="fa fa-cog"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php
                $posting_sql = "SELECT * FROM posting ORDER by created_at";
                $posting = $conn->query($posting_sql);
                while($po = $posting->fetch_array()) :
            ?> -->
                <tr v-for="posting in postings" :key="posting.id">
                    <!-- <td><?= $po['judul']; ?></td> -->
                    <td>{{posting.judul}}</td>
                    <td class="text-center">
                     <img v-bind:src="'img/'+posting.foto"
                 width="200px" class="mx-auto d-block" alt="">
                    </td>
                    <!-- <td><?= $po['deskripsi']; ?></td> -->
                    <td>{{posting.deskripsi}}</td>
                    <!-- <td><?= $po['created_at']; ?></td> -->
                    <td>{{posting.created_at}}</td>
                    <!-- <td><?= $po['updated_at']; ?></td> -->
                    <td>{{posting.updated_at}}</td>
                    <td>
   <a
                            @click="hapusposting(posting.id)"
                            class="btn btn-danger"
                        >
                            <i class="fa fa-trash"></i>
                        </a>                    </td>
                </tr>
                <!-- <?php endwhile; ?> -->
            </tbody>
        </table>
    </div>
</template>
<script>export default {
    data() {
        return {
            postings: [],
        };
    },
    created() {
        axios
            .get("api/readpostingall")
            .then((response) => {
                this.postings = response.data.data;
                console.log(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    methods: {
        hapusposting(id) {
            axios
                .delete(`/api/hapusposting/${id}`)
                .then((response) => {
                    location.reload();
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    },
};
</script>

</script>