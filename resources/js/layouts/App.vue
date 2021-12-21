<template>
    <div>
        <div>
            <template v-if="role == 'admin'">
                <!-- Sidebar -->
                <div id="wrapper">
                    <ul
                        class="navbar-nav bg-dark sidebar sidebar-dark accordion"
                        id="accordionSidebar"
                    >
                        <!-- Sidebar - Brand -->

                        <router-link
                            class="sidebar-brand d-flex align-items-center justify-content-center"
                            :to="{ name: 'admin' }"
                        >
                            <div class="sidebar-brand-icon">
                                <i class="fa fa-user-secret"></i>
                            </div>
                            <div class="sidebar-brand-text mx-3">E-Laporz</div>
                        </router-link>
                        <!-- Divider -->
                        <hr class="sidebar-divider my-0" />

                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item active">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'admin' }"
                            >
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'postingan' }"
                            >
                                <i class="fas fa-fw fa-newspaper"></i>
                                <span>Postingan</span>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'komentar' }"
                            >
                                <i class="fas fa-fw fa-comment"></i>
                                <span>Komentar</span></router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'user' }"
                            >
                                <i class="fas fa-fw fa-users"></i>
                                <span>User</span></router-link
                            >
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" @click="logout">
                                <i class="fas fa-fw fa-users"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                        <!-- Divider -->
                        <hr class="sidebar-divider d-none d-md-block" />

                        <!-- Sidebar Toggler (Sidebar) -->
                        <div class="text-center d-none d-md-inline">
                            <button
                                class="rounded-circle border-0"
                                id="sidebarToggle"
                            ></button>
                        </div>
                    </ul>

                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">
                        <!-- Main Content -->
                        <div id="content">
                            <!-- Topbar -->
                            <nav
                                class="navbar navbar-expand navbar-dark bg-secondary topbar mb-4 static-top shadow"
                            >
                                <div class="navbar-brand">
                                    <h5>Administrator</h5>
                                </div>

                                <!-- Topbar Navbar -->
                                <ul class="navbar-nav ml-auto">
                                    <div
                                        class="topbar-divider d-none d-sm-block"
                                    ></div>

                                    <!-- Nav Item - User Information -->
                                    <li class="nav-item dropdown no-arrow">
                                        <a
                                            class="nav-link dropdown-toggle"
                                            href="#"
                                            id="userDropdown"
                                            role="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <span
                                                class="mr-2 d-none d-lg-inline text-white small"
                                                >{{ user.name }}</span
                                            >
                                            <img
                                                class="img-profile rounded-circle"
                                                v-bind:src="'img/' + user.foto"
                                            />
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div
                                            class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="userDropdown"
                                        >
                                            <div class="dropdown-divider"></div>
                                            <a
                                                class="dropdown-item"
                                                @click="logout"
                                                data-toggle="modal"
                                                data-target="#logoutModal"
                                            >
                                                <i
                                                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                                                ></i>

                                                Logout
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                            <!-- End of Topbar -->

                            <!-- Begin Page Content -->
                            <div class="container-fluid">
                                <!-- Content Row -->
                                <div class="row">
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div
                                            class="card border-left-info shadow h-100 py-2"
                                        >
                                            <div class="card-body">
                                                <div
                                                    class="row no-gutters align-items-center"
                                                >
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                                        >
                                                            Postingan
                                                        </div>
                                                        <div
                                                            class="h5 mb-0 font-weight-bold text-gray-800"
                                                        >
                                                            {{ jumlahposting }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i
                                                            class="fas fa-newspaper fa-2x text-gray-300"
                                                        ></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div
                                            class="card border-left-info shadow h-100 py-2"
                                        >
                                            <div class="card-body">
                                                <div
                                                    class="row no-gutters align-items-center"
                                                >
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                                        >
                                                            Komentar
                                                        </div>
                                                        <div
                                                            class="h5 mb-0 font-weight-bold text-gray-800"
                                                        >
                                                            {{ jumlahkomentar }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i
                                                            class="fas fa-comment fa-2x text-gray-300"
                                                        ></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pending Requests Card Example -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div
                                            class="card border-left-info shadow h-100 py-2"
                                        >
                                            <div class="card-body">
                                                <div
                                                    class="row no-gutters align-items-center"
                                                >
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-info text-uppercase mb-1"
                                                        >
                                                            User
                                                        </div>
                                                        <div
                                                            class="h5 mb-0 font-weight-bold text-gray-800"
                                                        >
                                                            {{ jumlahusers }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i
                                                            class="fas fa-users fa-2x text-gray-300"
                                                        ></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Content Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <router-view></router-view>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Begin Page Content -->
                        </div>
                    </div>
                    <!-- content -->
                    <!-- <div class="container">
                        <router-view></router-view>
                    </div> -->
                </div>
                <!-- End of Sidebar -->
            </template>

            <template v-if="role == 'user'">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <router-link
                        @setData="getData"
                        class="navbar-brand"
                        :to="{ name: 'berandauser' }"
                    >
                        <template v-if="!role">
                            <p>User</p>
                        </template>
                        <template v-if="role">
                            <p>E-Laporz</p>
                        </template>
                    </router-link>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarTogglerDemo02"
                        aria-controls="navbarTogglerDemo02"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div
                        class="collapse navbar-collapse"
                        id="navbarTogglerDemo02"
                    >
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <router-link
                                :to="{ name: 'userakun' }"
                                class="nav-link"
                            >
                                <i class="fa fa-user"></i> {{ user.name }}
                            </router-link>
                            <li class="nav-item">
                                <a class="nav-link" @click="logout">
                                    <i class="fa fa-sign-in-alt"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- content -->
                <div class="container">
                    <router-view></router-view>
                </div>
            </template>

            <template v-if="role == ''">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <router-link
                        @setData="getData"
                        class="navbar-brand"
                        :to="{ name: 'beranda' }"
                    >
                        <template v-if="!role">
                            <p>E-Laporz</p>
                        </template>
                        <template v-if="role">
                            <p>USER</p>
                        </template>
                    </router-link>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarTogglerDemo02"
                        aria-controls="navbarTogglerDemo02"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div
                        class="collapse navbar-collapse"
                        id="navbarTogglerDemo02"
                    >
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <router-link
                                    class="nav-link"
                                    :to="{ name: 'about' }"
                                >
                                    <i class="fa fa-sign-in-alt"></i> About
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    class="nav-link"
                                    :to="{ name: 'login' }"
                                >
                                    <i class="fa fa-sign-in-alt"></i> Login
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- content -->
                <div class="container">
                    <router-view></router-view>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            role: null,
            loggedIn: localStorage.getItem("loggedIn"),
            token: localStorage.getItem("id"),
            user: [],
            jumlahkomentar: null,
            jumlahposting: null,
            jumlahusers: null,
        };
    },
    beforeMount() {
        this.getData();
    },
    created() {
        if (this.token != null) {
            axios.get(`api/edituser/${this.token}`).then((response) => {
                console.log(response.data);
                this.user = response.data;
            });
        }

        axios.get(`api/jumlahkomentar`).then((response) => {
            this.jumlahkomentar = response.data.jumlahkomentar;
        });

        axios.get(`api/jumlahposting`).then((response) => {
            this.jumlahposting = response.data.jumlahpostings;
        });

        axios.get(`api/jumlahusers`).then((response) => {
            this.jumlahusers = response.data.jumlahusers;
        });
    },
    methods: {
        getData() {
            if (localStorage.getItem("role") == "admin") {
                this.role = "admin";
                console.log(this.role);
            } else if (localStorage.getItem("role") == "user") {
                this.role = "user";
                console.log(this.role);
            } else if (localStorage.getItem("role") == null) {
                this.role = "";
                console.log("tester" + this.role);
            }
        },

        logout() {
            axios.post("logout").then((response) => {
                console.log(response);
                localStorage.removeItem("token");
                localStorage.removeItem("loggedIn");
                localStorage.removeItem("role");
                this.$router.push({ name: "home" });
                location.reload();
            });
        },
    },
};
</script>
