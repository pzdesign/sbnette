<?php
namespace App\Components;
use Nette\Application\UI;

mb_internal_encoding("UTF-8");



class CalendarControl extends UI\Control
{
	private $monthNames = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec',
									'srpen', 'září', 'říjen', 'listopad', 'prosinec');



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

	public function render()
	{
		$template = $this->template;

		$template->render(__DIR__ . '/CalendarControl.latte');
	}
}


