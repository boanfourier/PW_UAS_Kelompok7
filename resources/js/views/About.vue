<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mt-5">
                <div class="card card-body">
                    <h1 class="text-center">
                        <i class="fa fa-question-circle"></i> About
                    </h1>
                    <p class="text-center">
                        E Laporz adalah website forum untuk pengaduan barang
                        hilang
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["name"],
    data() {
        return {
            users: [
                { id: 1, name: "Alfan" },
                { id: 2, name: "dinda" },
                { id: 3, name: "reza" },
            ],
        };
    },
};
</script>
