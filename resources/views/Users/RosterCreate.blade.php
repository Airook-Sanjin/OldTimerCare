@extends('Skeletons/Header&Footer')
@section('title','Roster')
@section('content')
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Quick Employee Calendar (HTML + CSS)</title>
  <style>
    :root{
      --bg:#f5f7fb;
      --card:#ffffff;
      --muted:#6b7280;
      --accent:#2563eb;
      --border:#e6e9ef;
      --cell-min-height:120px;
      font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
    html,body{height:100%;margin:0;background:var(--bg);color:#111827}
    .wrap{max-width:1100px;margin:28px auto;padding:20px}
    header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
    h1{font-size:18px;margin:0}
    .controls{display:flex;gap:8px;align-items:center}
    .btn{background:var(--card);border:1px solid var(--border);padding:8px 12px;border-radius:8px;cursor:pointer}
    .month{background:linear-gradient(90deg,#fff, #fbfdff);border:1px solid var(--border);padding:12px;border-radius:12px}

    /* Calendar grid */
    .calendar{display:grid;grid-template-columns:repeat(7,1fr);gap:8px;margin-top:12px}
    .weekday{background:transparent;padding:6px 8px;color:var(--muted);font-size:13px;text-align:center}
    .cell{background:var(--card);border:1px solid var(--border);padding:10px;min-height:var(--cell-min-height);border-radius:8px;display:flex;flex-direction:column}
    .date-num{margin-left:auto;font-weight:600;color:var(--muted);font-size:13px}

    /* inside cell: list of time slots */
    .slots{margin-top:8px;display:flex;flex-direction:column;gap:6px}
    .slot{display:flex;gap:8px;align-items:center}
    .slot label{font-size:12px;color:var(--muted);min-width:64px}
    select{flex:1;padding:6px;border-radius:6px;border:1px solid var(--border);background:#fff}

    /* small helper */
    .note{font-size:13px;color:var(--muted);margin-top:10px}

    /* responsive */
    @media (max-width:800px){
      .calendar{grid-template-columns:repeat(2,1fr)}
    }
    @media (min-width:801px) and (max-width:1100px){
      .calendar{grid-template-columns:repeat(4,1fr)}
    }
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <h1>Quick Employee Calendar</h1>
      <div class="controls">
        <div class="btn">← Prev</div>
        <div class="month">
          <strong>December 2025</strong>
          <div style="font-size:12px;color:var(--muted)"></div>
        </div>
        <div class="btn">Next →</div>
      </div>
    </header>

    <div class="calendar">
      <div class="weekday">Sun</div>
      <div class="weekday">Mon</div>
      <div class="weekday">Tue</div>
      <div class="weekday">Wed</div>
      <div class="weekday">Thu</div>
      <div class="weekday">Fri</div>
      <div class="weekday">Sat</div>

    

      <div class="cell">
        <div class="date-num">1</div>
        <div class="slots">
          <div class="slot">
            <label>09:00</label>
            <select>
              <option value="">— Assign —</option>
              <option>Alice</option>
              <option>Bob</option>
              <option>Charlie</option>
              <option>Dana</option>
            </select>
          </div>
          <div class="slot">
            <label>13:00</label>
            <select>
              <option value="">— Assign —</option>
              <option>Alice</option>
              <option>Bob</option>
              <option>Charlie</option>
              <option>Dana</option>
            </select>
          </div>
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
      </div>

      <!-- Empty/example cells -->
      <div class="cell"><div class="date-num">8</div></div>
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
      <div class="cell"><div class="date-num">31</div></div>

    </div>

    
  </div>
</body>
</html>

@endsection