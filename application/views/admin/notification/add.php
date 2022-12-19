<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{base_url}index.php/admin/blogs"><i class="fa fa-list"></i> Статьи</a></li>
        <li class="active">Добавить статью</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавить статью</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form class="blog_add_form" action="" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
                        <div class="form-group blog_title_div">
                            <label>Наименование </label>
                            <input type="text" id="blog_title" name="blog_title" class="form-control blog_title" placeholder="Вводите ...">
                        </div>
                        <div class="form-group blog_about_div">
                            <label>Текст </label>
                            <textarea type="text" id="blog_about" name="blog_about" class="form-control" placeholder="Вводите ...">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="tags">Тэги </label>
                            <select required data-placeholder="Выберите ..." multiple name="tags[]" id="tags" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="srch_pr_inp">Продукты</label>
                            <select required data-placeholder="Выберите ..." multiple name="srch_pr_inp[]" id="srch_pr_inp" class="form-control">
                            </select>
                        </div>

                        <div class="box-footer">
                            <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/blogs'" class="btn btn-default">Отмена</button>
                            <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

<script>
    function validateForm() {
        $("#blog_title").find('tox-tinymce').css('border-color', '');
        $("#blog_about_div").find('tox-tinymce').css('border-color', '');

        var b = true;

        if ($("#blog_title").val().length == 0) {
            $("#blog_title").find('tox-tinymce').css('border-color', 'red');
            $("#blog_title").focus();
            b = false;
        }

        if ($("#blog_about").val().length == 0) {
            $("#blog_about_div").find('tox-tinymce').css('border-color', 'red');
            $("#blog_about_div").focus();
            b = false;
        }
        return b;
    }

    $(document).ready(function() {
        $("#tags").select2({
            minimumInputLength: 1,
            allowClear: true,
            ajax: {
                url: '{base_url}Api/GetTag',
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

    $(document).ready(function() {

        $("#srch_pr_inp").select2({
            minimumInputLength: 1,
            allowClear: true,
            ajax: {
                url: '{base_url}Main/searchProductForBlog',
                dataType: "json",
                data: function(term) {
                    return {
                        srch_pr_inp: term.term
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