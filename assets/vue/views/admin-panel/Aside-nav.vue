
<template>
    <div class="container-fluid bg-yellow-white">
        <div class="row">
    <!-----------------------  ASIDE MENU ----------------------------------------------------------------------->
            <nav id="aside-menu" class="col-md-2 bg-green sidebar">
                <div class="sidebar-sticky overflow-hidden">
                    <ul class="nav flex-column">
                        <router-link :to="{ name: 'admin_panel' }" class="nav-item" tag="li" active-class="active">
                            <a class="nav-link" href="#">
                                <span class="nav-icon"><b-icon-person-plus-fill></b-icon-person-plus-fill></span>
                                Админ панел
                            </a>
                        </router-link>
                        <router-link :to="{ name: 'admin_article_index' }" class="nav-item" tag="li" >
                            <a class="nav-link"  href="#">
                                <span class="nav-icon"><b-icon-card-text></b-icon-card-text></span>
                                Статии
                            </a>
                        </router-link>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-icon"><b-icon-newspaper></b-icon-newspaper></span>
                                Новини
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-icon"><b-icon-brightness-low-fill></b-icon-brightness-low-fill></span>
                                Духовни бисери
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-icon"><b-icon-list-task></b-icon-list-task></span>
                                Категории
                            </a>
                        </li>
                        <router-link class="nav-item" tag="li" to="/tag/list-all" active-class="active">
                            <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <span class="nav-icon"><b-icon-tag></b-icon-tag></span>
                                Етикети
                            </a>
                        </router-link>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-icon"><b-icon-image></b-icon-image></span>
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
