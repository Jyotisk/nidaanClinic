<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cesta Enterprise</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body>
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="{{url('/')}}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                @foreach($menuItems as $menuItem)
                                                @if(!$menuItem->parent_id)
                                                <li>
                                                    <a href="{{url($menuItem->url)}}" class="{{ Request::is($menuItem->url) ? 'active' : '' }}">{{$menuItem->title}}</a>
                                                    @if($menuItem->children->isNotEmpty())
                                                    <ul class="submenu">
                                                        @foreach($menuItem->children as $child)
                                                        @if($menuItem->title=="Services")
                                                        <li><a href="{{url('service/'.$child->url)}}">{{$child->title}}</a></li>
                                                        @elseif($menuItem->title=="Solutions")
                                                        <li><a href="{{url('solution/'.$child->url)}}">{{$child->title}}</a></li>
                                                        @elseif($menuItem->title=="Gallery")
                                                        <li><a href="{{url('gallery/'.$child->url)}}">{{$child->title}}</a></li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <main>
        {{ $slot }}
    </main>

  
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>
</body>

</html>
