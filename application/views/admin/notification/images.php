<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{base_url}index.php/admin/blogs"><i class="fa fa-list"></i> Блоги</a></li>
        <li class="active">Фотографии</li>
        <li class="active">Список</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">СПИСОК ФОТОГРАФИЙ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br />
                    <form id="add_image_form">
                        <div class="form-group" id="file_div">
                            <label class="userfile_label">Изображения </label>
                            <input type="file" name="userfiles[]" id="userfiles" class="file_inp" size="50" />
                        </div>
                        <button type="submit" name="AddBtn" class="btn btn-info">Добавить</button>
                    </form>
                    <br />
                    <table id="TableUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изображение</th>
                                <th>Аватар</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $item) : ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td style="text-align: center;width: 100px;"><a target="_blank" href="<?= $item['base_url'] ?>upload_blog/<?= $item['blog_pic'] ?>"><img src="<?= $item['base_url'] ?>upload_blog/<?= $item['blog_pic'] ?>" style="width: 100px;" /></a></td>
                                    <td style="text-align: center;width: 100px;">
                                        <input id="blog_avatar_checkbox<?= $item['id'] ?>" type="checkbox" onclick="change_blog_avatar(<?= $item['id'] ?>)" <?php if ($item['blog_avatar'] == 1) echo 'checked="checked"'; ?> <?php if ($total_avatar_in_blog >= 1 && !($item['blog_avatar'] != 0)) echo 'disabled' ?>>
                                    </td>
                                    <td style="text-align: center;width: 100px;"> <a class="confirmation" href="<?= $item['base_url'] ?>index.php/Admin/blogImages/<?= $blog['id']?>?do=remove&blog_image_id=<?= $item['id'] ?>"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="{base_url}plugins/kendo-upload-ui/js/kendo.all.min.js"></script>
<script src="{base_url}plugins/kendo-upload-ui/js/kendo.messages.ru-RU.min.js"></script>
<script>
    var blog_pics = [];

    // $(function() {
    //     $('#TableUser').DataTable({
    //         "paging": false,
    //         "lengthChange": false,
    //         "searching": false,
    //         "ordering": false,
    //         "info": false,
    //         "autoWidth": false
    //     });
    // });

    function change_blog_avatar(id) {
        var checked = 0;
        if ($('#blog_avatar_checkbox' + id).is(':checked')) {
            checked = 1;
        } else {
            checked = 0;
        }
        $.getJSON("<?= base_url() ?>index.php/admin/changeBlogAvatar?stat=" + checked + "&id=" + id, function(data, status) {
            if (data == 1) {
                location.reload();
            }
        });
    }

    function onUpload(e) {
        var files = e.files;
        e.data = {
            fileDescription: 'hello'
        };
        var upload = $("#userfiles").data("kendoUpload"),
            files2 = upload.getFiles();
        checkFilesForEmpty();
    }

    function onSuccess(e) {
        var obj = {
            name: e.files[0].name,
            uid: e.files[0].uid,
            file: e.response.file
        };
        $('.k-file-name').css('color', 'green');
        $('.k-file-size').css({
            'cssText': 'display:block !important'
        });

        if (e.operation != 'remove') {
            blog_pics.push(obj);
        }
        checkFilesForEmpty();
    }

    function onRemove(e) {
        e.data = {
            uid: e.files[0].uid
        };
        blog_pics.forEach(function(el, i) {
            if (el.uid == e.files[0].uid) {
                blog_pics.splice(i, 1);
            }
        });
        checkFilesForEmpty();
    }

    function onError(e) {
        var files = e.files;

        if (e.operation == "upload") {
            uploadFailed = true;
        }
        checkFilesForEmpty();
    }

    function checkFilesForEmpty() {
        if (blog_pics.length > 0) {
            isFileEmpty = false;
        } else {
            isFileEmpty = true;
        }
    }

    $(document).ready(function() {
        $("#add_image_form").submit(function(e) {
            if (blog_pics.length != 0) {
                e.preventDefault()
                $.post("<?= $base_url; ?>index.php/admin/addBlogImage/<?= $blog['id'] ?>", {
                    "blog_images": blog_pics,
                    "AddBtn": true
                }, function(data) {
                    if (data == 1) {
                        location.href = "<?= $base_url?>index.php/admin/blogImages/<?= $blog['id'] ?>?do=addok";
                    }
                }, "json");
            } else {
                return false;
            }
        });
        $("#userfiles").kendoUpload({
            async: {
                saveUrl: "{base_url}index.php/main/blog_pictures_upload?type=save",
                removeUrl: "{base_url}index.php/main/blog_pictures_upload?type=remove",
                chunkSize: 110000000000, // bytes
                concurrent: true,
                autoUpload: true
            },
            localization: {
                dropFilesHere: '',
                uploadFail: 'Файл(ы) не удалось загрузить.',
                uploadSuccess: '',
                invalidFileExtension: 'Тип файла не разрешен.',
                invalidFiles: 'Недопустимый файл(ы). Пожалуйста, проверьте требования к загрузке файлов.',
                invalidMaxFileSize: 'Слишком большой размер файла.',
                invalidMinFileSize: 'Размер файла слишком мал.'

            },
            upload: onUpload,
            success: onSuccess,
            remove: onRemove,
            error: onError
        });

    });
</script>