<!-- Content Header (Page header) -->

<script>

	function update_value()

	{

		$("#news_text2").val($("#news_text").html());

	}

	

	function uploadFile()

	{

			if(!$("#fileToUpload").val().length>0)

				return false;

			

			var sfile = document.getElementById("fileToUpload").files[0];

			//var alt_name =  document.getElementById("alt_name"+idFile).value; // $("#alt_name"+id).val();

			$("#fileToUpload").hide();

			

			$("#progress_bar").show();

			$("#progress_bar").width("0");


			if(sfile!=undefined)

			{

					//$("#file_upload_div_1").hide();

					//$("#file_upload_div_2").show();

					//disabledAllDiv();



					var form_data = new FormData();                  

					form_data.append('fileToUpload', sfile);

					$.ajax({

							xhr: function() {

									var xhr = new window.XMLHttpRequest();



									xhr.upload.addEventListener("progress", function(evt) {

									if (evt.lengthComputable) {

											var percentComplete = evt.loaded / evt.total;

											percentComplete = parseInt(percentComplete * 100);


											$("#progress_bar").html(percentComplete+"%");

											$("#progress_bar").width(percentComplete+"%");

											if (percentComplete === 100) {


											}

									}

									}, false);



									return xhr;

							},

							type: "POST",

							url: "{base_url}admin/uploadFile/0",

							error: errorHandler,

							data: form_data,

							processData: false,

							contentType: false,

							//contentType: 'multipart/form-data', 

							//mimeType: 'multipart/form-data'



					}).done(function( msg ) {

							completeHandler(msg);

					}).always(function(){
							$("#progress_bar").hide();

							$("#fileToUpload").val("");

					});

			}

			else

			{

					

			}

	}



	function errorHandler()

	{

			alert('Ошибка повторите позже');

			showUploadButton();

	}

	function completeHandler(d)

	{

		showUploadButton();



		var r = d.split('|');

		if(r[1]!="0")

			insertToDivImg(r[0],r[1], r[2], r[3]);

		else

			alert("Ошибка: "+r[0])

	}



	function showUploadButton()

	{

			$("#fileToUpload").show();

	}



	function removeImg(id)

	{

		$.get( base_url+"admin/removeImg/"+id, function( data ) {

			if(data=="ok")

				$("#img_div_"+id).remove();

		});

	}



	var base_url = "{base_url}";

	function insertToDivImg(img, id, w, h)

	{

		$("#img_list").append('<div id="img_div_'+id+'" class="col-md-4"><input type="hidden" value="'+id+'" name="file_img[]" /><input type="hidden" value="'+img+'" id="file_'+id+'" /><img src="'+base_url+img+'" class="img-responsive showed" id="img_'+id+'" w="'+w+'" h="'+h+'"  onclick="chosePoster('+id+')" ondblclick="insertImg('+id+', '+w+', '+h+')" /><button type="button" onclick="removeImg('+id+')" class="btn btn-default">Удалить</button></div>');

	}



	var timer = 0;

	var delay = 200;

	var prevent = false; 



	function insertImg(id, w, h)

	{

			clearTimeout(timer);

			prevent = true;

			

			document.getElementById('news_text').focus();

			pasteHtmlAtCaret2('<img src="'+base_url+$("#file_"+id).val()+'" id="img2_'+id+'" w="'+w+'" h="'+h+'" style="width: 100%" />');

	}



	function chosePoster(id)

	{

		timer = setTimeout(function() {

			if (!prevent) {

				var img = base_url+$("#file_"+id).val();

				$("#poster").attr("src", img);

				$("#news_poster").val(img);

			}

			prevent = false;

		}, delay);

		

	}







	function pasteHtmlAtCaret2(html) {

    var sel, range;

    if (window.getSelection) {

        // IE9 and non-IE

        sel = window.getSelection();

        if (sel.getRangeAt && sel.rangeCount) {

            range = sel.getRangeAt(0);

            range.deleteContents();



            // Range.createContextualFragment() would be useful here but is

            // non-standard and not supported in all browsers (IE9, for one)

            var el = document.createElement("div");

            el.innerHTML = html;

            var frag = document.createDocumentFragment(), node, lastNode;

            while ( (node = el.firstChild) ) {

                lastNode = frag.appendChild(node);

            }

            range.insertNode(frag);

            

            // Preserve the selection

            if (lastNode) {

                range = range.cloneRange();

                range.setStartAfter(lastNode);

                range.collapse(true);

                sel.removeAllRanges();

                sel.addRange(range);

            }

        }

    } else if (document.selection && document.selection.type != "Control") {

        // IE < 9

        document.selection.createRange().pasteHTML(html);

    }

}

     $(function () {

				{img_list_tmp}

				//insertToDivImg(img, id, w, h)

					insertToDivImg('{img_link}', {id}, {w},{h});

				{/img_list_tmp}



			$("#category_id").val("{category_id}")



      });



      function submit_form()

			{

				

				update_value();

				$("#AddBtn").click();

			}

    </script>

    <link rel="stylesheet" href="{base_url}plugins/iCheck/all.css">   

	<section class="content-header">

	  <h1>

	   <br />

	  </h1>

	  <ol class="breadcrumb">

		<li><a href="{base_url}"><i class="fa fa-dashboard"></i> Главная</a></li>

		<li class="active">Изменить</li>

	  </ol>

	</section>

	 {alert}

	 

	<!-- Main content -->

	<section class="content">

	  <div class="row">

		<!-- left column -->

		<div class="col-md-12">

		  <div class="box box-primary">

				<div class="box-header with-border">

					<h3 class="box-title">Изменить</h3>

				</div><!-- /.box-header -->

				<div class="row">

				<form action="" method="post" onsubmit="" id="form1" role="form">

					<div class="col-md-6">

						

							<div class="box-body pad">

								<div class="form-group">

									<label>Название:</label>

									<input type="text" maxlength="150" value="{news_title}" class="form-control" name="news_title" id="news_title" placeholder="Title">

									

								</div>

								<div class="form-group">

									<label>Категория:</label>

									<select id="category_id" class="form-control" name="category_id">

										<option value="0">Без категории</option>

										{category_list}

										<option value="{id}">{category_name}</option>

										{/category_list}

									</select>

								</div>

								<div class="form-group">

									<label>Постер:</label>

									<input type="hidden" name="news_poster" value="{news_poster}" id="news_poster" />

									<img class="img-responsive" src="{news_poster}" id="poster"  />

								</div>

								<div class="form-group">

									<label>Коротко:</label>

									<input type="text" maxlength="250" value="{news_text_cut}" class="form-control" name="news_text_cut" id="news_text_cut" placeholder="Cut">

								</div>

								<div class="form-group">

									<label>Текст:</label><br />

									<input type="hidden" name="news_text" id="news_text2" />

									<div  class="scrollbars" id="news_text" style="padding: 3px;border-color: #dcd7d7;background-color: white;border-width:1px;border-style:solid;width: 100%;height: 600px;" contenteditable="true">{news_text}</div>

								</div>

								<div class="box-footer">

									<button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/articles'" class="btn btn-default">Cancel</button>

									<input type="submit" id="AddBtn" name="AddBtn" value="Create" style="display: none" />

									<input type="button" onclick="submit_form()" name="AddBtn1" value="Сохранить" class="btn btn-primary pull-right" />

								</div>

							</div>

						

					</div>

					<style>

					div.scrollbars {

							overflow: auto;

					}

					.img-responsive{

						padding-top: 15px;

					}

					.showed

					{

						border-color: white;

						border-width: 2px;

						border-style: solid;

					}

					.showed:hover

					{

						border-color: #b5b6b9;

					}

					</style>

					<div class="col-md-6">

						<div class="box-body pad">

							<div class="row">

								<label>Imgs:</label>

								<div id="img_list">

								

								</div>

								<div class="col-md-12">

									<br />

									<div class="progress-bar bg-success" id="progress_bar" style="width: 0%;" role="progressbar"></div>

									<br />

									<br />

									<input type="file" class="form-control form-control-file" onchange="uploadFile()" name="fileToUpload" id="fileToUpload" />

									<br />

									<button style="display: none;" type="button" class="btn btn-info btn-lg btn-block">Upload</button>

								</div>

							</div>

						</div>

					</div>

					</form>

				</div>

		  </div><!-- /.box -->

		</div><!-- /.col -->

	  </div><!-- /.row -->

	</section><!-- /.content -->

	

	<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script src="{base_url}plugins/iCheck/icheck.min.js"></script>

	