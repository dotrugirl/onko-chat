<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_DETAIL"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_DESC_DETAIL_DESC"),
	"ICON" => "/images/icon.gif",
        "SORT" => 30,
	"PATH" => array(
		"ID" => "dotrusite",
		"CHILD" => array(
			"ID" => "user",
			"NAME" => GetMessage("T_IBLOCK_DESC_USERS")
		)
	),
);
?>