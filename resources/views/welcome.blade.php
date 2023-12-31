@extends('layouts.home')

@section('title', 'Beranda')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="d-flex team-vs">
                <span class="score">4-1</span>
                <div class="team-1 w-50">
                    <div class="team-details w-100 text-center">
                        <img src="{{ asset('home/images/logo_1.png') }}" alt="Image" class="img-fluid">
                        <h3>LA LEGA <span>(win)</span></h3>
                        <ul class="list-unstyled">
                            <li>Anja Landry (7)</li>
                            <li>Eadie Salinas (12)</li>
                            <li>Ashton Allen (10)</li>
                            <li>Baxter Metcalfe (5)</li>
                        </ul>
                    </div>
                </div>
                <div class="team-2 w-50">
                    <div class="team-details w-100 text-center">
                        <img src="{{ asset('home/images/logo_2.png') }}" alt="Image" class="img-fluid">
                        <h3>JUVENDU <span>(loss)</span></h3>
                        <ul class="list-unstyled">
                            <li>Macauly Green (3)</li>
                            <li>Arham Stark (8)</li>
                            <li>Stephan Murillo (9)</li>
                            <li>Ned Ritter (5)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="latest-news">
    <div class="container">
        <div class="row">
            <div class="col-12 title-section">
                <h2 class="heading">Latest News</h2>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md-4">
                <div class="post-entry">
                    <a href="#">
                        <img src="{{ asset('home/images/player1.jpg') }}" alt="Image" class="img-fluid">
                    </a>
                    <div class="caption">
                        <div class="caption-inner">
                            <h3 class="mb-3">Romolu to stay at Real Nadrid?</h3>
                            <div class="author d-flex align-items-center">
                                <div class="img mb-2 mr-3">
                                    <img src="{{ asset('home/images/person_1.jpg') }}" alt="">
                                </div>
                                <div class="text">
                                    <h4>Mellissa Allison</h4>
                                    <span>May 19, 2020 &bullet; Sports</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-entry">
                    <a href="#">
                        <img src="{{ asset('home/images/player2.jpg') }}" alt="Image" class="img-fluid">
                    </a>
                    <div class="caption">
                        <div class="caption-inner">
                            <h3 class="mb-3">Kai Nets Double To Secure Comfortable Away Win</h3>
                            <div class="author d-flex align-items-center">
                                <div class="img mb-2 mr-3">
                                    <img src="{{ asset('home/images/person_1.jpg') }}" alt="">
                                </div>
                                <div class="text">
                                    <h4>Mellissa Allison</h4>
                                    <span>May 19, 2020 &bullet; Sports</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-entry">
                    <a href="#">
                        <img src="{{ asset('home/images/player3.jpg') }}" alt="Image" class="img-fluid">
                    </a>
                    <div class="caption">
                        <div class="caption-inner">
                            <h3 class="mb-3">Dogba set for Juvendu return?</h3>
                            <div class="author d-flex align-items-center">
                                <div class="img mb-2 mr-3">
                                    <img src="{{ asset('home/images/person_1.jpg') }}" alt="">
                                </div>
                                <div class="text">
                                    <h4>Mellissa Allison</h4>
                                    <span>May 19, 2020 &bullet; Sports</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection