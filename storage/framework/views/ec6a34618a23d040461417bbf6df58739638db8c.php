<?php
    $free_page = App\Models\Text::find(1);
?>

<nav id="sidebar">
    <div class="shadow-bottom"></div>
    <ul class="list-unstyled menu-categories" id="accordionExample">

        <li class="menu">
            <a href="/admin/dashboard"  <?php if(request()->is('admin/dashboard*')): ?>  data-active="true" <?php endif; ?>  aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span>Панель</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="#statistics"  <?php if(request()->is('admin/book-sales*')): ?>  data-active="true" aria-expanded="true"   <?php endif; ?> data-toggle="collapse"  class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                    <span>Статистика</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu <?php if(request()->is('admin/book-sales*')): ?>  show <?php endif; ?> list-unstyled" id="statistics" data-parent="#accordionExample">
                <li <?php if(request()=='/admin/book-sales?type=paper'): ?>  class="active"  <?php endif; ?> >
                    <a href="/admin/book-sales?type=paper"> Покупки бм. книг </a>
                </li>
                <li <?php if(request()->is('/admin/book-sales?type=ebook')): ?>  class="active"  <?php endif; ?>>
                    <a href="/admin/book-sales?type=ebook"> Покупки эл. книг </a>
                </li>
                <li <?php if(request()->is('/admin/book-sales?type=audio')): ?>  class="active"  <?php endif; ?> >
                    <a href="/admin/book-sales?type=audio"> Покупки ау. книг </a>
                </li>
            </ul>
        </li>


        <li class="menu">
            <a href="#orders"  <?php if(request()->is('admin/orders*') || request()->is('admin/notpaidorders*')): ?>  data-active="true" aria-expanded="true"   <?php endif; ?> data-toggle="collapse"  class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <span>Заказы</span>
                    <span class="badge badge-light">
                        <?php echo e(\App\Models\CustomerOrder::where([['is_gift',0],['paid',1],['is_seen',0]])->whereNotNull('delivery_type')->count()); ?>

                    </span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled <?php if(request()->is('admin/orders*') || request()->is('admin/notpaidorders*')): ?>  show <?php endif; ?>" id="orders" data-parent="#accordionExample">
                <li <?php if(request()->is('admin/orders*')): ?>  class="active" <?php endif; ?>>
                    <a href="/admin/orders"> Бумажные </a>
                    <span class="badge badge-default"></span>
                </li>
                <li <?php if(request()->is('admin/notpaidorders*')): ?>  class="active" <?php endif; ?>>
                    <a href="/admin/notpaidorders"> Неоплаченные </a>
                </li>
            </ul>
        </li>



        <li class="menu">
            <a href="/admin/slider" <?php if(request()->is('admin/slider*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>Слайдер</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/collection" <?php if(request()->is('admin/collection*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                    <span>Подборка</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/admin/chapter" <?php if(request()->is('admin/chapter*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                    <span>Содержание</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/genre" <?php if(request()->is('admin/genre*')): ?>  data-active="true" <?php endif; ?>  aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                    <span>Жанр</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/admin/author"  <?php if(request()->is('admin/author*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>Автор</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/publisher" <?php if(request()->is('admin/publisher*')): ?>  data-active="true" <?php endif; ?>  aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                    <span>Издатели</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/admin/translator" <?php if(request()->is('admin/translator*')): ?>  data-active="true" <?php endif; ?>  aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>Переводчики</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/book" <?php if(request()->is('admin/book*')): ?>  data-active="true" <?php endif; ?>  aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    <span>Книги</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/admin/users" <?php if(request()->is('admin/users*')): ?>  data-active="true" <?php endif; ?>   aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Пользователи</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/user_problem"  <?php if(request()->is('admin/user_problem*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>Сообщений</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/admin/article"  <?php if(request()->is('admin/article*')): ?>  data-active="true" <?php endif; ?>  aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-feather"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path><line x1="16" y1="8" x2="2" y2="22"></line><line x1="17.5" y1="15" x2="9" y2="15"></line></svg>
                    <span>Статьи</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/menu" <?php if(request()->is('admin/menu*')): ?>  data-active="true" <?php endif; ?>  aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    <span>Меню</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/admin/pages" <?php if(request()->is('admin/pages*')): ?>  data-active="true" <?php endif; ?>   aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    <span>Страницы</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/contacts" <?php if(request()->is('admin/contacts*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <span>Контакты</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/admin/delivery_price" <?php if(request()->is('admin/delivery_price*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    <span>Жеткізі құны</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="/admin/promocodes" <?php if(request()->is('admin/promocodes*')): ?>  data-active="true" <?php endif; ?> aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                    <span>Промокоды</span>
                </div>
            </a>
        </li>


        <li class="menu">
            <a href="#subscription"  <?php if(request()->is('admin/subscripted') || request()->is('admin/subscription') || request()->is('admin/subscription-information')): ?>  data-active="true" aria-expanded="true"   <?php endif; ?> data-toggle="collapse"  class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <span>Подписка</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled <?php if(request()->is('admin/subscripted') || request()->is('admin/subscription')|| request()->is('admin/subscription-information')): ?>  show <?php endif; ?>" id="subscription" data-parent="#accordionExample">
                <li <?php if(request()->is('admin/subscripted')): ?>  class="active" <?php endif; ?>>
                    <a href="/admin/subscripted"> Подписчики </a>
                    <span class="badge badge-default"></span>
                </li>
                <li <?php if(request()->is('admin/subscription')): ?>  class="active" <?php endif; ?>>
                    <a href="/admin/subscription"> Подписки </a>
                </li>
                <li <?php if(request()->is('admin/subscription-information')): ?>  class="active" <?php endif; ?>>
                    <a href="/admin/subscription-information"> Описание </a>
                </li>
                <li <?php if(request()->is('admin/subscription-information')): ?>  class="active" <?php endif; ?>>
                    <a href="/admin/subscription-statistic"> Статистика </a>
                </li>
                <li <?php if(request()->is('admin/subscription-faq')): ?>  class="active" <?php endif; ?>>
                    <a href="/admin/subscription-faq"> FAQ </a>
                </li>
            </ul>
        </li>


        <li class="menu">
            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                    <span>Выйти</span>
                </div>
            </a>

            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </li>



    </ul>
    <!-- <div class="shadow-bottom"></div> -->

</nav>
<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/layouts/left-menu.blade.php ENDPATH**/ ?>