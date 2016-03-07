<?php
header('Content-type: text/html; charset=utf8');
mb_internal_encoding("UTF-8");

mysql_connect('localhost', 'root', '');
mysql_select_db('a');

class Calendar
{
	private $monthNames = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec',
									'srpen', 'září', 'říjen', 'listopad', 'prosinec');

	public function printSoonEvents()
	{
		$result = mysql_query('SELECT `event_id`, `name`, DATE_FORMAT(`date`, "%e. %m. %Y") AS `date`
								FROM `calendar`
								WHERE `date` BETWEEN CURDATE() AND CURDATE() + INTERVAL 7 DAY
								ORDER BY `date` ASC
							');

		echo('Brzké události:');
		while ($event = mysql_fetch_assoc($result))
		{
			echo('<p>
					<a href="?edit=' . $event['event_id'] . '">
						' . $event['date'] . ': ' . $event['name']. '
					</a>
				</p>');
		}

	}

	/**
	 * Vypíše kalendářní měsíc
	 * @param null $month - kalendářní měsíc, který se má vypsat
	 * @param null $year
	 */
	public function renderCalendar($month = null, $year = null)
	{
		// kontrola platnosti data
		if (!checkdate($month, 1, $year))
		{
			$month = null;
			$year = null;
			echo('Neexistující datum. Vypisuji současný měsíc.');
		}

		// pokud datum není zadané
		if (empty($year))
			$year = idate("Y");

		if (empty($month))
			$month = idate('m');

		$today = idate("d");

		// hlavička kalendáře
		echo('
			<table id="calendar">
				<tr>
					<th colspan="7">' .
						// měsíc slovně -> první písmeno velké - bere i s diakritikou
						mb_convert_case($this->monthNames[$month], MB_CASE_TITLE, 'UTF-8') . ' ' . $year
				. '</th>
				</tr>
				<tr id="calendar-dayrow">
					<td>Po</td><td>Út</td><td>St</td><td>Čt</td><td>Pá</td><td>So</td><td>Ne</td>
				</tr>
				<tr>');

		// počet dnů pro daný měsíc v roce
		$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		// zjištění začátku týdne
		$weekDay = idate("w", mktime(0, 0, 0, $month, 1, $year));
		if ($weekDay == 0) // začíná nedělí, ta je u nás však 7., 0. pozici vynecháme
			$weekDay = 7;

		// vynecháme místo
		for ($i = $weekDay; $i > 1; $i--)
			echo('<td>&nbsp;</td>');

		// vypsání jednotlivých dnů
		for ($day = 1; $day <= $daysInMonth; $day++)
		{
			echo('<td');
			// pokud je aktuální měsíc a rok, označí se den -> lze pak zvýraznit pomocí css
			if (($day == $today) && ($month == idate('m')) && ($year == idate('Y')))
				echo(' id="calendar-today" ');
			echo('>');

			echo('<a href="?show=' . $year . '-' . $month . '-' . $day . '">' . $day . '</a>');

			// řádkování podle týdnů
			if (($weekDay % 7) == 0)
				echo('</tr><tr>');

			$weekDay++;
			if ($weekDay > 7)
				$weekDay = 1;
		}

		$previousMonth = ($month - 1) > 0 ? $month - 1 : 12;
		$nextMonth = ($month % 12) + 1;

		$previousYear = $previousMonth > $month ? $year - 1 : $year;
		$nextYear = $nextMonth < $month ? $year + 1 : $year;

		// navigace
		echo('
				</tr>
				<tr>
					<td colspan="4">
						<a href="?date=' . $previousYear . '-' . $previousMonth . '">
							' . $this->monthNames[$previousMonth] . '
						</a>
					</td>
					<td colspan="4" align="right">
						<a href="?date=' . $nextYear . '-' . $nextMonth . '">
							' . $this->monthNames[$nextMonth] . '
						</a>
					</td>
				</tr>
			</table>
		');
	}

	/**
	 * vypsání formuláře pro přidání události
	 * @param $year
	 * @param $month
	 * @param $day
	 */
	public function renderEventAdd($year, $month, $day)
	{
		// kontrola data
		if (!checkdate($month, $day, $year))
		{
			$year = idate('Y');
			$month = idate('m');
			$day = idate('d');
			echo('Datum není platné. Nastavuji dnešní.');
		}

		// přeformátování 2012-7-16 -> 2012-07-16
		$date = date_create_from_format('Y-n-j', $year . '-' . $month . '-' . $day)->format('Y-m-d');

		echo('Datum:' . $day . '. ' . $month . '. ' . $year);

		$result = mysql_query('SELECT `event_id`, `name`
								FROM `calendar`
								WHERE `date` = "' . mysql_real_escape_string($date) . '"
							');
		// vypsání existujících událostí k tomuto datu
		while ($event = mysql_fetch_assoc($result))
		{
			echo('<p>
					<a href="?edit=' . $event['event_id'] . '">' . $event['name'] . '</a>
					<a href="?delete=' . $event['event_id'] . '">( X )</a>
				</p>'
				);
		}

		echo('
			<form method="post">
				<input type="text" name="event_name" placeholder="Název údálosti" /><br />
				<input type="date" name="event_date" value="' . $date . '" /><br />
				<textarea name="event_description" placeholder="Popis události"></textarea><br />
				<input type="submit" name="add_event" value="Přidat" />
			</form>
		');
	}

	/**
	 * vypsání formuláře pro editaci události
	 * @param $eventId
	 */
	public function renderEditEvent($eventId)
	{
		$result = mysql_query('SELECT * FROM `calendar`
								WHERE `event_id` = ' . mysql_real_escape_string($eventId));

		// vezme pole, které vrátí db -> { ['name'] => "Jméno události", ['date'] => "yyyy-mm-dd", ... }
		// a nahraje je do proměnných -> $name = "Jméno události", $date = ...
		extract(mysql_fetch_assoc($result));

		echo('
			<form method="post">
				<input type="text" name="event_name" placeholder="Název údálosti" value="' . $name . '" /><br />
				<input type="date" name="event_date" value="' . $date . '" /><br />
				<textarea name="event_description" placeholder="Popis události">' . $description . '</textarea><br />
				<input type="hidden" name="event_id" value="' . $eventId . '" />
				<input type="submit" name="edit_event" value="Upravit" />
			</form>
		');
	}

	/**
	 * Přidání události do db
	 * @param $eventName -> Název události
	 * @param $eventDate -> datum Y-m-d -> 2012-07-16
	 * @param $eventDescription -> Popis události -> délka "neomezená"
	 */
	public function addEvent($eventName, $eventDate, $eventDescription)
	{
		// načte z pole 2012-7-16 -> { [0] => 2012, [1] => 7, [2] => 16 } do daných proměnných v daném pořadí
		list($year, $month, $day) = explode('-', $eventDate);
		if (checkdate($month, $day, $year))
		{
			// ošetření injekce
			$eventName = mysql_real_escape_string($eventName);
			$eventDate = mysql_real_escape_string($eventDate);
			$eventDescription = mysql_real_escape_string($eventDescription);

			mysql_query('INSERT INTO calendar(name, date, description)
							VALUES("' . $eventName . '", "' . $eventDate . '", "' . $eventDescription . '")
						');
		}
		else
			echo('Chybné datum!');
	}

	/**
	 * Editace dané události
	 * @param $eventId
	 * @param $eventName -> Název události
	 * @param $eventDate -> datum Y-m-d -> 2012-07-16
	 * @param $eventDescription -> Popis události -> délka "neomezená"
	 */
	public function editEvent($eventId, $eventName, $eventDate, $eventDescription)
	{
		list($year, $month, $day) = explode('-', $eventDate);
		if (checkdate($month, $day, $year))
		{
			$eventId = mysql_real_escape_string($eventId);
			$eventName = mysql_real_escape_string($eventName);
			$eventDate = mysql_real_escape_string($eventDate);
			$eventDescription = mysql_real_escape_string($eventDescription);

			mysql_query('UPDATE `calendar`
							SET `name` = "' . $eventName . '",
								`date` = "' . $eventDate . '",
								`description` = "' . $eventDescription . '"
							WHERE `event_id` = ' . $eventId . '
						');
			echo('Editováno!');
		}
		else
			echo('Chybné datum!');
	}

	/**
	 * Smazání dané události
	 * @param $eventId
	 */
	public function deleteEvent($eventId)
	{
		mysql_query('DELETE FROM `calendar`
						WHERE `event_id` = ' . mysql_real_escape_string($eventId));
		echo('Smazáno!');
	}
}


$c = new Calendar();

// vkládání do db
if (isset($_POST['add_event']))
	$c->addEvent($_POST['event_name'], $_POST['event_date'], $_POST['event_description']);
// editace v db
else if (isset($_POST['edit_event']))
	$c->editEvent($_POST['event_id'], $_POST['event_name'], $_POST['event_date'], $_POST['event_description']);

// přidání + vypsání událostí pro dané datum
if ((isset($_GET['show'])) && ($_GET['show']))
{
	list($year, $month, $day) = explode('-', $_GET['show']);
	$c->renderEventAdd($year, $month, $day);
}
// editace vybrané události
else if ((isset($_GET['edit'])) && ($_GET['edit']))
	$c->renderEditEvent($_GET['edit']);
// smazání vybrané události
else if ((isset($_GET['delete'])) && ($_GET['delete']))
	$c->deleteEvent($_GET['delete']);
// vypsání kalendáře pro daný měsíc
else
{
	$month = idate('m');
	$year = idate('Y');

	if ((isset($_GET['date'])) && ($_GET['date']))
		list($year, $month) = explode('-', $_GET['date']);

	$c->printSoonEvents();
	$c->renderCalendar($month, $year);
}