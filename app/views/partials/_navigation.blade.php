{{ Navbar::create(array(
), Navbar::FIX_TOP)
    ->with_brand("Patrick Rose", "/")
    ->autoroute(true)
    ->collapsible()
    ->with_menus(Navigation::links(
        array(
            array('Home', route('home')),
            array('About', route('about')),
            array('Blog', route('blog.index')),
        )
    ))
    ->with_menus(
          \PatrickRose\Helpers\Navigation::getLogin()
    )
}}