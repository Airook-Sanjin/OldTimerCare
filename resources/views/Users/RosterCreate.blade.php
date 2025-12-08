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
        <a class="btn" href="?month={{ $date->copy()->subMonth()->format('Y-m') }}">< Prev</a>
        <div class="month">
          <strong>{{$date->format('F Y')}}</strong>
          <div style="font-size:12px;color:var(--muted)"></div>
         </div>
        <a class='btn'href="?month={{ $date->copy()->addMonth()->format('Y-m') }}">Next ></a>
      </div>
    </header>

    @php
        $firstDay= $date->copy()->startOfMonth();
        $startingDayofWeek =$firstDay->dayOfWeek;
        $daysInMonth = $date->daysInMonth;
        $offset = $startingDayofWeek===0?6:$startingDayofWeek
    @endphp
    <!-- {{$startingDayofWeek}} -->

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
        @for($day = 1; $day <= $daysInMonth; $day++)
            <div class="cell" data-date="{{ $date->format('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT) }}">
                <div class="date-num">{{ $day }}</div>
            

                <div class="slots">
                    @csrf
                    @foreach($timeslots as $timeslot)
                        <div class="slot">

                            @php
                                $dateString = $date->format('Y-m-') . str_pad($day, 2, '0', STR_PAD_LEFT);
                                $assigned = $scheduled[$dateString][$timeslot->TimeslotId] ?? null;
                                $alreadyAssigned = $scheduled[$dateString] ?? [];
                                unset($alreadyAssigned[$timeslot->TimeslotId]);
                            @endphp

                            <label>{{$timeslot->label}}</label>

                                <ul class="TimeslotCellList">
                                    @foreach($employees as $employee)
                                        @if(in_array($employee->EmployeeID, $alreadyAssigned))
                                            <li value="{{ $employee->EmployeeID }}">
                                                {{ $employee->FirstName }}
                                            </li>
                                        @else
                                        @endif
                                    @endforeach
                                </ul>       
                        </div>
                                @endforeach
                </div>
            </div>       
        @endfor


        <!-- BEginning of the side panel -->
            <div id="side-panel" class="side-panel">
                <button id="close-panel">&times;</button>
                <h3 id="panel-date"></h3>
                <div id="working-today" class="working-box"></div>
                <form id="assign-form" action="{{ route('roster.assign') }}" method="POST">
                    @csrf
                    <input type="hidden" name="date" id="form-date">
                    <div id="timeslot-selects">
                        <!-- Timeslot dropdowns will be injected here -->
                    </div>
                    <button type="submit">Save Assignment</button>
                </form>
            </div>
            <!-- end of panel -->

    </div>
</div>
@endsection
@section('scripts')
<script type="application/json" id="js-employee-roles">
    {!! json_encode($employeeRoles) !!}
</script>
<script type="application/json" id="js-patients">
    {!! json_encode($patients) !!}
</script>
    <script type="application/json" id="js-timeslots">
    {!! json_encode($timeslots) !!}
</script>
<script type="application/json" id="js-employees">
    {!! json_encode($employees) !!}
</script>
<script type="application/json" id="js-scheduled">
    {!! json_encode($scheduled) !!}
</script>
<script src="{{ asset('js/Calendar.js') }}"></script>
@endsection