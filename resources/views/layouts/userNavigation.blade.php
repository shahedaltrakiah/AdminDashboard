<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="icon" type="image/png" href="{{ URL::asset('images/logo-icon.png')}}">

    <title>Taste & Chef</title>

    <link href="{{ URL::asset('css/tastebite-styles.css')}}" rel="stylesheet" type="text/css" media="all">
</head>

<body>

<!-- Tstbite Section  -->
<section class="tstbite-section p-0">
    <div class="container">

        <!-- Tstbite Header, Bg White -->
        <header class="tstbite-header bg-white">
            <nav class="navbar navbar-expand-lg has-header-inner px-0">
                <a class="navbar-brand" href="/">
                    <img src="{{ URL::asset('images/logo.png')}}" style="max-width: 100px;" alt="Taste & Chef">
                </a>
                <div class="tstbite-header-links d-flex align-items-center ml-auto order-0 order-lg-2">
                    <a href="javascript:void(0);" class="search-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                             viewBox="0 0 26.667 26.667">
                            <path
                                d="M24.39,26.276l-4.9-4.9a12.012,12.012,0,1,1,1.885-1.885l4.9,4.9a1.334,1.334,0,0,1-1.886,1.886ZM2.666,12a9.329,9.329,0,0,0,15.827,6.7,1.338,1.338,0,0,1,.206-.206A9.332,9.332,0,1,0,2.666,12Z"/>
                        </svg>
                    </a>

                    <div class="dropdown">
                        <a href="{{ route('login') }}"  class="ml-4 ml-md-4 mr-2 mr-md-0 circle dropdown-toggle" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::check())
                                <!-- Show user's profile icon -->
                                <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('images/user.png') }}"
                                     alt="User Profile"
                                     class="rounded-circle"
                                     style="width: 40px;">
                            @else
                                <!-- Show login icon if user is not logged in -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="30" height="30"
                                     viewBox="0 0 30 30" style="margin-top: 4px;">
                                    <g clip-rule="evenodd" fill="#030d45" fill-rule="evenodd">
                                        <path
                                            d="m5.07692 5.92648c0-1.5374 1.26279-2.7837 2.82052-2.7837h4.10256c.4248 0 .7692.3399.7692.75919s-.3444.75919-.7692.75919h-4.10256c-.70806 0-1.28205.5665-1.28205 1.26532v1.01225c0 .41929-.3444.75919-.76924.75919-.42483 0-.76923-.3399-.76923-.75919zm.76923 10.37562c.42484 0 .76924.3399.76924.7592v1.0122c0 .6988.57399 1.2653 1.28205 1.2653h4.10256c.4248 0 .7692.34.7692.7592 0 .4193-.3444.7592-.7692.7592h-4.10256c-1.55773 0-2.82052-1.2463-2.82052-2.7837v-1.0122c0-.4193.3444-.7592.76923-.7592z"
                                            fill="#000000"/>
                                        <path
                                            d="m12.7692 4.78618c0-.88127.89-1.49263 1.7274-1.18656l5.1282 1.87454c.5029.18384.8367.65723.8367 1.18655v10.67859c0 .5293-.3338 1.0027-.8367 1.1865l-5.1282 1.8746c-.8374.3061-1.7274-.3053-1.7274-1.1866zm2.2617-2.61042c-1.8422-.67336-3.8001.67162-3.8001 2.61042v14.42762c0 1.9388 1.9579 3.2838 3.8001 2.6104l5.1282-1.8745c1.1065-.4045 1.8409-1.4459 1.8409-2.6104v-10.67859c0-1.16451-.7344-2.20596-1.8409-2.61041z"
                                            fill="#000000"/>
                                        <path
                                            d="m6.32787 9.43867c.3004-.29649.78745-.29649 1.08785 0l2.05129 2.02453c.3004.2965.3004.7771 0 1.0736l-2.05129 2.0245c-.3004.2965-.78745.2965-1.08785 0-.30041-.2964-.30041-.7771 0-1.0736l.73812-.7285h-4.29676c-.42483 0-.76923-.3399-.76923-.7592s.3444-.7592.76923-.7592h4.29676l-.73812-.7285c-.30041-.2965-.30041-.77715 0-1.07363z"
                                            fill="#000000"/>
                                    </g>
                                </svg>
                            @endif
                        </a>

                        @if(Auth::check())
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        @endif
                    </div>


                </div>

                <button class="navbar-toggler pr-0 ml-2 ml-md-3" type="button" data-toggle="collapse"
                        data-target="#menu-4"
                        aria-controls="menu-4" aria-expanded="false" aria-label="Toggle navigation">
                    <svg data-name="Icon/Hamburger" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24">
                        <path data-name="Icon Color"
                              d="M1.033,14a1.2,1.2,0,0,1-.409-.069.947.947,0,0,1-.337-.207,1.2,1.2,0,0,1-.216-.333,1.046,1.046,0,0,1-.072-.4A1.072,1.072,0,0,1,.072,12.6a.892.892,0,0,1,.216-.321.947.947,0,0,1,.337-.207A1.2,1.2,0,0,1,1.033,12H22.967a1.206,1.206,0,0,1,.409.069.935.935,0,0,1,.336.207.9.9,0,0,1,.217.321,1.072,1.072,0,0,1,.072.391,1.046,1.046,0,0,1-.072.4,1.206,1.206,0,0,1-.217.333.935.935,0,0,1-.336.207,1.206,1.206,0,0,1-.409.069Zm0-6a1.2,1.2,0,0,1-.409-.069.934.934,0,0,1-.337-.207,1.189,1.189,0,0,1-.216-.333A1.046,1.046,0,0,1,0,6.989,1.068,1.068,0,0,1,.072,6.6a.9.9,0,0,1,.216-.322.947.947,0,0,1,.337-.207A1.2,1.2,0,0,1,1.033,6H22.967a1.206,1.206,0,0,1,.409.068.935.935,0,0,1,.336.207.9.9,0,0,1,.217.322A1.068,1.068,0,0,1,24,6.989a1.046,1.046,0,0,1-.072.4,1.193,1.193,0,0,1-.217.333.923.923,0,0,1-.336.207A1.206,1.206,0,0,1,22.967,8Zm0-6a1.2,1.2,0,0,1-.409-.068.947.947,0,0,1-.337-.207,1.193,1.193,0,0,1-.216-.334A1.039,1.039,0,0,1,0,.988,1.068,1.068,0,0,1,.072.6.892.892,0,0,1,.288.276.934.934,0,0,1,.625.069,1.2,1.2,0,0,1,1.033,0H22.967a1.206,1.206,0,0,1,.409.069.923.923,0,0,1,.336.207A.9.9,0,0,1,23.928.6,1.068,1.068,0,0,1,24,.988a1.039,1.039,0,0,1-.072.4,1.2,1.2,0,0,1-.217.334.935.935,0,0,1-.336.207A1.206,1.206,0,0,1,22.967,2Z"
                              transform="translate(0 5)" fill="#000"></path>
                    </svg>
                </button>

                <div class="collapse navbar-collapse" id="menu-4">
                    <ul class="navbar-nav m-auto pt-3 pt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" id="HomePage" data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" id="RecipePage" data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                <span>Explore Recipes</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="megaMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-4 mega-menu" aria-labelledby="megaMenu" style="width: 1000px;">
                                <div class="row">
                                    <!-- Dish Type -->
                                    <div class="col-lg-3 col-md-6">
                                        <h6 class="text-uppercase">Dish Type</h6>
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="#">Appetizers</a></li>
                                            <li><a class="dropdown-item" href="#">Main Courses</a></li>
                                            <li><a class="dropdown-item" href="#">Side Dishes</a></li>
                                            <li><a class="dropdown-item" href="#">Desserts</a></li>
                                            <li><a class="dropdown-item" href="#">Snacks</a></li>
                                            <li><a class="dropdown-item" href="#">Beverages</a></li>
                                        </ul>
                                    </div>
                                    <!-- Meal Type -->
                                    <div class="col-lg-3 col-md-6">
                                        <h6 class="text-uppercase">Meal Type</h6>
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="#">Breakfast</a></li>
                                            <li><a class="dropdown-item" href="#">Brunch</a></li>
                                            <li><a class="dropdown-item" href="#">Lunch</a></li>
                                            <li><a class="dropdown-item" href="#">Dinner</a></li>
                                            <li><a class="dropdown-item" href="#">Late-Night Snacks</a></li>
                                        </ul>
                                    </div>
                                    <!-- Diet and Health -->
                                    <div class="col-lg-3 col-md-6">
                                        <h6 class="text-uppercase">Diet and Health</h6>
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="#">Vegetarian</a></li>
                                            <li><a class="dropdown-item" href="#">Vegan</a></li>
                                            <li><a class="dropdown-item" href="#">Gluten-Free</a></li>
                                            <li><a class="dropdown-item" href="#">Low-Carb</a></li>
                                            <li><a class="dropdown-item" href="#">High-Protein</a></li>
                                        </ul>
                                    </div>
                                    <!-- World Cuisine -->
                                    <div class="col-lg-3 col-md-6">
                                        <h6 class="text-uppercase">World Cuisine</h6>
                                        <ul class="list-unstyled">
                                            <li><a class="dropdown-item" href="#">Italian</a></li>
                                            <li><a class="dropdown-item" href="#">Mexican</a></li>
                                            <li><a class="dropdown-item" href="#">Indian</a></li>
                                            <li><a class="dropdown-item" href="#">Chinese</a></li>
                                            <li><a class="dropdown-item" href="#">Mediterranean</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="elements.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://fabrx.co/tastebite-food-recipes-website-template/"
                               target="_blank">Buy</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Tstbite Search -->
        <div class="tstbite-search">
            <div class="container">
                <div class="input-group search-box">
                    <input type="text" name="Search" placeholder="Search" class="form-control" id="Search">
                    <button type="button">
                        <img src="{{ URL::asset('images/icons/close.svg')}}" alt="img"></button>
                </div>
                <div class="search-results" id="SearchList">
                    <div class="tstbite-search-list">
                        <a href="#0">
                            <figure>
                                <img src="{{ URL::asset('images/menus/menu111.png')}}" class="rounded-circle" alt="Menu">
                            </figure>
                            <div class="tstbite-search-name">
                                <strong class="small">Cake</strong>
                                <span class="tiny">Category</span>
                            </div>
                        </a>
                    </div>
                    <div class="tstbite-search-list">
                        <a href="#0">
                            <figure>
                                <img src="{{ URL::asset('images/menus/menu112.jpg"')}}" class="rounded-2" alt="Menu">
                            </figure>
                            <div class="tstbite-search-name">
                                <strong class="small">Black Forest Birthday Cake</strong>
                            </div>
                        </a>
                    </div>
                    <div class="tstbite-search-list">
                        <a href="#0">
                            <figure>
                                <img src="{{ URL::asset('images/menus/menu113.png')}}" class="rounded-2" alt="Menu">
                            </figure>
                            <div class="tstbite-search-name">
                                <strong class="small">Double Thick Layered Sponge Cake</strong>
                            </div>
                        </a>
                    </div>
                    <div class="tstbite-search-list">
                        <a href="#0">
                            <figure>
                                <img src="{{ URL::asset('images/menus/menu114.png')}}" class="rounded-2" alt="Menu">
                            </figure>
                            <div class="tstbite-search-name">
                                <strong class="small">Cranberry Macaroon Ice cream Cake</strong>
                            </div>
                        </a>
                    </div>
                    <div class="tstbite-search-list">
                        <a href="#0">
                            <figure>
                                <img  src="{{ URL::asset('images/menus/menu115.png')}}" class="rounded-2" alt="Menu">
                            </figure>
                            <div class="tstbite-search-name">
                                <strong class="small">Almond Cinnamon Sponge Cake</strong>
                            </div>
                        </a>
                    </div>
                    <div class="tstbite-search-list">
                        <a href="#0">
                            <figure>
                                <img src="{{ URL::asset('images/menus/menu116.png')}}" class="rounded-2" alt="Menu">
                            </figure>
                            <div class="tstbite-search-name">
                                <strong class="small">Four Mini Birthday Cupcakes</strong>
                            </div>
                        </a>
                    </div>
                    <div class="text-center py-4">
                        <a href="#0" class="btn btn-sm btn-outline-dark px-4 py-2">See all 343 results</a>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

    </div>

    <!-- Tstbite Footer-->
    <footer class="tstbite-footer pt-3 pt-md-5 mt-5 bg-lightest-gray">
        <div class="container">
            <div class="row pt-4 pb-0 pb-md-5">
                <div class="col-md-6">
                    <div class="tastebite-footer-contnet pr-0 pr-lg-5 mr-0 mr-md-5">
                        <a href="/">
                            <img src="{{ URL::asset('images/logo.png')}}" style="max-width: 130px;" alt="Taste & Chef">
                        </a>
                        <p class="mt-3 text-gray-300 pr-0 pr-lg-5 mr-0 mr-lg-4">"On the other hand, we denounce with
                            righteous
                            indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of
                            the moment
                        </p>
                    </div>
                </div>
                <div class="col-md-2">
                    <h6 class="caption font-weight-medium mb-2 inter-font">
                        <span>Taste & Chef</span>
                        <span class="d-inline-block d-md-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 9.333 5.333">
                  <path
                      d="M1.138.2A.667.667,0,0,0,.2,1.138l4,4a.667.667,0,0,0,.943,0l4-4A.667.667,0,1,0,8.2.2L4.667,3.724Z"/>
                </svg>
              </span>
                    </h6>
                    <ul>
                        <li><a href="#0">About us</a></li>
                        <li><a href="#0">Careers</a></li>
                        <li><a href="#0">Contact us</a></li>
                        <li><a href="#0">Feedback</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6 class="caption font-weight-medium mb-2 inter-font">
                        <span>Legal</span>
                        <span class="d-inline-block d-md-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 9.333 5.333">
                  <path
                      d="M1.138.2A.667.667,0,0,0,.2,1.138l4,4a.667.667,0,0,0,.943,0l4-4A.667.667,0,1,0,8.2.2L4.667,3.724Z"/>
                </svg>
              </span>
                    </h6>
                    <ul>
                        <li><a href="#0">Terms</a></li>
                        <li><a href="#0">Conditions</a></li>
                        <li><a href="#0">Cookies</a></li>
                        <li><a href="#0">Copyright</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6 class="caption font-weight-medium mb-2 inter-font">
                        <span>Follow</span>
                        <span class="d-inline-block d-md-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 9.333 5.333">
                  <path
                      d="M1.138.2A.667.667,0,0,0,.2,1.138l4,4a.667.667,0,0,0,.943,0l4-4A.667.667,0,1,0,8.2.2L4.667,3.724Z"/>
                </svg>
              </span>
                    </h6>
                    <ul>
                        <li><a href="#0">Facebook</a></li>
                        <li><a href="#0">Twitter</a></li>
                        <li><a href="#0">Instagram</a></li>
                        <li><a href="#0">Youtube</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <hr>
            <div class="row pb-4 pt-2 align-items-center">
                <div class="col-md-6 order-2 order-md-0">
                    <p class="text-gray-300 small text-left mb-0">&copy; 2020 Tastebite - All rights reserved</p>
                </div>
                <div class="col-md-6">
                    <div class="tstbite-social text-left text-md-right my-4 my-md-0">
                        <a href="#0">
                            <svg data-name="feather-icon/facebook" xmlns="http://www.w3.org/2000/svg" width="20"
                                 height="20"
                                 viewBox="0 0 20 20">
                                <rect data-name="Bounding Box" width="20" height="20" fill="rgba(255,255,255,0)"/>
                                <path
                                    d="M6.667,18.333H3.333A.834.834,0,0,1,2.5,17.5V11.667H.833A.835.835,0,0,1,0,10.833V7.5a.834.834,0,0,1,.833-.833H2.5V5a5.006,5.006,0,0,1,5-5H10a.834.834,0,0,1,.833.833V4.167A.834.834,0,0,1,10,5H7.5V6.667H10A.833.833,0,0,1,10.808,7.7l-.833,3.334a.831.831,0,0,1-.809.631H7.5V17.5A.834.834,0,0,1,6.667,18.333Zm-5-10V10H3.333a.835.835,0,0,1,.834.833v5.834H5.833V10.833A.834.834,0,0,1,6.667,10h1.85l.416-1.667H6.667A.834.834,0,0,1,5.833,7.5V5A1.669,1.669,0,0,1,7.5,3.333H9.166V1.666H7.5A3.337,3.337,0,0,0,4.167,5V7.5a.835.835,0,0,1-.834.833Z"
                                    transform="translate(5 0.833)" fill="#7f7f7f"/>
                            </svg>
                        </a>
                        <a href="#0">
                            <svg data-name="feather-icon/instagram" xmlns="http://www.w3.org/2000/svg" width="20"
                                 height="20"
                                 viewBox="0 0 20 20">
                                <rect data-name="Bounding Box" width="20" height="20" fill="rgba(255,255,255,0)"/>
                                <path
                                    d="M5,18.333a5.005,5.005,0,0,1-5-5V5A5.006,5.006,0,0,1,5,0h8.333a5.005,5.005,0,0,1,5,5v8.333a5,5,0,0,1-5,5ZM1.667,5v8.333A3.337,3.337,0,0,0,5,16.667h8.333a3.337,3.337,0,0,0,3.333-3.333V5a3.337,3.337,0,0,0-3.333-3.334H5A3.338,3.338,0,0,0,1.667,5Zm4.59,7.076A4.164,4.164,0,1,1,9.2,13.3,4.161,4.161,0,0,1,6.256,12.076Zm.713-4.07a2.5,2.5,0,1,0,2.6-1.348A2.527,2.527,0,0,0,9.2,6.631,2.487,2.487,0,0,0,6.97,8.006Zm6.191-2.833a.833.833,0,1,1,.589.244A.834.834,0,0,1,13.161,5.173Z"
                                    transform="translate(0.833 0.833)" fill="#7f7f7f"/>
                            </svg>
                        </a>
                        <a href="#0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20.004" height="20" viewBox="0 0 20.004 20">
                                <g data-name="feather-icon/twitter" transform="translate(0.002)">
                                    <rect data-name="Bounding Box" width="20" height="20" fill="rgba(255,255,255,0)"/>
                                    <path
                                        d="M6.894,16.644A13.387,13.387,0,0,1,.431,14.9a.834.834,0,0,1,.4-1.562H.869c.118,0,.237.007.354.007a8.925,8.925,0,0,0,3.708-.813,8.043,8.043,0,0,1-3.59-4.4A9.651,9.651,0,0,1,1.329,2.55a8.74,8.74,0,0,1,.412-1.214A.833.833,0,0,1,3.184,1.2,8.049,8.049,0,0,0,8.914,4.574l.255.023,0-.2A4.567,4.567,0,0,1,16.78,1.162a8.239,8.239,0,0,0,1.909-1,.827.827,0,0,1,.478-.155.852.852,0,0,1,.663.326.811.811,0,0,1,.149.707,7.28,7.28,0,0,1-1.662,3.145c.012.138.019.276.019.408a13.328,13.328,0,0,1-.922,4.987A11.157,11.157,0,0,1,6.894,16.644ZM2.839,3.378a7.847,7.847,0,0,0,.086,4.238,6.928,6.928,0,0,0,4.081,4.131.833.833,0,0,1,.13,1.451,10.505,10.505,0,0,1-3.025,1.414,10.962,10.962,0,0,0,2.786.367,9.566,9.566,0,0,0,6.869-2.807,10.5,10.5,0,0,0,2.9-7.576,2.817,2.817,0,0,0-.052-.538.834.834,0,0,1,.233-.75,5.6,5.6,0,0,0,.515-.583l-.285.1-.288.091a.831.831,0,0,1-.868-.25,2.9,2.9,0,0,0-5.088,1.953V5.45a.829.829,0,0,1-.812.833c-.084,0-.169,0-.253,0A9.659,9.659,0,0,1,6,5.525,9.669,9.669,0,0,1,2.839,3.378Z"
                                        transform="translate(-0.002 1.658)" fill="#7f7f7f"/>
                                </g>
                            </svg>
                        </a>
                        <a href="#0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20.001" height="20" viewBox="0 0 20.001 20">
                                <g data-name="feather-icon/youtube" transform="translate(0)">
                                    <rect data-name="Bounding Box" width="20" height="20" fill="rgba(255,255,255,0)"/>
                                    <path
                                        d="M9.475,14.547,8.157,14.53c-.7-.013-1.348-.031-1.934-.053l-.592-.025a16.853,16.853,0,0,1-3.019-.316A3.189,3.189,0,0,1,.4,11.881,25.065,25.065,0,0,1,0,7.3,24.913,24.913,0,0,1,.408,2.681,3.168,3.168,0,0,1,2.618.411,17.815,17.815,0,0,1,5.8.089L6.887.049C7.536.029,8.205.016,8.876.008L9.8,0h.484L11.4.01c.584.007,1.173.02,1.748.036l.583.018a21.6,21.6,0,0,1,3.668.317A3.158,3.158,0,0,1,19.6,2.7,25.076,25.076,0,0,1,20,7.289a24.8,24.8,0,0,1-.408,4.58,3.164,3.164,0,0,1-2.209,2.269,16.78,16.78,0,0,1-3.014.315l-.592.025c-.586.023-1.237.041-1.934.053l-1.318.017ZM9.358,1.669c-.816.007-1.6.021-2.32.042l-1.109.04a18.192,18.192,0,0,0-2.868.266A1.468,1.468,0,0,0,2.037,3.031,23.455,23.455,0,0,0,1.667,7.3,23.669,23.669,0,0,0,2.018,11.5a1.488,1.488,0,0,0,1.031,1.024,18.758,18.758,0,0,0,2.977.273l.881.032c.374.011.793.022,1.282.031l1.3.017h1.026l1.3-.017c.488-.009.907-.019,1.282-.031l.881-.032.736-.035a14.14,14.14,0,0,0,2.228-.235,1.468,1.468,0,0,0,1.024-1.012,23.446,23.446,0,0,0,.37-4.232,23.255,23.255,0,0,0-.358-4.234,1.483,1.483,0,0,0-1.006-1.06,17.158,17.158,0,0,0-2.524-.232l-.776-.031c-.681-.023-1.453-.041-2.3-.053l-1.092-.009H9.8ZM7.545,10.616a.823.823,0,0,1-.254-.6V4.566a.835.835,0,0,1,.835-.834.822.822,0,0,1,.41.11l4.792,2.725a.833.833,0,0,1,0,1.449L8.537,10.74a.821.821,0,0,1-.411.111A.845.845,0,0,1,7.545,10.616ZM8.958,8.583l2.272-1.292L8.958,6Z"
                                        transform="translate(0 2.501)" fill="#7f7f7f"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</section>

<!-- Tastebite Scripts -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/html5.min.js') }}"></script>
<script src="{{ asset('js/sticky.min.js') }}"></script>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('js/masonry.min.js') }}"></script>
<script src="{{ asset('js/tastebite-scripts.js') }}"></script>

</body>
</html>
