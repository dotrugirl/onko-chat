<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("������ ������������� �����"),
	"DESCRIPTION" => GetMessage("������� ������ ������������� �����"),
	"ICON" => "/images/icon.gif",
	"PATH" => array(
		"ID" => "dotrusite",
        "NAME" => "������ �������������",
		"CHILD" => array(
			"ID" => "userlist",
			"NAME" => "������ ������������� �����"
		)
	),
);
?>