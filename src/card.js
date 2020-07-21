
getPagination('#myTable');


function getPagination(table) {
    var lastPage = 1;

    $('#maxRows').on('change', function (evt) {//функция для переключения кол-во отображаемых строк
        lastPage = 1;
        $('.pagination')
            .find('li')//находим все элементы списка на странице
            .slice(1, -1)//метод уменьшения или увеличения элементов
            .remove();//удаляем лишние цифры
        var trnum = 0; // обнуляем счетчик tr
        var maxRows = parseInt($(this).val()); // получаем максимальное кол-во строк из опции select
        var totalRows = $(table + ' tbody tr').length; // кол-во строк таблицы

        if (maxRows >= totalRows) { //если макс. кол-во строк будет больше или равно кол-во строк в таблице,то скрыаем пагинацию
            $('.pagination').hide();
        } else {
            $('.pagination').show();
        }

        $(table + ' tr:gt(0)').each(function () {
            trnum++; // запускаем счетчик
            if (trnum > maxRows) { // если номер  tr больше  maxRows
                $(this).hide(); // то скрываем их
            }
            if (trnum <= maxRows) { //если меньше
                $(this).show();// то показать
            }
        });
        if (totalRows > maxRows) {
            // if tr total rows gt max rows option если кол-во строк tr больше кол-во стро select
            var pagenum = Math.ceil(totalRows / maxRows); // округляем вверх результат деления
            //	номера страниц
            for (var i = 1; i <= pagenum;) {
                // для каждой страницы пагинации добавлять элеменn li
                $('.pagination #prev')
                    .before(
                        '<li data-page="' + i + '">\
                                          <span>' + i++ + '<span class="sr-only btn btn-secondary">(current)</span></span>\
                                        </li>'
                    )
                    .show();
            }
        }
        $('.pagination [data-page="1"]').addClass('active'); // добавляем класс active для первого  li
        $('.pagination li').on('click', function (evt) { //по клику на каждую страницу

            evt.stopImmediatePropagation();//прекращаем текущее событие
            evt.preventDefault();// отменяем действие события по умолчанию
            var pageNum = $(this).attr('data-page'); // получаем номер страницы

            var maxRows = parseInt($('#maxRows').val()); // получаем максимальное кол-во строк из опции select

            if (pageNum == 'prev') {
                if (lastPage == 1) {
                    return;
                }
                pageNum = --lastPage;
            }
            if (pageNum == 'next') {
                if (lastPage == $('.pagination li').length - 2) {
                    return;
                }
                pageNum = ++lastPage;
            }

            lastPage = pageNum;
            var trIndex = 0;
            $('.pagination li').removeClass('active'); // добавляем класс active для всех  li
            $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // добавляем класс эктив по клику

            limitPagging();
            $(table + ' tr:gt(0)').each(function () {//для каждого tr в таблице

                trIndex++; //
                if (
                    trIndex > maxRows * pageNum ||
                    trIndex <= maxRows * pageNum - maxRows
                ) {
                    $(this).hide();
                } else {
                    $(this).show();
                } //else fade in
            });
        });
        limitPagging();
    })
        .val(5)
        .change();

}
//функция лимита страниц
function limitPagging() {


    if ($('.pagination li').length > 7) {
        if ($('.pagination li.active').attr('data-page') <= 3) {
            $('.pagination li:gt(5)').hide();
            $('.pagination li:lt(5)').show();
            $('.pagination [data-page="next"]').show();
        }
        if ($('.pagination li.active').attr('data-page') > 3) {
            $('.pagination li:gt(0)').hide();
            $('.pagination [data-page="next"]').show();
            for (let i = (parseInt($('.pagination li.active').attr('data-page')) - 2); i <= (parseInt($('.pagination li.active').attr('data-page')) + 2); i++) {
                $('.pagination [data-page="' + i + '"]').show();

            }

        }
    }
}

$(function () {//функция добавления id для каждой строки

    $('table tr:eq(0)').prepend('<th> ID </th>');

    var id = 0;

    $('table tr:gt(0)').each(function () {
        id++;
        $(this).prepend('<td>' + id + '</td>');
    });
});