<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <div class="nav-link">
                    <div class="user-wrapper">
                        <div class="profile-image">
                            <img src="images/faces/face1.jpg" alt="profile image">
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name">Richard V.Welsh</p>
                            <div>
                                <small class="designation text-muted">Manager</small>
                                <span class="status-indicator online"></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success btn-block">
                        New Project
                        <i class="mdi mdi-plus"></i>
                    </button>
                </div>
            </li>
            <li class="nav-item">
                <router-link to="dashboard" class="nav-link">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Dashboard</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="computers" class="nav-link">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Computers</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="computers" class="nav-link">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Reports</span>
                </router-link>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    data-toggle="collapse"
                    href="#ui-basic"
                    aria-expanded="false"
                    aria-controls="ui-basic"
                >
                    <i class="menu-icon mdi mdi-content-copy"></i>
                    <span class="menu-title">Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</template>

<style>
a:link {
    color: #000;
}
</style>

