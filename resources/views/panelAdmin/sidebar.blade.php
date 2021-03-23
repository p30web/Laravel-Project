<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
{{--            <div class="profile-img">--}}
{{--                <img src="{{asset('adminpanel/assets/images/users/download.svg')}}">--}}
{{--                <img src="{{asset('adminpanel/assets/images/users/experts-img.png')}}" alt="user">--}}
{{--            </div>--}}
{{--            <div class="profile-text">--}}
{{--                <h5>@if (auth()->user()->name != null && auth()->user()->family) {{auth()->user()->name . ' ' .auth()->user()->family}} @else نام و نام خانوادگی شما @endif</h5>--}}
{{--                <div class="dropdown-menu animated flipInY">--}}
{{--                    <a href="#" class="dropdown-item"><i class="ti-user"></i> مشخصات من</a>--}}
{{--                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> موجودی حساب</a>--}}
{{--                    <a href="#" class="dropdown-item"><i class="ti-email"></i> صندوق ورودی</a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item"><i class="ti-settings"></i> تنظیمات حساب</a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> خروج</a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li>
                    <a class="waves-effect waves-dark" href="{{route('admin.dashboard')}}" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 22 22">
                            <defs>
                                <style>
                                    .cls-1{fill:#707070}.cls-2-1{fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:.75px}
                                </style>
                            </defs>
                            <g id="Group_7962" data-name="Group 7962" transform="translate(-57 -52)">
                                <g id="Group_7954" data-name="Group 7954" transform="translate(-1811 -168)">
                                    <path id="Path_2305" d="M11 0A11 11 0 1 1 0 11 11 11 0 0 1 11 0z" class="cls-1" data-name="Path 2305" transform="translate(1868 220)"/>
                                    <g id="Group_7598" data-name="Group 7598" transform="translate(-1586.459 -3269.459)">
                                        <circle id="Ellipse_132" cx="8.5" cy="8.5" r="8.5" class="cls-2-1" data-name="Ellipse 132" transform="translate(3456.9 3491.9)"/>
                                        <path id="Path_1671" d="M1034 1680.019a6.093 6.093 0 0 1 1.744-4.293 5.946 5.946 0 0 1 8.475 0 6.047 6.047 0 0 1 1.744 4.293" class="cls-2-1" data-name="Path 1671" transform="translate(2425.404 1820.441)"/>
                                        <path id="Line_375" d="M0 0l1.734 2.009" class="cls-2-1" data-name="Line 375" transform="translate(3463.208 3498.754)"/>
                                        <circle id="Ellipse_133" cx=".55" cy=".55" r=".55" class="cls-2-1" data-name="Ellipse 133" transform="rotate(-45.235 5934.286 -2407.403)"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="hide-menu">داشبورد </span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 22 22">
                            <defs>
                                <style>
                                    .cls-1{fill:#707070}.cls-2-2{fill:#fff}
                                </style>
                            </defs>
                            <g id="Group_7963" data-name="Group 7963" transform="translate(-57 -99)">
                                <g id="Group_7953" data-name="Group 7953" transform="translate(-1829 -135)">
                                    <circle id="Ellipse_169" cx="11" cy="11" r="11" class="cls-1" data-name="Ellipse 169" transform="translate(1886 234)"/>
                                </g>
                                <path id="Path_2609" d="M1271.9 150.991l-2.7-2.7.364-.364-.364-.364-1.092 1.092-1.819-1.819 2.183-2.183a2.641 2.641 0 0 0 .883.156 2.471 2.471 0 0 0 1.871-.78 2.711 2.711 0 0 0 .572-2.963l-.156-.364-1.144 1.144h-.935v-.884l1.2-1.2-.364-.156a2.328 2.328 0 0 0-1.04-.208 2.471 2.471 0 0 0-1.871.78 2.667 2.667 0 0 0-.624 2.807l-2.183 2.183-3.067-3.067.364-.364-1.978-1.973-1.091 1.092 1.975 1.975.364-.364 3.067 3.067-2.183 2.183a2.641 2.641 0 0 0-.884-.156 2.471 2.471 0 0 0-1.871.78 2.711 2.711 0 0 0-.572 2.963l.156.364 1.2-1.2h.883v.936l-1.143 1.143.364.156a2.327 2.327 0 0 0 1.04.208 2.471 2.471 0 0 0 1.871-.78 2.666 2.666 0 0 0 .624-2.807l2.183-2.183 1.819 1.819-1.091 1.092.364.364.364-.364 2.7 2.7a1.217 1.217 0 0 0 .884.364 1.356 1.356 0 0 0 .883-.364 1.288 1.288 0 0 0-.006-1.761zm-12.266-10.083l.364-.364 1.248 1.247-.364.364zm3.586 8.472a2.15 2.15 0 0 1-.468 2.391 2.082 2.082 0 0 1-1.507.624 1.438 1.438 0 0 1-.468-.052l.728-.728v-1.663h-1.605l-.78.78a2.224 2.224 0 0 1 .572-2.027 2.082 2.082 0 0 1 1.507-.624 2.64 2.64 0 0 1 .884.156l.156.052 5.146-5.146-.052-.156a2.15 2.15 0 0 1 .468-2.391 2.082 2.082 0 0 1 1.507-.624 1.441 1.441 0 0 1 .468.052l-.78.78v1.611h1.663l.728-.728a2.265 2.265 0 0 1-.572 2.027 2.081 2.081 0 0 1-1.507.624 2.638 2.638 0 0 1-.883-.156l-.156-.052-5.146 5.146zm8.316 3.015a.667.667 0 0 1-.52.208.8.8 0 0 1-.52-.208l-2.7-2.7 1.092-1.092 2.7 2.7a.935.935 0 0 1-.048 1.091z" class="cls-2-2" data-name="Path 2609" transform="translate(-1197.891 -36.697)"/>
                            </g>
                        </svg>
                        <span class="hide-menu">کارشناسی</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
{{--                        <li><a href="expert-form.html">درخواست کارشناسی</a></li>--}}
                        <li><a href="{{route('expert.index')}}">لیست کارشناسی‌ها</a></li>
{{--                        <li><a href="add-package.html">افزودن پکیج کارشناسی</a></li>--}}
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 22 22">
                            <defs>
                                <style>
                                    .cls-1{fill:#707070}.cls-2-3{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:.5px}
                                </style>
                            </defs>
                            <g id="Group_7964" data-name="Group 7964" transform="translate(-57 -145)">
                                <g id="Group_7952" data-name="Group 7952" transform="translate(-1829 -89)">
                                    <circle id="Ellipse_169" cx="11" cy="11" r="11" class="cls-1" data-name="Ellipse 169" transform="translate(1886 234)"/>
                                </g>
                                <g id="_28" data-name="28" transform="translate(62 149)">
                                    <g id="Group_29" data-name="Group 29">
                                        <path id="Path_53" d="M542 285l11.937 1.705a.426.426 0 0 1 .426.426v4.69a.426.426 0 0 1-.426.426L542 293.953z" class="cls-2-3" data-name="Path 53" transform="translate(-542 -284.147)"/>
                                        <path id="Line_34" d="M0 0v8.1" class="cls-2-3" data-name="Line 34" transform="translate(2.132 1.279)"/>
                                        <path id="Path_54" d="M546 303.426v4.263l2.132-.853V303" class="cls-2-3" data-name="Path 54" transform="translate(-537.473 -294.473)"/>
                                        <path id="Line_35" d="M0 0v10.658" class="cls-2-3" data-name="Line 35"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="hide-menu">آگهی‌ها  </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
{{--                        <li><a href="{{route('sale.create')}}"> افزودن آگهی </a></li>--}}
                        <li><a href="{{route('sale.index')}}"> لیست آگهی‌ها</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 22 22">
                            <defs>
                                <style>
                                    .cls-1{fill:#707070}.cls-2-4{fill:#fff}
                                </style>
                            </defs>
                            <g id="Group_7965" data-name="Group 7965" transform="translate(-57 -192)">
                                <g id="Group_7951" data-name="Group 7951" transform="translate(-1829 -42)">
                                    <circle id="Ellipse_169" cx="11" cy="11" r="11" class="cls-1" data-name="Ellipse 169" transform="translate(1886 234)"/>
                                </g>
                                <path id="Shape_183" d="M117.053 1717.771a5.02 5.02 0 0 0 1.347-3.458 4.418 4.418 0 1 0-8.8 0 5.018 5.018 0 0 0 1.36 3.471 2.781 2.781 0 0 0-2.46 2.442v2.916a2.574 2.574 0 0 0 2.475 2.584h6.05a2.574 2.574 0 0 0 2.475-2.584v-2.916a2.7 2.7 0 0 0-2.447-2.455zm-6.9-3.458a3.87 3.87 0 1 1 3.85 4.262 4.077 4.077 0 0 1-3.853-4.262zm8.8 8.828a2.024 2.024 0 0 1-1.925 2.034h-6.05a2.024 2.024 0 0 1-1.925-2.034v-2.916a2.3 2.3 0 0 1 2.3-1.925.268.268 0 0 0 .136-.041 4.071 4.071 0 0 0 5.068-.038.274.274 0 0 0 .193.079 2.2 2.2 0 0 1 2.2 1.925z" class="cls-2-4" data-name="Shape 183" transform="translate(-45.5 -1514.5)"/>
                            </g>
                        </svg>
                        <span class="hide-menu">کاربران </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('user.index')}}">لیست کاربران  </a></li>
{{--                        <li><a href="add-user.html">افزودن کاربران  </a></li>--}}
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 22 22">
                            <defs>
                                <style>
                                    .cls-1{fill:#707070}.cls-2-5{fill:#fff}
                                </style>
                            </defs>
                            <g id="Group_7966" data-name="Group 7966" transform="translate(-57 -239)">
                                <g id="Group_7949" data-name="Group 7949" transform="translate(-1829 5)">
                                    <circle id="Ellipse_169" cx="11" cy="11" r="11" class="cls-1" data-name="Ellipse 169" transform="translate(1886 234)"/>
                                </g>
                                <g id="Group_7950" data-name="Group 7950" transform="translate(-12490.033 -1951.112)">
                                    <path id="Shape_275" d="M.893 10.935a.779.779 0 0 1-.822-.768V2.243c0-.029.006-.062.009-.09v-.02A2.137 2.137 0 0 1 .277.4 1.435 1.435 0 0 1 1.438 0H12.6v1.367h.773a.871.871 0 0 1 .822.876v1.63h.456v4.556H14.2v1.738a.779.779 0 0 1-.822.768zM.527 2.243v7.924a.324.324 0 0 0 .366.312h12.48a.324.324 0 0 0 .366-.312V8.429H9.9a2.278 2.278 0 1 1 0-4.556h3.84v-1.63a.417.417 0 0 0-.366-.42H.893a.417.417 0 0 0-.366.42zm7.546 3.908A1.825 1.825 0 0 0 9.9 7.973h4.3V4.328H9.9a1.825 1.825 0 0 0-1.827 1.823zM.626.693a1.161 1.161 0 0 0-.166.814.826.826 0 0 1 .433-.14h11.252V.456H1.438a1.035 1.035 0 0 0-.812.237zM9.184 6.2a.911.911 0 1 1 .911.911.912.912 0 0 1-.911-.911zm.456 0a.456.456 0 1 0 .456-.456.456.456 0 0 0-.457.456z" class="cls-2-5" data-name="Shape 275" transform="translate(12550.708 2195.645)"/>
                                </g>
                            </g>
                        </svg>
                        <span class="hide-menu">پرداخت‌ها</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('invoice.index')}}"> لیست صورتحساب‌ها </a></li>
{{--                        <li><a href="23.html">افزودن فاکتور</a></li>--}}
                    </ul>
                </li>

{{--                <li>--}}
{{--                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 22 22">--}}
{{--                            <defs>--}}
{{--                                <style>--}}
{{--                                    .cls-1{fill:#707070}.cls-2-6{fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:.5px}--}}
{{--                                </style>--}}
{{--                            </defs>--}}
{{--                            <g id="Group_7967" data-name="Group 7967" transform="translate(-57 -285)">--}}
{{--                                <g id="Group_7948" data-name="Group 7948" transform="translate(-1822 -215)">--}}
{{--                                    <g id="Group_7611" data-name="Group 7611" transform="translate(11 43)">--}}
{{--                                        <g id="Group_7610" data-name="Group 7610" transform="translate(-18 223)">--}}
{{--                                            <circle id="Ellipse_169" cx="11" cy="11" r="11" class="cls-1" data-name="Ellipse 169" transform="translate(1886 234)"/>--}}
{{--                                        </g>--}}
{{--                                        <g id="Group_7595" data-name="Group 7595" transform="translate(1872 461)">--}}
{{--                                            <path id="Path_1838" d="M648.043 1281h-1.363v2.045l-1.363.454-1.363-1.363-1.818 1.818 1.363 1.363-.454 1.363H641v2.726h2.045l.454 1.363-1.363 1.363 1.818 1.817 1.363-1.363 1.363.454v2.045h2.726v-2.045l1.363-.454 1.363 1.363 1.818-1.817-1.363-1.363.454-1.363h2.045v-2.726h-2.045l-.454-1.363 1.363-1.363-1.818-1.818-1.363 1.363-1.363-.454V1281z" class="cls-2-6" data-name="Path 1838" transform="translate(-641 -1281)"/>--}}
{{--                                            <ellipse id="Ellipse_168" cx="1.363" cy="1.363" class="cls-2-6" data-name="Ellipse 168" rx="1.363" ry="1.363" transform="translate(5.68 5.68)"/>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                </g>--}}
{{--                            </g>--}}
{{--                        </svg>--}}
{{--                        <span class="hide-menu">تنظیمات کاربری </span>--}}
{{--                    </a>--}}
{{--                    <!--<ul aria-expanded="false" class="collapse">-->--}}
{{--                    <!--<li><a href="app-email.html">افزودن آگهی </a></li>-->--}}
{{--                    <!--<li><a href="app-email-detail.html">لیست آگهی‌ها  </a></li>-->--}}
{{--                    <!--</ul>-->--}}
{{--                </li>--}}

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>