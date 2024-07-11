<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de compras</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    <main class="container mx-auto p-4 min-h-full mt-18">
        <div class="mx-auto max-w-7xl px-8">
            <div class="mx-auto lg:max-w-4xl lg:px-0">
                <h1 class="avx awj axd ayb cmz">Order history</h1>
                <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, manage returns, and discover similar
                    products.</p>
            </div>
        </div>
        <div class="la">
            <h2 class="t">Recent orders</h2>
            <div class="gx uh cka dit">
                <div class="gx uc acg cke dcs dim">
                    <div class="afm aft agb alt bbt cim cix">
                        <h3 class="t">Order placed on <time datetime="2021-07-06">Jul 6, 2021</time></h3>
                        <div class="lx zg afm agb aqz ccw cfy chc cjt">
                            <dl class="mb ut yp aap awg bzi cfx cxi">
                                <div>
                                    <dt class="awk ayb">Order number</dt>
                                    <dd class="ku axx">WU88191111</dd>
                                </div>
                                <div class="md ccq">
                                    <dt class="awk ayb">Date placed</dt>
                                    <dd class="ku axx"><time datetime="2021-07-06">Jul 6, 2021</time></dd>
                                </div>
                                <div>
                                    <dt class="awk ayb">Total amount</dt>
                                    <dd class="ku awk ayb">$160.00</dd>
                                </div>
                            </dl>
                            <div class="ab lx zk dao" data-headlessui-state="">
                                <div class="lx zg"><button class="fs lx zg aqw axv bla"
                                        id="headlessui-menu-button-:r2:" type="button" aria-haspopup="menu"
                                        aria-expanded="false" data-headlessui-state=""><span class="t">Options
                                            for order WU88191111</span><svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            aria-hidden="true" class="oi sl">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z">
                                            </path>
                                        </svg></button></div>
                            </div>
                            <div class="md cxi dak des dev dfw"><a href="#"
                                    class="lx zg zl aeb afg agc alt ark asb awg awk axz bbt bik bnc bnh bnt boj"><span>View
                                        Order</span><span class="t">WU88191111</span></a><a href="#"
                                    class="lx zg zl aeb afg agc alt ark asb awg awk axz bbt bik bnc bnh bnt boj"><span>View
                                        Invoice</span><span class="t">for order WU88191111</span></a></div>
                        </div>
                        <h4 class="t">Items</h4>
                        <ul role="list" class="acj acn">
                            <li class="aqz cjt">
                                <div class="lx zg cgj">
                                    <div class="nv rx uw adn aea aiq cdg ced"><img
                                            alt="Moss green canvas compact backpack with double top zipper, zipper front pouch, and matching carry handle and backpack straps."
                                            src="https://tailwindui.com/img/ecommerce-images/order-history-page-03-product-01.jpg"
                                            class="pn tu aqk aql"></div>
                                    <div class="jz ut awg">
                                        <div class="awk ayb cct cgr">
                                            <h5>Micro Backpack</h5>
                                            <p class="lb cbx">$70.00</p>
                                        </div>
                                        <p class="md axx ccd ccq">Are you a minimalist looking for a compact
                                            carry option? The Micro Backpack is the perfect size for your
                                            essential everyday carry items. Wear it like a backpack or carry it
                                            like a satchel for all-day use.</p>
                                    </div>
                                </div>
                                <div class="lk cct cgr">
                                    <div class="lx zg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true" class="of si ayd">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="jt awg awk axx">Delivered on <time datetime="2021-07-12">July
                                                12, 2021</time></p>
                                    </div>
                                    <div class="lk lx zg abq aci acn aft agb avh awg awk cbl cbx cjf cmc">
                                        <div class="lx ut zl"><a href="#" class="adt ayn bli">View
                                                product</a></div>
                                        <div class="lx ut zl att"><a href="#" class="adt ayn bli">Buy
                                                again</a></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
</body>

</html>
