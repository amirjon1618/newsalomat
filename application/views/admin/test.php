<!-- Content Header (Page header) -->
		<style>
			.dataTables_filter
			{
				text-align: right;
			}
			.dataTables_filter input
			{
				margin-left: 10px;
			}
		</style>
        <section class="content-header">
          <h1>
           <br />
          </h1>
          <ol class="breadcrumb">
            <li><a href="{base_url}"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Пользователи</li>
          </ol>
        </section>
         {alert}
        <!-- Main content -->
        <section class="content">
         <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Пользователи</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
				  <input type="text" id="barcode" />
				  <div contenteditable></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		<style>
		[contenteditable]{ 
		  /* chroem bug: https://stackoverflow.com/a/24689420/104380 */
		  display:inline-block;
		  width: calc(100% - 40px);
		  min-height:120px; 
		  margin:10px;
		  padding:10px;
		  border:1px dashed green;
		}

		/* 
		 mark HTML inside the "contenteditable"  
		 (Shouldn't be any OFC!)'
		*/
		[contenteditable] *{
		  background-color:red;
		}
		</style>
	<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>

		function parse_text(text1, count, sum)
		{
			var ff = [];
			var ff2 = count+" x "+sum;
			var width = 44;
			var step = 30;
			var dd = Math.ceil(text1.length/step);


			var lastSpace = 0;
			var beginString = 0;
			var endString = 0;


				for(var d = 1;d<=dd;d++)
				{
					endString += step;
					
					lastSpace = Math.max(
						text1.lastIndexOf(' ', endString),
						text1.lastIndexOf('.', endString),
						text1.lastIndexOf(',', endString)
					);

					
					ff[ff.length] = text1.substring(beginString, lastSpace);
					beginString = lastSpace + 1;

				}
				
				var t = ff[ff.length-1];

				var f = width-t.length-ff2.length;

				for(var d = 1;d<=f;d++)
				{
					t+=" ";
				}
				t+= ff2;
				ff[ff.length-1] = t;

				var p = "";
				for(var d = 0; d<ff.length;d++)
				{
					p+=ff[d]+"\n";
				}

				return p;
		}
		
		$(document).keypress(function(event) {
		  if(event.key=="Enter")
		  {
			  
		  }
		});

		//	var textf = ne
		
			var object1 = {name: "Универсальное сетевое USB-зарядное устройство AIRON: ", count: "1", sum: "20.00"};
			var object2 = {name: "Беспроводная зарядка QI передатчик Fantasy Wireless Charge K9 Black:", count: "2", sum: "25.00"};
			var object3 = {name: "Беспроводной Qi AA приемник-ресивер Тип А: ", count: "1", sum: "30.00"};

			var text = [];
			text[text.length] = parse_text(object1.name, object1.count, object1.sum);
			text[text.length] = parse_text(object2.name, object2.count, object2.sum);
			text[text.length] = parse_text(object3.name, object3.count, object3.sum);


      </script>