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
            array('Shop', '#', false, false,
                  array(
                      array('Browse', route('shop.index')),
                      array('Basket ' . Badge::normal(count(Session::get('basket'))), route('shop.basket'),null,null,null,null,null,false)
                  ))
        )
    ))
    ->with_menus(
          \PatrickRose\Helpers\Navigation::getLogin(),
          array('class' => 'navbar-right')
    )
}}