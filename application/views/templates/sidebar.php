<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('dashboard')?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-Rekanan</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT  `user_menu`.`id`, `menu` FROM `user_menu`
                    JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!--Looping Menu-->
    <?php foreach ($menu as $m) : ?>

        <!--Siapkan Sub Menu-->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT  * FROM `user_sub_menu`
                                WHERE `menu_id` = $menuId
                                AND `is_active` = 1
                            ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php if ($title == $m['menu']) : ?>
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse<?= $m['menu'] ?>" aria-expanded="true" aria-controls="collapse<?= $m['menu'] ?>">
                    <span style="font-size: 14px"><?= $m['menu'] ?></span>
                </a>
                <div id="collapse<?= $m['menu'] ?>" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <?php else : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $m['menu'] ?>" aria-expanded="true" aria-controls="collapse<?= $m['menu'] ?>">
                    <span style="font-size: 14px"><?= $m['menu'] ?></span>
                </a>
                <div id="collapse<?= $m['menu'] ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <?php endif; ?>

                <div class="bg-white py-1 collapse-inner">

                    <?php foreach ($subMenu as $sm) : ?>
                            
                        <!--?php if ($subtitle == $sm['title']) : ?-->
                            <a class="collapse-item" href="<?= base_url() . $sm['url'] ?>"><?= $sm['title'] ?></a>
                        <!--?php else : ?>
                            <a class="collapse-item" href="<!?= base_url() . $sm['url'] ?>"><!?= $sm['title'] ?></a>
                        <!?php endif; ?-->


                    <?php endforeach ?>
                </div>
                </div>
            </li>
        <?php endforeach; ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span style="font-size: 16px">Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>