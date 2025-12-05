@extends('Skeletons/Header&Footer')
@section('title','Roster')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/RosterPage/Roster.css') }}">
@endsection
@section('content')


  <div class="wrap">
    <header>
      <h1>Quick Employee Calendar</h1>
      <div class="controls">
        <a class="btn" href="?month={{ $date->copy()->addMonth()->format('Y-m') }}">← Prev</a>
        <div class="month">
          <strong>{{$date->format('F Y')}}</strong>
          <div style="font-size:12px;color:var(--muted)"></div>
        </div>
        <a class='btn'href="?month={{ $date->copy()->subMonth()->format('Y-m') }}">Previous</a>
      </div>
    </header>

    @php
    $firstDay= $date->copy()->startOfMonth();
    $startingDayofWeek =$firstDay->dayOfWeek;
    $daysInMonth = $date->daysInMonth;

    $offset = $startingDayofWeek===0?6:$startingDayofWeek
    @endphp
    {{$startingDayofWeek}}
    <div class="calendar">
              <div class="weekday" id='7'>Sun</div>
      <div class="weekday"id='1'>Mon</div>
      <div class="weekday"id='2'>Tue</div>
      <div class="weekday"id='3'>Wed</div>
      <div class="weekday"id='4'>Thu</div>
      <div class="weekday"id='5'>Fri</div>
      <div class="weekday"id='6'>Sat</div>

      @for ($i = 0; $i < $offset; $i++)
    <div class="cell empty"></div>
  @endfor
    @for($day=1;$day <=$daysInMonth;$day++)
<div class="cell">
        <div class="date-num">{{$day}}</div>
        <div class="slots">
            @foreach($timeslots as $timeslot)
            <div class="slot">
            <label>{{$timeslot->label}}</label>
            <select>
                <option value="">— Assign —</option>
                @foreach($employees as $employee)
                    <option>{{$employee->FirstName}}</option>
                @endforeach
            </select>
          </div>
            @endforeach
    </div>
</div>
    @endfor

<!--       
          <div class="slot">
            <label>17:00</label>
            <select>
              <option value="">— Assign —</option>
              <option>Alice</option>
              <option>Bob</option>
              <option>Charlie</option>
              <option>Dana</option>
            </select>
          </div>
        </div>
      </div>

      <div class="cell">
        <div class="date-num">2</div>
        <div class="slots">
          <div class="slot"><label>09:00</label><select><option>— Assign —</option><option>Alice</option><option>Bob</option><option>Charlie</option></select></div>
          <div class="slot"><label>12:00</label><select><option>— Assign —</option><option>Alice</option><option>Bob</option></select></div>
        </div>
      </div>

      <div class="cell">
        <div class="date-num">3</div>
        <div class="slots">
          <div class="slot"><label>08:00</label><select><option>— Assign —</option><option>Bob</option><option>Charlie</option></select></div>
        </div>
      </div>

      <div class="cell">
        <div class="date-num">4</div>
        <div class="slots">
          <div class="slot"><label>10:00</label><select><option>— Assign —</option><option>Dana</option><option>Alice</option></select></div>
          <div class="slot"><label>15:00</label><select><option>— Assign —</option><option>Bob</option><option>Charlie</option></select></div>
        </div>
      </div>

      <div class="cell">
        <div class="date-num">5</div>
        <div class="slots">
          <div class="slot"><label>09:00</label><select><option>— Assign —</option><option>Alice</option></select></div>
          <div class="slot"><label>14:00</label><select><option>— Assign —</option><option>Charlie</option></select></div>
        </div>
      </div>

      <div class="cell">
        <div class="date-num">6</div>
        <div class="slots">
          <div class="slot"><label>11:00</label><select><option>— Assign —</option><option>Bob</option></select></div>
        </div>
      </div>

      <div class="cell">
        <div class="date-num">7</div>
        <div class="slots">
          <div class="slot"><label>09:00</label><select><option>— Assign —</option><option>Charlie</option></select></div>
          <div class="slot"><label>18:00</label><select><option>— Assign —</option><option>Dana</option></select></div>
        </div>
      </div> -->

      <!-- Empty/example cells -->
      <!-- <div class="cell"><div class="date-num">8</div></div>
      <div class="cell"><div class="date-num">9</div></div>
      <div class="cell"><div class="date-num">10</div></div>
      <div class="cell"><div class="date-num">11</div></div>
      <div class="cell"><div class="date-num">12</div></div>
      <div class="cell"><div class="date-num">13</div></div>
      <div class="cell"><div class="date-num">14</div></div>

      <div class="cell"><div class="date-num">15</div></div>
      <div class="cell"><div class="date-num">16</div></div>
      <div class="cell"><div class="date-num">17</div></div>
      <div class="cell"><div class="date-num">18</div></div>
      <div class="cell"><div class="date-num">19</div></div>
      <div class="cell"><div class="date-num">20</div></div>
      <div class="cell"><div class="date-num">21</div></div>

      <div class="cell"><div class="date-num">22</div></div>
      <div class="cell"><div class="date-num">23</div></div>
      <div class="cell"><div class="date-num">24</div></div>
      <div class="cell"><div class="date-num">25</div></div>
      <div class="cell"><div class="date-num">26</div></div>
      <div class="cell"><div class="date-num">27</div></div>
      <div class="cell"><div class="date-num">28</div></div>

      <div class="cell"><div class="date-num">29</div></div>
      <div class="cell"><div class="date-num">30</div></div>
      <div class="cell"><div class="date-num">31</div></div> -->

    </div>

    
  </div>


@endsection