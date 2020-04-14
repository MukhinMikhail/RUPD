<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/back/base.php");

function getInstituteValue($instituteData)
{
  if (!empty($instituteData)) {
    $data["status"] = 1;
    $data["value"] = (int) $instituteData;
  } else {
    $data["status"] = 2;
    $data["message"] = 'Ошибка запроса, проверьте корректно ли отравляются данные';
  }

  header('Content-type: application/json');
  echo json_encode($data);
}



getInstituteValue($_POST['institute']);
