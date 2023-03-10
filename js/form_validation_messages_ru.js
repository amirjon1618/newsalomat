/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: RU (Russian; русский язык)
 */

$.extend($.validator.messages, {
   required: "Это поле необходимо заполнить.",
   remote: "Введите правильное значение.",
   email: "Введите корректный адрес электронной почты.",
   url: "Введите корректный URL.",
   date: "Введите корректную дату.",
   dateISO: "Введите корректную дату в формате ISO.",
   number: "Введите число.",
   digits: "Вводите только цифры.",
   name: "Вводите имя",
   creditcard: "Введите правильный номер кредитной карты.",
   equalTo: "Введите такое же значение ещё раз.",
   extension: "Выберите файл с правильным расширением.",
   maxlength: $.validator.format("Введите не более {0} символов."),
   minlength: $.validator.format("Введите не менее {0} символов."),
   rangelength: $.validator.format(
      "Введите значение длиной от {0} до {1} символов."
   ),
   range: $.validator.format("Введите число от {0} до {1}."),
   max: $.validator.format("Введите число, меньшее или равное {0}."),
   min: $.validator.format("Введите число, большее или равное {0}."),
});
