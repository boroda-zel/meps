function function1(name)
{//Получаем параметры
var data = $('#choose').serializeArray()
  // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: name+'.php',
                data: data,
                // Выводим то что вернул PHP
                success: function(html) {
 //предварительно очищаем нужный элемент страницы
                        $("#result").empty();
//и выводим ответ php скрипта
                        $("#result").append(html);
                }
        });
return false;
}
