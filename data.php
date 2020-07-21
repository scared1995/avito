<?php

class Card
{
    public $file;
    public $taskList;

    public function __construct()
    {


    }


//проверка карты по алгоритму Луна
    public function checkCard($card)
    {
        function check_cc($cc, $extra_check = false) //Функция проверки карты по алгоритму Луна
        {
            $cards = array(
                "visa" => "(4\d{12}(?:\d{3})?)",
                "amex" => "(3[47]\d{13})",
                "jcb" => "(35[2-8][89]\d\d\d{10})",
                "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
                "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
                "mastercard" => "(5[1-5]\d{14})",
                "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
            );
            $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
            $matches = array();
            $pattern = "#^(?:" . implode("|", $cards) . ")$#";
            $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
            if ($extra_check && $result > 0) {
                echo "1" . "</br>";/*$result = (validatecard($cc))?1:0;*/
            }
            return ($result > 0) ? $names[sizeof($matches) - 2] : false;
        }

        if (check_cc($card)) {// проверяем на ввод значений и проверка значение по Алгоритму Луна
            header("Location: payments/card.php");

        }

    }

    public function insert($e){
        if ($e) {//
            $file = file_get_contents('../src/file/jsonFile.json');  // Открыть файл data.json
            $card = $_SESSION["card"];
            $purposePayment = $_SESSION['purposePayment'];
            $sum = $_SESSION['sum'];
            $date = date("d.m.Y H:i:s");

            $taskList = json_decode($file, TRUE);        // Декодировать в массив
            $taskList[] = array(
                'card' => $card,
                'purposePayment' => $purposePayment,
                'sum' => $sum,
                'date' => $date
            );        // Представить новую переменную как элемент массива, в формате 'ключ'=>'имя переменной'

            file_put_contents('../src/file/jsonFile.json', json_encode($taskList));  // Перекодировать в формат и записать в файл.

            unset($taskList);
        }
    }


}

$card = new Card();
$card->checkCard($_GET['card']);
$card->insert($_POST['submit']);

