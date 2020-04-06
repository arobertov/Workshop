
<template>
    <div class="container-fluid bg-yellow-white">
        <div class="row">
    <!-----------------------  ASIDE MENU ----------------------------------------------------------------------->
            <nav id="aside-menu" class="col-md-2 bg-green sidebar">
                <div class="sidebar-sticky overflow-hidden">
                    <ul class="nav flex-column">
                        <router-link class="nav-item" tag="li" to="/admin" active-class="active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users-cog"></i>
                                Админ панел
                            </a>
                        </router-link>
                        <router-link :to="{name: 'article_index'}" class="nav-item" tag="li"  active-class="active">
                            <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <span class="nav-icon"><i class="far fa-newspaper"></i></span>
                                Статии
                            </a>
                        </router-link>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-icon"><i class="far fa-newspaper"></i></span>
                                Новини
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-icon"><i class="fas fa-newspaper"></i></span>
                                Духовни бисери
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Категории
                            </a>
                        </li>
                        <router-link class="nav-item" tag="li" to="/tag/list-all" active-class="active">
                            <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <span class="nav-icon"><i class="far fa-newspaper"></i></span>
                                Етикети
                            </a>
                        </router-link>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                Изображения
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <router-view/>
            </main>
        </div>
    </div>
</template>


<script>
    export default {
        name: "Aside-nav"
    }
</script>
