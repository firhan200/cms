@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="content-pad">
    <!--Section: Jumbotron-->
    <section class="card wow fadeIn" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);">

        <!-- Content -->
        <div class="card-body text-white text-center py-5 px-5 my-5">

            <h1 class="mb-4">
                <strong>CMS</strong>
            </h1>
            <p>
                Content Management System Starter<br/>
                Built in <strong>Laravel 5.5</strong>, <strong>Bootstrap 4.0</strong> & <strong>jQuery</strong>
            </p>
            <a target="_blank" href="{{ url('/admin') }}" class="btn btn-outline-white btn-lg">Go To Admin
                <i class="fa fa-link ml-2"></i>
            </a>
        </div>
        <!-- Content -->
    </section>
    <!--Section: Jumbotron-->

    <hr class="my-5">

    <!--Section: More-->
    <section>
    <!--First row-->
      <div class="row features-small mt-5 wow fadeIn">

        <!--Grid column-->
        <div class="col-xl-3 col-lg-6">
          <!--Grid row-->
          <div class="row">
            <div class="col-2">
              <i class="fa fa-cog fa-2x mb-1 indigo-text" aria-hidden="true"></i>
            </div>
            <div class="col-10 mb-2 pl-3">
              <h5 class="feature-title font-bold mb-1">Easy CRUD</h5>
              <p class="grey-text mt-2">simple create, read, update & delete table object.
              </p>
            </div>
          </div>
          <!--/Grid row-->
        </div>
        <!--/Grid column-->

        <!--Grid column-->
        <div class="col-xl-3 col-lg-6">
          <!--Grid row-->
          <div class="row">
            <div class="col-2">
              <i class="fa fa-area-chart fa-2x mb-1 indigo-text" aria-hidden="true"></i>
            </div>
            <div class="col-10 mb-2">
              <h5 class="feature-title font-bold mb-1">Elegant Dashboard</h5>
              <p class="grey-text mt-2">simple & elegant dashboard
              </p>
            </div>
          </div>
          <!--/Grid row-->
        </div>
        <!--/Grid column-->

        <!--Grid column-->
        <div class="col-xl-3 col-lg-6">
          <!--Grid row-->
          <div class="row">
            <div class="col-2">
              <i class="fa fa-github fa-2x mb-1 indigo-text" aria-hidden="true"></i>
            </div>
            <div class="col-10 mb-2">
              <h5 class="feature-title font-bold mb-1">Open Source</h5>
              <p class="grey-text mt-2">available on github
              </p>
            </div>
          </div>
          <!--/Grid row-->
        </div>
        <!--/Grid column-->

        <!--Grid column-->
        <div class="col-xl-3 col-lg-6">
          <!--Grid row-->
          <div class="row">
            <div class="col-2">
              <i class="fa fa-code fa-2x mb-1 indigo-text" aria-hidden="true"></i>
            </div>
            <div class="col-10 mb-2">
              <h5 class="feature-title font-bold mb-1">jQuery 3.x</h5>
              <p class="grey-text mt-2">using mainstream loveable javascript library
              </p>
            </div>
          </div>
          <!--/Grid row-->
        </div>
        <!--/Grid column-->

      </div>
      <!--/First row-->

    </section>
    <!--Section: More-->
</div>
@endsection
