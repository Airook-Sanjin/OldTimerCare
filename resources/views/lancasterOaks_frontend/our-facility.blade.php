@extends('Skeletons/Header&Footer')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/lancaster-oaks.css') }}">
@endsection
@section('content')
  <div class="container">
    <div class="hero-wrapper">
      <div class="hero-split">
        <h1>Our Facility</h1>
        <p class="margin-bottom-24px">A warm welcome environment designed to feel like home</p>
      </div>
      <div class="hero-split"><img src="{{asset('images/Lancater-Oaks-building.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="shadow-two"></div>
    </div>
  </div>
  <section>
    <section>
      <div id="w-node-bb9b0f64-3cb6-03c5-59b6-06b976f71ac7-9714e3db" class="w-layout-layout wf-layout-layout">
        <div class="w-layout-cell"><img src="{{ asset('images/InsideBuilding2.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt=""></div>
        <div class="w-layout-cell">
          <h1 class="heading-5">Designed for comfort &amp; Independence</h1>
          <p class="paragraph-5">Our facility is thoughtfully designed to be calming and homelike. Priortizing safety and easy navigation for greater independece regardless of mobility level.</p>
        </div>
      </div>
    </section>
    <section>
      <div id="w-node-faa90325-88e7-1921-8856-ca7c5c22a5d9-9714e3db" class="w-layout-layout quick-stack-2 wf-layout-layout">
        <div class="w-layout-cell">
          <h1 class="heading-2">🛏️</h1>
          <h1 class="heading-3">Private &amp; Shared Rooms</h1>
          <p class="paragraph-3">Comfortable spacius rooms designed for rest and relaxation.</p>
        </div>
        <div class="w-layout-cell">
          <h1 class="heading-2">🪻</h1>
          <h1 class="heading-3">Beautifull Courtyard</h1>
          <p class="paragraph-3">Safe and natural space for fresh air air, walks and activities.</p>
        </div>
        <div class="w-layout-cell">
          <h1 class="heading-2">‍🍴</h1>
          <h1 class="heading-3">Dinning<br>Hall</h1>
          <p class="paragraph-3">Fresh meals prepared daily, in a warm community setting.</p>
        </div>
        <div class="w-layout-cell">
          <h1 class="heading-2">🩺</h1>
          <h1 class="heading-3">On-Site Medical Support</h1>
          <p class="paragraph-3">24 / 7 professional care within the facility.</p>
        </div>
      </div>
      <section class="section">
        <div id="w-node-_81969cfb-9ab2-1334-fec2-32662f1f6acf-9714e3db" class="w-layout-layout wf-layout-layout">
          <div class="w-layout-cell"><img src="{{asset('images/PatientCouple.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="image-4"></div>
          <div class="w-layout-cell"><img src="{{asset('images/InsideBuilding.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="image-4"></div>
          <div class="w-layout-cell"><img src="{{asset('images/ThreePatientTalking.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="image-4"></div>
          <div class="w-layout-cell">
            <blockquote class="block-quote-3">&quot;Lancaster Oaks provides a safe, beautiful, and uplifiting place for seniors to thrive.&quot;</blockquote>
          </div>
        </div>
      </section>
    </section>
    @endsection
