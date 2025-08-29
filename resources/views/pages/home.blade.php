@extends('layouts.university_portal')

@section('content-1')
    {{-- bannar section are starts  --}}
    <section class="row">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner md:container mx-auto">

                <div class="carousel-item active"
                    style="
                    background-image: url('{{ asset('images/slider_bg_01.png') }}');
                    background-size: cover;
                    background-position: center;
                    height: 400px;
                    color: white;
                    padding: 3rem;
                ">
                    <div class="d-flex flex-column justify-content-start md:p-20">
                        <h3>Welcome To Qeducato</h3>
                        <h1 class="fw-bold fs-1">Education is the best <br> key success in life</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora,<br>
                            accusamus laborum! Mollitia debitis beatae ipsum in repellat a provident nihil!
                        </p>
                        <div class="mt-4">
                            <a href="#" class="btn me-2 btn-more">
                                Discover More <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                            <a href="#" class="btn btn-more-1">
                                Contact Us <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item"
                    style="
                    background-image: url('{{ asset('images/slider_bg_02.jpg') }}');
                    background-size: cover;
                    background-position: center;
                    height: 400px;
                    color: white;
                    padding: 3rem;
                ">
                    <div class="d-flex flex-column justify-content-start md:p-20">
                        <h3>Explore Our Courses</h3>
                        <h1 class="font-w">Learn and grow your skills</h1>
                        <p>
                            Join thousands of students worldwide and improve your knowledge with us.
                        </p>
                        <div class="mt-4">
                            <a href="#" class="btn me-2 btn-more">
                                Discover More <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                            <a href="#" class="btn btn-more-1">
                                Contact Us <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item"
                    style="
                    background-image: url('{{ asset('images/slider_bg_01.png') }}');
                    background-size: cover;
                    background-position: center;
                    height: 400px;
                    color: white;
                    padding: 3rem;
                ">
                    <div class="d-flex flex-column justify-content-start md:p-20">
                        <h3>Join Our Community</h3>
                        <h1 class="font-w">Connect with like-minded learners</h1>
                        <p>
                            Engage with peers and experts to enhance your educational journey.
                        </p>
                        <div class="mt-4">
                            <a href="#" class="btn me-2 btn-more">
                                Discover More <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                            <a href="#" class="btn btn-more-1">
                                Contact Us <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev custom-carousel-control" type="button"
                data-bs-target="#carouselExampleControls" data-bs-slide="prev" aria-label="Previous">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next custom-carousel-control" type="button"
                data-bs-target="#carouselExampleControls" data-bs-slide="next" aria-label="Next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
    </section>
    {{-- bannar section are ends --}}
    {{-- education section --}}
    <section class="row py-5 px-4">
        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center gap-5">

            <!-- Image Section -->
            <div class="col-md-5">
                <img src="{{ asset('images/about_img_02.png') }}" alt="About University" class="img-fluid">
            </div>

            <!-- Content Section -->
            <div class="col-md-6">
                <div class="mb-3">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span class="fw-bold ms-2 accent-color">About Our University</span>
                </div>

                <h1 class="fw-bold display-5">
                    A Few Words <br>About the <br>University
                </h1>

                <p class="about-para">
                    Our community is being called to reimagine the future. As the only university where a renowned
                    design school comes together with premier colleges, we are making learning more relevant and
                    transformational.
                </p>

                <p class="text-secondary">
                    We are proud to offer top range in employment services such as payroll and benefits
                    administration management and assistance with global business. Readings from
                    religious texts or literature are also commonly in compliance.
                </p>

                <!-- Features -->
                <div class="d-flex flex-col align-items-center gap-4 my-4 flex-wrap ">

                    <!-- Feature 1 -->
                    <div class="d-flex gap-3">
                        {{-- <div class="p-2 text-center rounded-circle bg-primary text-white fw-bold">
                                <p>01</p>
                                
                            </div> --}}
                        <div>
                            <p class="p-3 rounded-circle bg-org text-white fw-bold">01</p>
                        </div>


                        <div class="gap-2">
                            <h2 class="fw-semibold h5 fs-3">Doctoral Degrees</h2>
                            <p class="text-muted small">
                                consectetur adipiscing elit sed do eiusmod tempor incididunt.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="d-flex gap-3">
                        <div>
                            <p class="p-3 rounded-circle bg-org text-white fw-bold">02</p>
                        </div>
                        <div class="gap-2">
                            <h2 class="fw-semibold h5 fs-3">Master’s Degrees</h2>
                            <p class="text-muted small">
                                consectetur adipiscing elit sed do eiusmod tempor incididunt.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Read More Button -->
                <div>
                    <a href="#" class="btn me-2 btn-more text-white">
                        Read More <i class="fa-solid fa-arrow-right-long ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="row py-5 px-4">
        <div>
            <!-- Section Header -->
            <div class="mb-3">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="fw-bold ms-2 accent-color">About Our University</span>
            </div>

            <h1 class="fw-bold display-5 mb-4">
                Graduate Programs
            </h1>

            <!-- Cards Row -->
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <!-- Card 1 -->
                <div class="col">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/couress-img-1.jpg') }}" class="card-img-top" alt="Computer Science">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-4 my-2">MSc in Computer Science</h5>
                            <p class="card-text text-secondary mb-2">
                                A comprehensive program focusing on artificial intelligence, data science, and
                                advanced programming concepts to prepare students for high-demand tech careers.
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-1 text-primary px-3 pb-3">
                            <p class="mb-0 fw-semibold accent-color">Read More</p>
                            <i class="fa-solid fa-arrow-right accent-color"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/couress-img-6.jpg') }}" class="card-img-top"
                            alt="Business Administration">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-4 my-2">MBA in Business Administration</h5>
                            <p class="card-text text-secondary mb-2">
                                Develop leadership, strategic thinking, and entrepreneurial skills through
                                real-world case studies and industry-driven learning.
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-1 text-primary px-3 pb-3 accent-color">
                            <p class="mb-0 fw-semibold accent-color">Read More</p>
                            <i class="fa-solid fa-arrow-right accent-color"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/couress-img-3.jpg') }}" class="card-img-top"
                            alt="Environmental Science">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-4 my-2">MSc in Environmental Science</h5>
                            <p class="card-text text-secondary mb-2">
                                Focus on sustainability, climate change, and natural resource management to address
                                global environmental challenges.
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-1 text-primary px-3 pb-3">
                            <p class="mb-0 fw-semibold accent-color">Read More</p>
                            <i class="fa-solid fa-arrow-right accent-color"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/couress-img-4.jpg') }}" class="card-img-top"
                            alt="Education Leadership">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-4 my-2">MEd in Educational Leadership</h5>
                            <p class="card-text text-secondary mb-2">
                                Prepare for leadership roles in education with a focus on curriculum development,
                                policy, and school management.
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-1 text-primary px-3 pb-3">
                            <p class="mb-0 fw-semibold accent-color">Read More</p>
                            <i class="fa-solid fa-arrow-right accent-color"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/couress-img-5.jpg') }}" class="card-img-top" alt="Public Health">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-4 my-2">MPH in Public Health</h5>
                            <p class="card-text text-secondary mb-2">
                                Learn to design and implement public health programs, conduct research, and
                                influence health policy at national and global levels.
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-1 text-primary px-3 pb-3">
                            <p class="mb-0 fw-semibold accent-color">Read More</p>
                            <i class="fa-solid fa-arrow-right accent-color"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/couress-img-1.jpg') }}" class="card-img-top" alt="Engineering">
                        <div class="card-body">
                            <h5 class="card-title fw-bold fs-4 my-2">MEng in Civil Engineering</h5>
                            <p class="card-text text-secondary mb-2">
                                Gain expertise in structural design, sustainable construction, and modern
                                engineering technologies for large-scale infrastructure projects.
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-1 text-primary px-3 pb-3">
                            <p class="mb-0 fw-semibold accent-color">Read More</p>
                            <i class="fa-solid fa-arrow-right accent-color"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class=" row py-5 ">
        <div class="position-relative "
            style="background-image: url('{{ asset('images/slider_bg_01.png') }}'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;">

            <!-- Overlay -->
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-75"></div>

            <div class="container position-relative py-5">
                <div class="row text-center text-white g-4 justify-content-center">

                    <!-- Card 1 -->
                    <div class="col-6 col-md-3">
                        <div class="p-4 rounded-circle border border-white border-opacity-75 d-inline-block"
                            style="background:white ;">
                            <i class="fa-solid fa-book  fs-1 accent-color"></i>
                        </div>
                        <h3 class="fw-bold fs-2 mt-2 accent-color">19+</h3>
                        <h3 class="fw-bold fs-5 accent-color">Programs</h3>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-6 col-md-3">
                        <div class="p-4 rounded-circle border border-white border-opacity-75 d-inline-block"
                            style="background: rgba(255,255,255);">
                            <i class="fa-solid fa-user  fs-1 accent-color"></i>
                        </div>
                        <h3 class="fw-bold fs-2 mt-2 accent-color">300+</h3>
                        <h3 class="fw-bold fs-5 accent-color">Faculty Numbers</h3>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-6 col-md-3">
                        <div class="p-4 rounded-circle border border-white border-opacity-75 d-inline-block"
                            style="background: rgba(255,255,255);">
                            <i class="fa-solid fa-users accent-color fs-1"></i>
                        </div>
                        <h3 class="fw-bold fs-2 mt-2 accent-color">6000+</h3>
                        <h3 class="fw-bold fs-5 accent-color">Current Students</h3>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-6 col-md-3">
                        <div class="p-4 rounded-circle border border-white border-opacity-75 d-inline-block"
                            style="background: rgba(255,255,255);">
                            <i class="fa-solid fa-graduation-cap accent-color fs-1"></i>
                        </div>
                        <h3 class="fw-bold fs-2 mt-2 accent-color">25000+</h3>
                        <h3 class="fw-bold fs-5 accent-color">Alumni</h3>
                    </div>
                </div>

                <!-- Application Button -->
                <div class="text-center mt-5">
                    <a href="#" class="btn  btn-more btn-hover-white">
                        <i class="fa-solid fa-pencil fs-4"></i> Online Application
                    </a>
                </div>
            </div>
        </div>

    </section>

    <section class="row px-4">
        <div class="container my-5">
            <div class="row g-4">
                <!-- Message Section -->
                <div class="col-md-8 shadow p-4">
                    <h1 class="fs-2 accent-color fw-bold ">Message from the Vice Chancellor</h1>
                    <p class="mt-3 para-color">
                        Premier University was first It is with great honour and humility that
                        I assume the role of Vice Chancellor of Premier University, Chittagong.
                        As I embark on this important journey, my commitment is to advance the university’s core
                        principles while guiding it toward a future defined by academic excellence,
                        innovative research, and active community involvement.
                    </p>
                    <p class="mt-2 para-color">
                        Premier University is entering an exciting phase of transformation,
                        marked by new opportunities and increasing global engagement.
                        My goal is to cultivate an inclusive, supportive academic environment where intellectual
                        curiosity, ethical values, and a spirit of lifelong learning are deeply embedded.
                        We are dedicated to continually improving our educational standards,
                        empowering our faculty through professional development, and fostering a campus culture
                        free from discrimination.
                    </p>
                    <p class="mt-2 para-color">
                        By working collaboratively with our academic and administrative teams,
                        students, alumni, and partners, I am confident we can strengthen Premier University’s
                        reputation as a leading institution that educates not only minds but also future leaders
                        committed to positive social change.
                    </p>
                </div>

                <!-- Image & Info Section -->
                <div
                    class="col-md-4 shadow text-center px-4 py-5 d-flex flex-column align-items-center justify-content-center gap-3">
                    <div>
                        <img src="{{ asset('images/chancellor.jpg') }}" alt="Chancellor" class="img-fluid"
                            style="height: 200px; width: 180px; object-fit: cover;">
                    </div>
                    <h3 class="fs-5 text-dark mb-1">Professor S M Nasrul Quadir</h3>
                    <h1 class="accent-color fs-4 fw-semibold">
                        Vice Chancellor <br> Premier University
                    </h1>
                </div>
            </div>
        </div>

    </section>

    <section class="row px-4 py-5 mb-5"
        style="background: url('{{ asset('images/search_bg.png') }}') center center / cover no-repeat;">
        <div class="col-md-6 pt-md-5 ps-md-5">
            <div class="mb-4">
                <h1 class="fw-bold fs-1 text-white">Search For Courses</h1>
                <p class="mb text-white">
                    Our community is being called to reimagine the future. As the only university where a renowned
                    design school comes together with premier colleges, we are making learning more relevant and
                    transformational.
                </p>
            </div>

            <form action="#" method="GET" class="row g-4">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control rounded-lg py-2 px-3 text-secondary"
                        placeholder="Your Name">
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control rounded-lg py-2 px-3 text-secondary"
                        placeholder="Your Email">
                </div>
                <div class="col-md-6">
                    <select name="instructor" class="form-select rounded-lg py-2 px-3 text-secondary">
                        <option selected disabled>Instructor</option>
                        <option>John Doe</option>
                        <option>Jane Smith</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="department" class="form-select rounded-lg py-2 px-3 text-secondary">
                        <option selected disabled>Department</option>
                        <option>Computer Science</option>
                        <option>Business</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="campus" class="form-select rounded-lg py-2 px-3 text-secondary">
                        <option selected disabled>Campus</option>
                        <option>Main Campus</option>
                        <option>City Campus</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="level" class="form-select rounded-lg py-2 px-3 text-secondary">
                        <option selected disabled>Level</option>
                        <option>Undergraduate</option>
                        <option>Graduate</option>
                    </select>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-more rounded-lg w-100 py-3 text-white">
                        Search Courses Here <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
