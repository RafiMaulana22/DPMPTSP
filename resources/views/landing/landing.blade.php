<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>SipLayan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @include('components.style')
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark"
                        height="17">
                    <img src="assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light"
                        height="17">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link active" href="#hero">Home</a>
                        </li>
                    </ul>

                    <div class="">
                        <a href="{{ route('login') }}"
                            class="btn btn-link fw-medium text-decoration-none text-body">Sign in</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->
        <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

        <!-- start hero section -->
        <section class="section pb-0 hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-sm-10">
                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3>Form</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('landing.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama_alternatif" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_alternatif"
                                            id="nama_alternatif" placeholder="Masukkan Nama Lengkap...">
                                    </div>
                                    @foreach ($pertanyaan as $item)
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ $item->pertanyaan }}</label>
                                            <input type="hidden" name="id_pertanyaan[]"
                                                value="{{ $item->id_pertanyaan }}">

                                            @foreach ($item->pilihan as $get)
                                                <br>
                                                <label for="pilihan_{{ $item->id_pertanyaan }}_{{ $get->id_pilihan }}"
                                                    class="form-label">
                                                    <input type="radio" name="pilihan[{{ $item->id_pertanyaan }}]"
                                                        id="pilihan_{{ $item->id_pertanyaan }}_{{ $get->id_pilihan }}"
                                                        value="{{ $get->id_pilihan }}">
                                                    <span>{{ $get->pilihan }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->

            <!-- end shape -->
        </section>
        <!-- end hero section -->

        <!-- Modal Terima Kasih -->
        <div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="thankYouModalLabel">Terima Kasih</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Terima kasih telah mengisi form. Kami akan segera memproses data Anda.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script untuk menampilkan modal jika session ada -->
        @if (session('form_submitted'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));
                    thankYouModal.show();
                });
            </script>
        @endif

        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                <img src="assets/images/logo-light.png" alt="logo light" height="17">
                            </div>
                            <div class="mt-4 fs-13">
                                <p>Premium Multipurpose Admin & Dashboard Template</p>
                                <p class="ff-secondary">You can build any type of web application like eCommerce, CRM,
                                    CMS, Project management apps, Admin Panels, etc using Velzon.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Company</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="pages-profile.html">About Us</a></li>
                                        <li><a href="pages-gallery.html">Gallery</a></li>
                                        <li><a href="apps-projects-overview.html">Projects</a></li>
                                        <li><a href="pages-timeline.html">Timeline</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Apps Pages</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="pages-pricing.html">Calendar</a></li>
                                        <li><a href="apps-mailbox.html">Mailbox</a></li>
                                        <li><a href="apps-chat.html">Chat</a></li>
                                        <li><a href="apps-crm-deals.html">Deals</a></li>
                                        <li><a href="apps-tasks-kanban.html">Kanban Board</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Support</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="pages-faqs.html">FAQ</a></li>
                                        <li><a href="pages-faqs.html">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">

                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Velzon - Themesbrand
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-social-link">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-facebook-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-github-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-linkedin-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-google-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-dribbble-line"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->


        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->


    @include('components.script')
</body>

</html>
