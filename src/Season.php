<?php

namespace PHPUBG;

use PHPUBG\traits\HasDisplayString;
use PHPUBG\traits\IsUnique;

class Season implements \JsonSerializable {
	use IsUnique, HasDisplayString;

	const EARLY_ACCESS_1 = 1;
	const EARLY_ACCESS_2 = 2;
	const EARLY_ACCESS_3 = 3;

	/** @var string A string identifier; not to confuse with the id! */
	protected $seasonIdentifier;

	/**
	 * Season constructor.
	 *
	 * @param int    $id               The id of this season.
	 * @param string $seasonIdentifier The identifier for a season.
	 * @param string $display          The string to be displayed for this season.
	 *
	 * @throws \InvalidArgumentException If a season with the specified id already exists.
	 */
	public function __construct(int $id, string $seasonIdentifier, string $display) {
		$this->id = $id;
		$this->seasonIdentifier = $seasonIdentifier;
		$this->display = $display;

		self::add($this);

		if (is_null(self::$uniqueProperty))
			self::$uniqueProperty = "seasonIdentifier";
	}

	/**
	 * Specify data which should be serialized to JSON
	 *
	 * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	function jsonSerialize() {
		return [
			'id' => $this->id,
			'identifier' => $this->seasonIdentifier,
			'display' => $this->display
		];
	}
}

new Season(Season::EARLY_ACCESS_1, "2017-pre1", "Early Access Season #1");
new Season(Season::EARLY_ACCESS_2, "2017-pre2", "Early Access Season #2");
new Season(Season::EARLY_ACCESS_3, "2017-pre3", "Early Access Season #3");