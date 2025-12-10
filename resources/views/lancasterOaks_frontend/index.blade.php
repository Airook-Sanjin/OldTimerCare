@extends('Skeletons/Header&Footer')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/lancaster-oaks.css') }}">
@section('content')
   <div class="container">
    <div class="w-layout-grid hero-wrapper">
      <div class="hero-split">
        <h1>Where Care Takes Roots</h1>
        <p class="margin-bottom-24px">A warm, supportive environmental where residents thrive.<br><br> We offer personalized care, engaging activities, and a true sense of belonging.</p>
      </div>
      <div class="hero-split"><img src="{{asset('images/PatientandCaregiver.png') }}" loading="lazy" srcset=" {{asset('images/PatientandCaregiver.png') }}" alt="" class="shadow-two"></div>
    </div>
  </div>
  <section>
    <div class="container"></div>
    <div class="brix---container-default w-container">
      <section class="Grid-Cells">
        <div id="w-node-_44b9f9b2-1edf-7076-2e4a-b28ca90ae8ac-4cf4282d" class="w-layout-layout quick-stack-2 wf-layout-layout">
          <div class="w-layout-cell">
            <h1 class="heading-2">🩺</h1>
            <h1 class="heading-3">24 / 7 Medical Support</h1>
          </div>
          <div class="w-layout-cell">
            <h1 class="heading-2">‍🍎</h1>
            <h1 class="heading-3">Nutritious<br>Meals</h1>
          </div>
          <div class="w-layout-cell">
            <h1 class="heading-2">🎭</h1>
            <h1 class="heading-3">Recreational Activities</h1>
          </div>
        </div>
      </section>
      <h2 class="brix---heading-h2-size">About Our Facility</h2>
      <div data-w-id="23999c30-6009-43a5-67fd-43c020291ef7"  class="w-layout-grid brix---gallery-v2-wrapper">
        <div class="w-layout-grid brix---gallery-v2-col-left">
          <div class="brix---image-wrapper-br-24px"><img src="{{asset('images/Lancater-Oaks-building.jpg') }}" alt="" sizes="(max-width: 640px) 100vw, 640px"  class="brix---image"></div>
          <p class="brix---paragraph-default">Discover a place that feels like home.<br><br>Modern rooms designed for comfort mobility and safety.</p>
          <div>
            <a href="our-facility.html" class="text-block">Learn More About Our Facility</a>
          </div>
        </div>
        <div class="w-layout-grid brix---gallery-v2-col-right">
          <div class="brix---image-wrapper-br-24px"><img src="{{asset('images/PatientandCaregiver2.jpg') }}" alt="" sizes="(max-width: 640px) 100vw, 640px"  class="brix---image"></div>
          <p class="brix---paragraph-default">➡ Special private &amp; Shared rooms available<br>‍<br>➡ Beautifull Outdoor Courtyard<br>‍<br>➡ 24 / 7 on - site staff<br>‍<br>➡ Secure and Safe Facility</p>
        </div>
      </div>
    </div>
    <div class="brix---container-default w-container"></div>
  </section>
  
  @endsection 
  <!-- <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=693781f7a7b5023e4cf42813" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
