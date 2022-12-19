      <div id="main_div">
          <div id="confirm_div2">
              <?php if (!$isConfirmed) : ?>
                  <label for="confirm_inp2">Введите код</label>
                  <input max="4" type="number" id="confirm_inp2">
                  <p id="not_found">Не найдено</p>
                  <button class="btn btn-primary confirm_btn">
                      Подтвердить
                      <div class="spinner-border text-light" id="review_spinner" style="margin-left:10px;display:none" role="status">
                          <span class="sr-only">Loading...</span>
                      </div>
                  </button>
              <?php else : ?>
                  <i class="fa fa-check-square-o" id="success_icon"></i>
                  <h4 class="text-muted">Заказ успешно принят</h4>
              <?php endif; ?>
          </div>
      </div>

      <script src="{base_url}plugins/jquery-3.4.1.min.js"></script>

      </body>

      <script>
          $(document).ready(function() {
              $('#not_found').hide();
              $('.confirm_btn').on('click', function() {
                  $('#review_spinner').show();
                  $('.confirm_btn').attr('disabled', 'disabled');
                  var $this = $('#confirm_inp2');
                  $.getJSON("<?= base_url() ?>index.php/main/checkOrderCode", {
                      order_code: $this.val(),
                      order_id: <?= $order_id ?>,
                      order_phone: <?= $order_phone ?>
                  }, function(data, status) {
                      if (data.stat == 1) {
                        //   $.removeCookie('product_list', {
                        //       path: '/'
                        //   });
                        localStorage.removeItem("product_list")
                          $('#confirm_div2').html('');
                          var html =
                              "<i class=\"fa fa-check-square-o\" id=\"success_icon\"></i>" +
                              "<h4 class=\"text-muted\">Заказ успешен</h4>" +
                              "<p><strong>Товары</strong></p>" +
                              "<hr>";
                          var tot_sum = 0;
                          $.each(data.products, function(i, el) {
                              html += `<p style="text-align:start"><strong>${el.product_name}</strong><span style="margin-left:25px;float:right">${el.total_count}x${el.product_price} = ${el.total_count * el.product_price} смн.</span>`;
                              tot_sum += el.total_count * el.product_price;
                          });
                          html += "<hr>" +
                              `<p style="text-align:start"><strong>Итого: </strong><span style="float:right">${tot_sum} смн.</span></p>` +
                              "<button class=\"btn btn-primary\" onclick=\"go_to_main()\">Главный экран</button>";
                        //   change_order_status();
                          $('#confirm_div2').append(html);
                          $('#not_found').hide();
                      } else {
                          $('#review_spinner').hide();
                          $('.confirm_btn').removeAttr('disabled');

                          $('#not_found').show();
                      }
                  });
              });
          });

          function change_order_status() {
              $.ajax({
                  url: "<?= base_url() ?>index.php/api/changeOrderStatus",
                  type: "POST",
                  dataType: "json",
                  data: {
                      "order_id": <?= $order_id ?>,
                      "status_id": 1,
                  },
                  success: function(data) {}
              });
          }

          function preventBack() {
              window.history.forward();
          }
          setTimeout("preventBack()", 0);
          window.onunload = function() {
              null
          };

          function go_to_main() {
              var url = "<?= base_url() ?>";
              $(location).attr("href", url);
          }
      </script>