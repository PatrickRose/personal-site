{{ Navbar::create(array(
), Navbar::FIX_TOP)
    ->with_brand("Patrick Rose", "/")
    ->autoroute(true)
    ->collapsible()
    ->with_menus(Navigation::links(
        array(
            array('Home', route('home')),
            array('About', route('about')),
            array('Gigs', route('gigs')),
            array('Blog', route('blog.index')),
            array('Tags', route('tag.index')),
            array('Shop', route('shop.index'))
        )
    ))
    ->with_menus(
          \PatrickRose\Helpers\Navigation::getLogin(),
          array('class' => 'navbar-right')
    )
}}