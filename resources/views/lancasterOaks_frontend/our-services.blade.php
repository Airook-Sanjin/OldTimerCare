@extends('Skeletons/Header&Footer')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/lancaster-oaks.css') }}">
@endsection
@section('content')
  <div class="container">
    <div class="hero-wrapper">
      <div class="hero-split">
        <h1>Our services</h1>
        <p class="margin-bottom-24px">Lancaster Oaks offers a comprehensive range of senior care services designed to enhance comfort, dignity, and quality of life.</p>
        <p class="margin-bottom-24px">Lancaster Oaks offers a comprehensive range of senior care services designed to enhance comofort, dignity, and quality of life. Our frained team provides support that adapts to the physical, emotional and social needs of every individual.</p>
      </div>
      <div class="hero-split"><img src="{{asset('images/PatientandCaregiver2.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="shadow-two"></div>
    </div>
  </div>
  <section>
    <section>
      <div id="w-node-_6f7b5876-12a2-f3a6-4933-ed101ba2263f-46cb5318" class="w-layout-layout quick-stack wf-layout-layout">
        <div class="w-layout-cell"><img src="{{asset('images/PatientsFun.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="image-3">
          <h2 class="heading-4">Assisted Living</h2>
          <p class="paragraph-4">Daily support with bathing, dressing, meals and medication</p>
        </div>
        <div class="w-layout-cell"><img src="{{asset('images/PatientCouple.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="image-3">
          <h2 class="heading-4">Memory Care</h2>
          <p class="paragraph-4">Specialsied in care for resident living with Alzheimer&#x27;s and dimentia.</p>
        </div>
        <div class="w-layout-cell"><img src="{{asset('images/TwoPatients.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="image-3">
          <h2 class="heading-4">Skilled Nursing</h2>
          <p class="paragraph-4">24/7 medical support from licensed nurses and care specialists.</p>
        </div>
        <div class="w-layout-cell"><img src="{{asset('images/ThreePatients.jpg') }}" loading="lazy" sizes="(max-width: 640px) 100vw, 640px"  alt="" class="image-3">
          <h2 class="heading-4">Rehabilitation</h2>
          <p class="paragraph-4">Physical, occupational, and speech therapy supporting independence.</p>
        </div>
      </div>
    </section>
    <section>
      <div id="w-node-faa90325-88e7-1921-8856-ca7c5c22a5d9-46cb5318" class="w-layout-layout wf-layout-layout">
        <div class="w-layout-cell">
          <h1 class="heading-2">💊</h1>
          <h1 class="heading-3">Medical<br>Management</h1>
          <p class="paragraph-3">Safe, reliable administation and monitoring of medications</p>
        </div>
        <div class="w-layout-cell">
          <h1 class="heading-2">‍🚐</h1>
          <h1 class="heading-3">Transportation Services</h1>
          <p class="paragraph-3">Safe transportation for appointments and community outings.</p>
        </div>
        <div class="w-layout-cell">
          <h1 class="heading-2">🏠🏠</h1>
          <h1 class="heading-3">Housekeeping &amp; Laundry</h1>
          <p class="paragraph-3">Regular cleaning, linen service and personal laundry assitance.</p>
        </div>
      </div>
      <section class="section">
        <blockquote class="block-quote-2">&quot;The team at lancaster Oaks provides care that trully comes from the heart.&quot;</blockquote>
      </section>
    </section>
    @endsection
