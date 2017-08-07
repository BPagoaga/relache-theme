<?php 
class DateService
{
	const START_YEAR = 2015;

	public static function getToday()
	{
		return new DateTime();
	}

	public static function getYear()
	{
		return self::getToday()->format('Y');
	}
}