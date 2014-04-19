{{ Navbar::create(array(
), Navbar::FIX_TOP)
    ->with_brand("Patrick Rose", "/")
    ->autoroute(true)
    ->collapsible()
    ->with_menus(Navigation::links(
        \PatrickRose\Helpers\Navigation::getLogin()
    ))
}}