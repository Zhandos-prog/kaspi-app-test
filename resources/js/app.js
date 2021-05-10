require('./bootstrap');
$(document).ready(function () {
    // показываем/скрываем меню
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    //отмечаем все чекбоксы
    $('.all-checked').click(function () {
        $('.form-check-input').each(function () {
            if($(this).attr('checked') !== 'checked') {
                $(this).attr('checked',true)
            }else {
                $(this).attr('checked',false);
            }
        });
    })

    // поиск в таблице
    $("#myInput").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#equipment tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
})
