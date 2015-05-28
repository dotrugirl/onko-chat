<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("Список пользователей сайта"),
	"DESCRIPTION" => GetMessage("Выводим список пользователей сайта"),
	"ICON" => "/images/icon.gif",
	"PATH" => array(
		"ID" => "dotrusite",
        "NAME" => "Список пользователей",
		"CHILD" => array(
			"ID" => "userlist",
			"NAME" => "Список пользователей сайта"
		)
	),
);
?>