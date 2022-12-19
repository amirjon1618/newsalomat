<section class="content-header">
    <h1>
        <br/>
    </h1>
    <ol class="breadcrumb">
        <?php if ($cat_parent_id == 0): ?>
            <li><a href="{base_url}admin/categories"><i class="fa fa-dashboard"></i> Категории</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> <?php echo $category['category_name'] ?></a></li>
        <?php else: ?>
            <li><a href="{base_url}admin/categories"><i class="fa fa-dashboard"></i> Категории</a></li>
            <li><a href="{base_url}admin/subCategories/<?php echo $parent_category['id'] ?>"><i
                            class="fa fa-dashboard"></i> <?php echo $parent_category['category_name'] ?></a></li>
            <li class="active"><i class="fa fa-dashboard"></i> <?php echo $category['category_name'] ?></a></li>
        <?php endif; ?>
        <li class="active"> Изменить</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Изменить</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Наименование </label>
                            <input type="text" id="category_name" name="category_name" class="form-control"
                                   value="<?php echo $category['category_name'] ?>">
                        </div>

                        <div class="form-group" id="file_div">
                            <label class="userfile_label">Иконка </label>
                            <input type="file" name="userfile" class="file_inp" size="50" />
                            <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input()"></i>
                        </div>

                        <div class="box-footer">
                            <?php if ($cat_parent_id == 0): ?>
                                <button type="button"
                                        onclick="javascript:window.location.href='{base_url}index.php/admin/categories'"
                                        class="btn btn-default">Отмена
                                </button>
                            <?php else: ?>
                                <button type="button"
                                        onclick="javascript:window.location.href='{base_url}index.php/admin/subCategories/{cat_parent_id}'"
                                        class="btn btn-default">Отмена
                                </button>
                            <?php endif; ?>
                            <input type="submit" name="AddBtn" value="Изменить" class="btn btn-primary pull-right"/>
                        </div>

                    </form>
                </div><!-- /.box-body -->
</section>
<script>
    function cancel_file_input() {
        $('.file_inp').val('');
    }
</script>
<!-- Bootstrap WYSIHTML5 -->

