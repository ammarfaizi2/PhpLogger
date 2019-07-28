<?php

namespace PhpLogger;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @version 1.0.0
 * @package \PhpLogger
 */
final class Logger
{
	/**
	 * @var array
	 */
	private static $stream = [];

	/**
	 * @var int
	 */
	private static $verboseLevel = 1;

	/**
	 * @param array $stream
	 * @return void
	 */
	public static function initLogger(array $stream = []): void
	{
		self::$stream = $stream;
	}

	/**
	 * @param int $verboseLevel
	 * @return int
	 */
	public static function setVerboseLevel(int $verboseLevel): void
	{
		self::$verboseLevel = $verboseLevel;
	}

	/**
	 * @param string $format
	 * @param mixed  ...$args
	 * @return void
	 */
	public static function log(int $verboseLevel, string $format, ...$args): void
	{
		if (self::$verboseLevel < $verboseLevel) {
			return;
		}

		foreach (self::$stream as $res) {
			fprintf(
				$res, "[%s]: %s\n",
				date("Y-m-d H:i:s"),
				vsprintf($format, $args)
			);
			fflush($res);
		}
	}	
}
