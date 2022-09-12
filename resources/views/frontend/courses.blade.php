@extends('frontend.layouts.default')

@section('content')

<link href="{{ asset('css/courses-page.css') }}" rel="stylesheet">
<main id="main">
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Course</h2>
            <!-- <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p> -->
        </div>
    </div>
    <!-- ======= About Section ======= -->
    <section id="about" class="about" style="padding-top: 20px;">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <div class="flex">
                        <div class="flex-item">
                            <img src="https://betterstudio.com/wp-content/uploads/2019/05/1-1-instagram-1024x1024.jpg" alt="image">
                            <h2 class="title">Image title</h1>
                        </div>

                        <div class="flex-item">
                            <img src="https://betterstudio.com/wp-content/uploads/2019/05/1-1-instagram-1024x1024.jpg" alt="image">
                            <h2 class="title">Image title</h1>
                        </div>

                        <div class="flex-item">
                            <img src="https://betterstudio.com/wp-content/uploads/2019/05/1-1-instagram-1024x1024.jpg" alt="image">
                            <h2 class="title">Image title</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main>
@endsection