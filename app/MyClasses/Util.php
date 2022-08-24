<?php
namespace App\MyClasses;
class Util
{
	public static function mbTrim($pString)
	{
		return preg_replace('/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u', '', $pString);
	}
}
