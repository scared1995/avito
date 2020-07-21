window.onload = function () {

    var cardSum = document.getElementById('card-sum');
    var card = document.getElementById('card');

    //Ограничиваем ввод символов карты и делаем пробел просле каждого 4
    for (var i in ['input', 'change', 'blur', 'keyup']) {
        card.addEventListener('input', formatCardCode, false);
    }

    function formatCardCode() {
        var cardCode = this.value.replace(/[^\d]/g, '').substring(0, 16);
        cardCode = cardCode != '' ? cardCode.match(/.{1,4}/g).join(' ') : '';
        this.value = cardCode;
    }

    //В поле сумма разрешаем вводить только цифры
    cardSum.addEventListener('keydown', e => {
        let isNumber = !isNaN(parseInt(event.key));       // условие, дающее true если это чиcло ;
        if (!isNumber) {
            e.preventDefault();
        }
    });




};

