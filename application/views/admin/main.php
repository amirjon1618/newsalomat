<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Panel </title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="{base_url}css/bootstrap.min.css">

    <!-- Kendo upload -->
    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/kendo.common.min.css">
    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/upload.less">
    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/kendo.default-v2.min.css">
    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/font-icons.less">

    <!-- Font Awesome -->

    <!-- <link rel="stylesheet" href="{base_url}css/font-awesome.all.min.css"> -->
    <link rel="stylesheet" href="{base_url}plugins/font-awesome/css/font-awesome.css">
    <!-- <link rel="stylesheet" type="text/css" href="{base_url}src/fonts/font-awesome/css/fontawesome-all.min.css"> -->

    <!-- Ionicons -->

    <link rel="stylesheet" href="{base_url}css/ionicons.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="{base_url}css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins

         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="{base_url}css/skins/_all-skins.min.css">

    <!-- ******************************************************************************* -->

    <link rel="stylesheet" href="{base_url}css/select2.min.css" />

    <link rel="stylesheet" href="{base_url}css/admin_main.css" />


    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- jQuery 2.1.4 -->

    <script src="{base_url}plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script src="{base_url}js/jquery.validate.min.js"></script>

    <script src="{base_url}plugins/jquery.form.validation.min.js"></script>


    <script src="{base_url}js/additional-methods.js"></script>

    <script src="{base_url}js/form_validation_messages_ru.js"></script>
    <!-- Bootstrap 3.3.5 -->

    <script src="{base_url}js/bootstrap.min.js"></script>

    <!-- tinymce -->

    <script src="{base_url}js/tinymce.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">

    <!-- Site wrapper -->

    <div class="wrapper">


        <header class="main-header">

            <!-- Logo -->

            <a href="{base_url}index.php/admin" class="logo">

                <!-- mini logo for sidebar mini 50x50 pixels -->

                <img class="admin_logo" src="{base_url}img/admin_logo.png" alt="">

                <!-- <span class="logo-mini"><b></b></span> -->

                <!-- logo for regular state and mobile devices -->

                <!-- <span class="logo-lg"><b>Client</b> panel </span> -->

            </a>

            <!-- Header Navbar: style can be found in header.less -->

            <nav class="navbar navbar-static-top" role="navigation">

                <!-- Sidebar toggle button-->

                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </a>

                <div class="navbar-custom-menu">
                    <!-- <div class="navbar-notification_div">
                        <a href="{base_url}index.php/admin/orders" style="color: black;">
                            <i class="fa fa-bell-o"></i>
                            <?php if ($waiting_order_count != 0) : ?>
                                <div class="order_notification_badge">{waiting_order_count}</div>
                            <?php endif; ?>
                        </a>
                    </div> -->
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->

                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                <img src="{base_url}img/user.png" class="user-image" alt="User Image">

                                <span class="hidden-xs">{name}</span>

                            </a>

                            <ul class="dropdown-menu">

                                <!-- User image -->

                                <li class="user-header">

                                    <img src="{base_url}img/user.png" class="img-circle" alt="User Image">

                                    <p>

                                        {name}

                                    </p>

                                </li>

                                <li class="user-footer">

                                    <div class="pull-left">

                                        <a href="{base_url}index.php/Admin/profile" class="btn btn-default btn-flat">Profile</a>

                                    </div>

                                    <div class="pull-right">

                                        <a href="{base_url}index.php/Admin/toexit" class="btn btn-default btn-flat">Sign
                                            out</a>

                                    </div>

                                </li>

                            </ul>

                        </li>

                        <!-- Control Sidebar Toggle Button -->


                    </ul>

                </div>
                <div class="header_btns">
                    <a role="button" href="{base_url}index.php/admin/addOrder" class="btn header_add_order">
                        <i class="fa fa-plus"></i>
                        Добавить заявку
                    </a>
                    <a role="button" href="{base_url}index.php/admin/recipes" class="btn header_recipe">
                        <img src="{base_url}img/admin_recipe_icon.png" alt="">
                        э-Рецепт
                        <?php if ($waiting_recipe_count != 0) : ?><div class="recipe_badge">{waiting_recipe_count}</div><?php endif; ?>
                    </a>
                    <a role="button" href="{base_url}index.php/admin/orders" class="btn header_order_count">
                        <i class="fa fa-list"></i>
                        Заявки
                        <?php if ($waiting_order_count != 0) : ?><div class="order_badge">{waiting_order_count}</div><?php endif; ?>
                    </a>
                </div>
            </nav>

        </header>

        <!-- Left side column. contains the sidebar -->

        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->

            <section class="sidebar">

                <!-- Sidebar user panel -->

                <div class="user-panel">

                    <div class="pull-left image">

                        <img src="{base_url}img/user.png" class="img-circle" alt="User Image">

                    </div>

                    <div class="pull-left info">

                        <p>{name}</p>

                    </div>

                </div>

                <ul class="sidebar-menu">

                    <li class="header">Меню</li>

                    <?php if ($this->user->myData['access'] == 100 || $this->user->myData['access'] == 60) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/orders">
                                <i class="fa fa-globe" aria-hidden="true"></i> <span>Заказы </span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">

                            <a href="{base_url}index.php/Admin/Categories">

                                <i class="fa fa-folder-open"></i> <span>Категории</span>

                            </a>

                        </li>

                    <?php } ?>

                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/promo_codes">
                                <i class="fa fa-codepen"></i> <span>Промокоды</span>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/admins">
                                <i class="fa fa-users"></i> <span>Пользователи</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/pages">
                                <i class="fa fa-columns"></i> <span>Страницы</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/banners">
                                <i class="fa fa-map"></i> <span>Слайдер</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/advertisementBanners">
                                <i class="fa fa-bullhorn"></i> <span>Рекламные баннеры</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/reviews">
                                <i class="fa fa-star"></i> <span>Отзывы</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/products">
                                <i class="fa fa-dropbox" aria-hidden="true"></i> <span>Товары</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/forms">
                                <i class="fa fa-certificate"></i> <span>Формы </span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/brands">
                                <i class="fa fa-tag" aria-hidden="true"></i> <span>Бренды </span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/activeSubstances">
                                <i class="fa fa-flask" aria-hidden="true"></i> <span>Действующие вещества </span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/indications">
                                <i class="fa fa-flask" aria-hidden="true"></i> <span>Скидочные тэги </span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/tags">
                                <i class="fa fa-tags" aria-hidden="true"></i> <span>Тэги </span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->user->myData['access'] == 100) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/blogs">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Блоги </span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->user->myData['access'] == 100 || $this->user->myData['access'] == 60) { ?>
                        <li class="treeview">
                            <a href="{base_url}index.php/Admin/recipes">
                                <i class="fa fa-list-alt" aria-hidden="true"></i> <span>э-Рецепты </span>
                            </a>
                        </li>

                    <?php } ?>


                    <?php if ($this->user->myData['access'] == 100 && false) { ?>

                        <li class="treeview">

                            <a href="#">

                                <i class="fa fa-line-chart"></i> <span>Статусы</span> <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">
                                <li><a href="{base_url}index.php/Admin/addStatus"><i class="fa fa-plus"></i> Добавить</a>
                                </li>
                                <li><a href="{base_url}index.php/Admin/status/"><i class="fa fa-list"></i> Список</a></li>

                            </ul>

                        </li>

                    <?php } ?>

                </ul>

            </section>

            <!-- /.sidebar -->

        </aside>

        <!-- =============================================== -->


        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            {content}

        </div><!-- /.content-wrapper -->
        <div id="edit_loading" style="display: none;">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <footer class="main-footer">


        </footer>


        <!-- Add the sidebar's background. This div must be placed

         immediately after the control sidebar -->

        <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->


    <!-- SlimScroll -->

    <script src="{base_url}plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->

    <script src="{base_url}plugins/fastclick/fastclick.min.js"></script>
    <script src="{base_url}plugins/font-awesome/js/font-awesome.min.js"></script>

    <!-- AdminLTE App -->

    <!-- <script src="{base_url}js/font-awesome.all.min.js"></script> -->
    <script src="{base_url}js/app.min.js"></script>

    <script src="{base_url}js/jquery-ui.js"></script>

    <!-- ********************************************************************** -->
    <script src="{base_url}js/select2.min.js"></script>

    <script>
        $(function() {

            var link = $(location).attr('href');


            var link0 = link.split('?');

            var doActiveLink = $('a[href="' + link0[0] + '"]');

            doActiveLink.parent().parent().parent().parent().parent().addClass("active");


            doActiveLink.parent().parent().parent().addClass("active");

            doActiveLink.parent().addClass("active");

        });
    </script>

    <script type="text/javascript">
        $('.confirmation').on('click', function() {

            return confirm('Вы уверены что хотите удалить?');

        });
    </script>
    <script>
        tinymce.init({
            selector: '.editor, #page_about, #blog_about',
            themes: "modern",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste   "
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic |" +
                "alignleft aligncenter alignright alignjustify |" +
                " bullist numlist outdent indent | link image",
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            height: 500
        });
    </script>
    <script>
        function notifications() {
            if (<?= $waiting_recipe_count ?> > 99) {
                $('.recipe_notification_badge').html('');
                $('.recipe_notification_badge').html('99+');
            }
        }
        $(document).ready(function() {
            notifications();
        });
    </script>
</body>

</html>