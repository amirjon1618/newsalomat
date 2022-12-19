<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{base_url}admin/products"><i class="fa fa-dashboard"></i> Товары</a></li>
        <li class="active"> {product_name}</li>
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
					
					
					<div class="col-md-6">
						<!-- text input -->
                        <div class="form-group">
                            <label for="product_status">Показ товар </label>
                            <select class="form-control" name="product_status" id="product_status">
                                <option value="0" <?php if ($product_status == '0') echo 'selected' ?>>Не показывать</option>
                                <option value="1" <?php if ($product_status == '1') echo 'selected' ?>>Показывать</option>
                            </select>
                        </div>
						
						<div class="form-group">
                            <label>Наименование </label>
                            <input value="{product_name}" required type="text" id="product_name" name="product_name" class="form-control" placeholder="Вводите ...">
						</div>
					
					
						<div class="form-group">
                            <label for="indications">Скидочные тэги </label>
                            <select data-placeholder="Выберите ..." multiple name="indications[]" id="indications" class="chosen-select form-control">
                            <?php if ($indications[0]['id'] != '') : ?>
                                    <?php foreach ($indications as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>" selected>
                                            <?php echo $value['tag_name']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
						</div>
					
					
						<div class="form-group">
                            <label for="active-substances">Действующее вещество </label>
                            <select data-placeholder="Выберите ..." multiple name="active-substances[]" id="active-substances" class="chosen-select form-control">
                                <?php if ($active_substance[0]['id'] != '') : ?>
                                    <?php foreach ($active_substance as $value) : ?>
                                        <option value="<?php echo $value['id']; ?>" selected>
                                            <?php echo $value['tag_name']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
						</div>
						
						
						<div class="form-group">
                            <label for="product-type">Вид </label>
                            <select class="form-control" name="product-type" id="product-type">
                                <option value="">Выберите ...</option>
                                <option value="Рецептурный" <?php if ($product_type == 'Рецептурный') echo 'selected' ?>>
                                    Рецептурный</option>
                                <option value="Безрецептурный" <?php if ($product_type == 'Безрецептурный') echo 'selected' ?>>
                                    Безрецептурный</option>
                            </select>
                        </div>
						
						<div class="form-group">
                            <label for="product-brand">Производитель </label>
                            <select data-placeholder="Выберите ..." name="product-brand" id="product-brand" class="chosen-select form-control">
                                <option value="<?php echo $product_brand['id']; ?>" selected>
                                    <?php echo $product_brand['brand_name']; ?></option>
                            </select>
                        </div>
						
						
						
					</div>
					
					
					
					
					
					<div class="col-md-6">
							 
                        <div class="form-group">
                            <label>Артикул </label>
                            <input required value="{product_articule}" type="text" id="product_articule" name="product_articule" class="form-control" placeholder="Вводите ...">
                        </div>
						
						<div class="form-group">
                            <label>Общее количество товаров </label>
                            <input required type="number" min="0" id="total_count_in_store" required name="total_count_in_store" class="form-control" placeholder="Вводите ...">
                        </div>
						
						 <div class="form-group">
                            <label>Старая цена </label>
                            <input value="{product_old_price}" type="decimal" min="0" id="product_old_price" name="product_old_price" class="form-control" placeholder="Вводите ...">
                        </div>
                        <div class="form-group">
                            <label>Реальная цена </label>
                            <input value="{product_price}" required type="decimal" min="0" id="product_price" name="product_price" class="form-control" placeholder="Вводите ...">
                        </div>
						
						<div class="form-group">
                            <label for="categories">Категория </label>
                            <select required data-placeholder="Выберите ..." multiple name="categories[]" id="categories" class="form-control">
                                <?php if ($categories[0]['id'] != '') : ?>
                                    <?php foreach ($categories as $value) : ?>
                                        <option value="<?= $value['id']; ?>" selected>
                                            <?= $value['category_name']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
						
						
						<div class="form-group">
                            <label for="product-form">Форма выпуска </label>
                            <select data-placeholder="Выберите ..." name="product-form" id="product-form" class="chosen-select form-control">
                                <option value="<?php echo $product_form['id']; ?>" selected>
                                    <?php echo $product_form['form_name']; ?></option>
                            </select>
                        </div>

                        

                        <div class="form-group" style="display: none;">
                            <label for="product-country">Страна производства </label>
                            <select data-placeholder="Выберите ..." name="product-country" id="product-country" class="chosen-select form-control">
                                <option value="<?php echo $product_country['id']; ?>" selected>
                                    <?php echo $product_country['country_name']; ?></option>
                            </select>
                        </div>
						
					</div>
					
					<div class="col-md-12">

                        
                        <div class="form-group" id="avatar_file_div">
                            <label class="userfile_label">Изображение 1 (Для аватара продукта)</label>
                            <input class="file_inp" id="userfile1" type="file" name="userfile1" size="50" />
                            <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input('#userfile1')"></i>
                        </div>

                        <div class="form-group">
                            <label class="userfile_label">Изображение 2</label>
                            <input class="file_inp" id="userfile2" type="file" name="userfile2" size="50" />
                            <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input('#userfile2')"></i>
                        </div>
                        <div class="form-group">
                            <label class="userfile_label">Изображение 3</label>
                            <input class="file_inp" id="userfile3" type="file" name="userfile3" size="50" />
                            <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input('#userfile3')"></i>
                        </div>
						
						<!-- textarea -->
                        <div class="form-group">
                            <label for="product_about">Текст</label>
                            <textarea id="product_about" name="product_about" rows="10" cols="25" class="form-control editor">{product_about}</textarea>
                        </div>
                        <div class="box-footer">
                            <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/products?page={page}'" class="btn btn-default">Отмена
                            </button>
                            <input type="submit" name="AddBtn" value="Изменить" class="btn btn-primary pull-right" />
                        </div>
						
					</div>
                        

                    </form>
                </div><!-- /.box-body -->
</section>
<!-- Bootstrap WYSIHTML5 -->
<script>
    // $("#indications").keyup(function() {
    //     $.ajax({url: "", success: function(res) {

    //     }});
    // });
    // $("#active_substance").keyup(function() {
    //     $.ajax({url: "", success: function(res) {

    //     }});
    // });
    function cancel_file_input(str) {
        $(str).val('');
    }
    $(document).ready(function() {
        $("#indications").select2({
            minimumInputLength: 1,
            ajax: {
                url: '{base_url}Api/GetIndication',
                dataType: "json",
                data: function(term) {
                    return {
                        term: term.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });
        $("#active-substances").select2({
            minimumInputLength: 1,
            ajax: {
                url: '{base_url}Api/GetActiveSubstance',
                dataType: "json",
                data: function(term) {
                    return {
                        term: term.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });
        $("#categories").select2({
            minimumInputLength: 1,
            ajax: {
                url: '{base_url}Api/GetMinSubCategory',
                dataType: "json",
                data: function(term) {
                    return {
                        term: term.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });
        $("#product-form").select2({
            minimumInputLength: 1,
            allowClear: true,
            ajax: {
                url: '{base_url}Api/GetForm',
                dataType: "json",
                data: function(term) {
                    return {
                        term: term.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });
        $("#product-brand").select2({
            minimumInputLength: 1,
            allowClear: true,
            ajax: {
                url: '{base_url}Api/GetBrand',
                dataType: "json",
                data: function(term) {
                    return {
                        term: term.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });
        $("#product-country").select2({
            minimumInputLength: 1,
            allowClear: true,
            ajax: {
                url: '{base_url}Api/GetCountry',
                dataType: "json",
                data: function(term) {
                    return {
                        term: term.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });
    });
</script>