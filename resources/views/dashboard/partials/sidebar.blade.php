@php
    $company = \DB::table('company_infos')->first();
    $user = auth()->user();
@endphp

{{-- Hidden container (looks like chart placeholders / settings) --}}
<div class="container" style="display:none">
    <a id="sidebar-setting">manish</a>

    <!-- Sparkline charts -->
    <div id="mini-1" data-colors='["--bs-primary"]'></div>
    <div id="mini-2" data-colors='["--bs-success"]'></div>
    <div id="mini-3" data-colors='["--bs-warning"]'></div>
    <div id="mini-4" data-colors='["--bs-danger"]'></div>

    <!-- Bar chart -->
    <div id="overview" data-colors='["--bs-info", "--bs-primary", "--bs-success", "--bs-warning", "--bs-danger"]'>
    </div>

    <!-- Donut chart -->
    <div id="saleing-categories" data-colors='["--bs-primary", "--bs-warning", "--bs-success", "--bs-danger"]'></div>

    <!-- Vector map -->
    <div id="world-map-markers" style="height: 400px;"></div>
</div>

@if ($company)
    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="{{ route('admin.dashboard.index') }}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset(!empty($company->logo) ? $company->logo : 'default/image/company_logo/company_logo.png') }}"
                        alt="Logo" height="26">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset(!empty($company->logo) ? $company->logo : 'default/image/company_logo/company_logo.png') }}"
                        alt="Logo" height="80" width="80">
                    {{-- width="180" --}}
                </span>
            </a>

            <a href="{{ route('admin.dashboard.index') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset($company->logo ?? 'default/image/company_logo/company_logo.png') }}"
                        alt="Logo" height="30">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset($company->logo ?? 'default/image/company_logo/company_logo.png') }}"
                        alt="Logo" height="26">
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
            <i class="bx bx-menu align-middle"></i>
        </button>

        {{-- Mobile submenu fixes --}}
        <style>
            @media(max-width:993px) {
                .sub-menu {
                    display: none;
                }

                .sub-menu.mm-show {
                    display: block;
                }

                .has-arrow.active {
                    font-weight: bold;
                }

                .current-page {
                    text-decoration: underline;
                }

                /* Hide all submenus by default */
                .metismenu .mm-collapse {
                    display: none;
                    height: 0;
                    overflow: hidden;
                    transition: all 0.3s ease;
                }

                /* Show submenu when .mm-show is added */
                .metismenu .mm-collapse.mm-show {
                    display: block !important;
                    height: auto;
                    overflow: visible;
                }

                .metismenu li.mm-active>.mm-collapse {
                    display: block !important;
                    height: auto !important;
                }

                #side-menu a.active-border {
                    background-color: rgba(255, 0, 0, 0.05);
                }
            }

            .sidebar-menu-scroll i {
                color: var(--primary-color);
            }
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const menu = document.querySelector("#side-menu");
                if (!menu) return;

                const currentPath = window.location.pathname.replace(/\/+$/, "");

                function normalizePath(path) {
                    return path.replace(/\/+$/, "");
                }

                let activeLink = null;
                document.querySelectorAll("#side-menu a[href]").forEach(a => {
                    const href = a.getAttribute("href");
                    if (!href || href.startsWith("javascript:") || href.startsWith("#")) return;

                    try {
                        const url = new URL(href, window.location.origin);
                        const linkPath = normalizePath(url.pathname);

                        if (linkPath === currentPath) {
                            activeLink = a;
                        }
                    } catch (err) {}
                });

                if (activeLink) {
                    activeLink.classList.add("current-page", "active-border");

                    let parentSub = activeLink.closest("ul.sub-menu");
                    while (parentSub) {
                        parentSub.classList.add("mm-show");

                        const parentLi = parentSub.parentElement;
                        if (parentLi && parentLi.tagName === "LI") parentLi.classList.add("mm-active");

                        const trigger = parentSub.previousElementSibling;
                        if (trigger && trigger.classList.contains("has-arrow")) {
                            trigger.classList.add("active", "active-border");
                        }

                        parentSub = parentSub.parentElement.closest("ul.sub-menu");
                    }
                }

                function attachClickListeners() {
                    document.querySelectorAll("#side-menu .has-arrow").forEach(item => {
                        item.addEventListener("click", function(e) {
                            if (window.innerWidth >= 993) return;
                            e.preventDefault();

                            const subMenu = this.nextElementSibling;
                            if (!subMenu || !subMenu.classList.contains("sub-menu")) return;

                            const parentUl = this.closest("ul");
                            parentUl.querySelectorAll(":scope > li > .sub-menu.mm-show").forEach(
                                openMenu => {
                                    let isParentOfActiveLink = false;
                                    let currentParent = activeLink?.closest("ul.sub-menu");

                                    while (currentParent) {
                                        if (currentParent === openMenu) {
                                            isParentOfActiveLink = true;
                                            break;
                                        }
                                        currentParent = currentParent.parentElement.closest(
                                            "ul.sub-menu");
                                    }

                                    if (openMenu !== subMenu && !isParentOfActiveLink) {
                                        openMenu.classList.remove("mm-show");
                                        openMenu.previousElementSibling?.classList.remove("active",
                                            "active-border");
                                    }
                                });

                            subMenu.classList.toggle("mm-show");
                            this.classList.toggle("active");
                        });
                    });
                }

                attachClickListeners();
                window.addEventListener("resize", attachClickListeners);
            });
        </script>

        <div data-simplebar class="sidebar-menu-scroll">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">

                    <!-- ================= Company ================= -->
                    <li class="menu-title" data-key="t-menu">Company</li>

                    <li>
                        <a href="{{ route('admin.members.index') }}">
                            <i class="bx bx-group nav-icon"></i>
                            <span class="menu-item">Members</span>
                        </a>
                    </li>

                    <!-- Register -->
                    <li>
                        <a href="javascript:void(0);" class="has-arrow">
                            <i class="bx bx-id-card nav-icon"></i>
                            <span class="menu-item">Register Records</span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('admin.match.making.index') }}">
                                    <i class="bx bx-heart nav-icon"></i>
                                    <span class="menu-item"> Match Making</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.astrology.index') }}">
                                    <i class="bx bx-moon nav-icon"></i>
                                    <span class="menu-item"> Astrology</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.mandap.index') }}">
                                    <i class="bx bx-home nav-icon"></i>
                                    <span class="menu-item">Mandap</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.pandit.index') }}">
                                    <i class="bx bx-user-voice nav-icon"></i>
                                    <span class="menu-item">Pandit</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.food.catering.index') }}">
                                    <i class="bx bx-dish nav-icon"></i>
                                    <span class="menu-item">Food & Catering</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.event.management.index') }}">
                                    <i class="bx bx-calendar-event nav-icon"></i>
                                    <span class="menu-item">Event Management</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.karma.training.index') }}">
                                    <i class="bx bx-book-open nav-icon"></i>
                                    <span class="menu-item">Karma Training</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.support.index') }}">
                                    <i class="bx bx-support nav-icon"></i>
                                    <span class="menu-item">Support</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.perform.kanyadan.index') }}">
                                    <i class="bx bx-heart nav-icon"></i>
                                    <span class="menu-item">Perform Kanyadan</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!-- Register -->
                    <li>
                        <a href="javascript:void(0);" class="has-arrow">
                            <i class="bx bx-id-card nav-icon"></i>
                            <span class="menu-item">Register Create</span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('admin.match.making.index') }}">
                                    <i class="bx bx-heart nav-icon"></i>
                                    Match Making
                                </a>
                            </li>


                        </ul>
                    </li>



                    <li>
                        <a href="#">
                            <i class="bx bx-bar-chart-alt-2 nav-icon"></i>
                            <span class="menu-item">Reports</span>
                        </a>
                    </li>

                    <!-- ================= Dashboard ================= -->
                    <li class="menu-title">Dashboard</li>

                    <li>
                        <a href="{{ route('admin.dashboard.index') }}">
                            <i class="bx bx-home-circle nav-icon"></i>
                            <span class="menu-item">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.member-profile') }}">
                            <i class="bx bx-user-circle nav-icon"></i>
                            <span class="menu-item">Profile</span>
                        </a>
                    </li>

                    <!-- ================= Services ================= -->
                    <li class="menu-title">Services</li>

                    <li>
                        <a href="{{ route('admin.contact.records') }}">
                            <i class="bx bx-phone-call nav-icon"></i>
                            <span class="menu-item">Contact Records</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.query.records') }}">
                            <i class="bx bx-question-mark nav-icon"></i>
                            <span class="menu-item">Query Records</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.subscription.index') }}">
                            <i class="bx bx-receipt nav-icon"></i>
                            <span class="menu-item">Subscription</span>
                        </a>
                    </li>

                    <!-- ================= Website (Admin Only) ================= -->
                    @if ($user->role == 1)
                        <li class="menu-title">Website</li>

                        <li>
                            <a href="javascript:void(0);" class="has-arrow">
                                <i class="bx bx-layout nav-icon"></i>
                                <span class="menu-item">Home Page</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.hero-contents.index') }}">
                                        <i class="bx bx-image nav-icon"></i>
                                        Home Hero
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.happy-story.index') }}">
                                        <i class="bx bx-smile nav-icon"></i>
                                        Happy Stories
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.advertisement.index') }}">
                                        <i class="bx bx-badge-check nav-icon"></i>
                                        Advertisement
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('admin.frontend-content.index') }}">
                                <i class="bx bx-edit nav-icon"></i>
                                <span class="menu-item">Frontend Content</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.karma-training-content.index') }}">
                                <i class="bx bx-book-content nav-icon"></i>
                                <span class="menu-item">Karma Training Content</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.content-pages.index') }}">
                                <i class="bx bx-file nav-icon"></i>
                                <span class="menu-item">Content Pages</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.astro-products.index') }}">
                                <i class="bx bx-store nav-icon"></i>
                                <span class="menu-item">Astro Products</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('admin.partner.index') }}">
                                <i class="bx bx-store nav-icon"></i>
                                <span class="menu-item">Parnter</span>
                            </a>
                        </li>


                        <li>
                            <a href="javascript:void(0);" class="has-arrow">
                                <i class="bx bx-layout nav-icon"></i>
                                <span class="menu-item">Caste</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.caste.index') }}">
                                        <i class="bx bx-image nav-icon"></i>
                                        Caste
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.sub-caste.index') }}">
                                        <i class="bx bx-smile nav-icon"></i>
                                        Sub Caste
                                    </a>
                                </li>
                             
                            </ul>
                        </li>


                        <!-- ================= Settings ================= -->
                        <li class="menu-title">Setting</li>

                        <li>
                            <a href="{{ route('admin.payment-gateway.index') }}">
                                <i class="bx bx-credit-card nav-icon"></i>
                                <span class="menu-item">Payment Gateway</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.seo-pages.index') }}">
                                <i class="bx bx-line-chart nav-icon"></i>
                                <span class="menu-item">SEO</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.recyclebin.index') }}">
                                <i class="bx bx-trash nav-icon"></i>
                                <span class="menu-item">Recycle Bin</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>

    </div>
    <!-- Left Sidebar End -->
@endif
