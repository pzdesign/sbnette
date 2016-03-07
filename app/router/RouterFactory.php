<?php

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\SimpleRouter;

class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;
/*

		$router[] = new Route('novinky/', 'Novinky:default');
		$router[] = new Route('novinky/menu', 'Novinky:listek');
		$router[] = new Route('novinky/dnesni-nabidka', 'Novinky:dnesni');
		$router[] = new Route('novinky[/<id>]', 'Novinky:show');

		$router[] = new Route('akce/', 'Akce:default');
		$router[] = new Route('akce/create', 'Akce:create');
		$router[] = new Route('akce/edit', 'Akce:edit');

		$router[] = new Route('akce[/<id>]', 'Akce:show');
*/
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Novinky:default');


		return $router;
	}

}
