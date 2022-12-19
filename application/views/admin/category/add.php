<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <?php if ($cat_parent_id == 0) : ?>
            <li><a href="{base_url}admin/categories"><i class="fa fa-dashboard"></i> Категории</a></li>
        <?php else : ?>
            <li><a href="{base_url}admin/categories"><i class="fa fa-dashboard"></i> Категории</a></li>
            <!--        <li><a href="{base_url}admin/subCategories/--><?php //echo $parent_category['id']
                                                                        ?>
            <!--"><i class="fa fa-dashboard"></i> --><?php //echo $parent_category['category_name']
                                                        ?>
            <!--</a></li>-->
            <li><a href="{base_url}admin/subCategories/{cat_parent_id}"><i class="fa fa-dashboard"></i> <?php echo $category['category_name'] ?></a></li>
        <?php endif; ?>
        <li class="active">Добавить</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">

                <div class= "box-header with-border">
                    <h3 class="box-title">Добавить</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Наименование </label>
                            <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Вводите ...">
                        </div>
                        <!--             <div class="form-group">-->
                        <!--                <label>Иконка </label>-->
                        <!--                <input type="file" id="category_icon" name="category_icon" class="form-control" placeholder="Вводите ..." >-->
                        <!--            </div>-->
                        <div class="form-group" id="file_div">
                            <label class="userfile_label">Иконка </label>
                            <input type="file" name="userfile" class="file_inp" size="50" />
                            <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input()"></i>
                        </div>
                        <!--            <div class="form-group">-->
                        <!--                <label>Категории </label>-->
                        <!--                -->
                        <!--                    <select name="categories" id="categories" class="form-control">-->
                        <!--                      <option value="0">-Выберите категорию-</option>-->
                        <!--                --><?php //foreach ($categories as $cat):
                                                ?>
                        <!---->
                        <!--                      <option value="--><?php //echo $cat['id']
                                                                    ?>
                        <!--">-->
                        <!--                          --><?php //echo $cat['category_name'];
                                                            ?>
                        <!--                      </option>-->
                        <!--                      --><?php //if (sizeof($cat['sub_cat']) != 0):
                                                        ?>
                        <!--                        --><?php //foreach ($cat['sub_cat'] as $sub_c):
                                                        ?>
                        <!--                                <option value="--><?php //echo $sub_c['id']
                                                                                ?>
                        <!--">-->
                        <!--                                --><?php //echo "-" . $sub_c['category_name'];
                                                                ?>
                        <!--                                </option>-->
                        <!--                                --><?php //if (sizeof($sub_c['sub_cat']) != 0):
                                                                ?>
                        <!--                                    --><?php //foreach ($sub_c['sub_cat'] as $val):
                                                                    ?>
                        <!--                                      <option value="--><?php //echo $val['id']
                                                                                    ?>
                        <!--" disabled>-->
                        <!--                                      --><?php // echo "--" . $val['category_name'];
                                                                        ?>
                        <!--                                      </option>-->
                        <!--                                    --><?php //endforeach;
                                                                    ?>
                        <!--                                --><?php //endif;
                                                                ?>
                        <!--                                --><?php //endforeach;
                                                                ?>
                        <!--                           --><?php //endif;
                                                            ?>
                        <!--                --><?php //endforeach;
                                                ?>
                        <!---->
                        <!--                    </select>-->
                        <!--            </div>-->
                        <div class="box-footer">
                            <?php if ($cat_parent_id == 0) : ?>
                                <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/categories'" class="btn btn-default">Отмена</button>
                            <?php else : ?>
                                <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/subCategories/{cat_parent_id}'" class="btn btn-default">Cancel</button>
                            <?php endif; ?>
                            <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                        </div>

                    </form>
                </div><!-- /.box-body -->
</section>
<!-- Bootstrap WYSIHTML5 -->

<script>
    function cancel_file_input() {
        $('.file_inp').val('');
    }

    function validate_chekout() {
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $('form').validate({
            lang: 'ru',
            rules: {
                slider_name: {
                    required: true
                },
                slider_link: {
                    required: true,
                    url: true
                },
                userfile: {
                    required: false,
                    accept: "image/jpg,image/jpeg,image/png,image/svg",
                    // filesize: 4500000
                }
            },
            messages: {
                userfile: {
                    required: "Пожалуйста выберите файл"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    }

    $(document).ready(function() {
        // validate_chekout();
    });
</script>