let cells = document.querySelectorAll('.calendar .cell');
let panel = document.getElementById('side-panel');
let panelDate = document.getElementById('panel-date');
let formDate = document.getElementById('form-date');
let timeslotContainer = document.getElementById('timeslot-selects');
let closeBtn = document.getElementById('close-panel');


    const employeeRoles = JSON.parse(document.getElementById('js-employee-roles').textContent);
    const patients = JSON.parse(document.getElementById('js-patients').textContent);
    const timeslots = JSON.parse(document.getElementById('js-timeslots').textContent);
    const employees = JSON.parse(document.getElementById('js-employees').textContent);
    const scheduled = JSON.parse(document.getElementById('js-scheduled').textContent);

    
cells.forEach(cell => {
    cell.addEventListener('click', () => {
        let date = cell.dataset.date;

    function showWorkingForDay(date) {
        const workingDiv = document.getElementById('working-today');
        workingDiv.innerHTML = ""; // reset
    
        // Find all employees assigned to this date
        const todayAssignments = scheduled[date] ?? {};
    
        // Group by employee
        let employeesWorking = [];
    
        Object.values(todayAssignments).forEach(empId => {
            const emp = employeeRoles.find(e => e.EmployeeID == empId);
            if (emp) employeesWorking.push(emp);
        });
        
    
        // Build role sections
        const roles = ["Supervisor", "Doctor", "Caregiver"];
    
        roles.forEach(role => {
            const list = employeesWorking.filter(e => e.Role === role);
        
            let html = `<div class='role-group'><h4>${role}s</h4>`;
        
            if (list.length === 0) {
                html += `<p><em>No ${role.toLowerCase()} assigned.</em></p>`;
            } else {
                html += "<ul>";
                list.forEach(e => {
                    html += `<li>${e.FirstName}`;
                    // If caregiver → show patients
                    if (role === "Caregiver") {
                        const assignedPatients = patients
                            .filter(p => p.CaregiverID == e.EmployeeID)
                            .map(p => {
                                const patient = patients.find(q => q.PatientID == p.PatientID);
                                return patient ? patient.FirstName : "Unknown";
                            });
                        
                        if (assignedPatients.length > 0) {
                            html += ` — Patients: ${assignedPatients.join(', ')}`;
                        } else {
                            html += ` — No patients assigned`;
                        }
                    }
                    if (role === "Supervisor") {
                        const supervisorSlots = Object.entries(todayAssignments)
                        .filter(([slotId, empId]) => empId == e.EmployeeID)
                        .map(([slotId]) => {
                            const slot = timeslots.find(ts => ts.TimeslotId == slotId);
                            return slot ? slot.label : slotId;
                        });
                    
                        html += ` — Timeslots: ${supervisorSlots.join(', ')}`;
            }
        
                html += "</li>";
                });
                html += "</ul>";
            }
        
            html += "</div>";
            workingDiv.innerHTML += html;
        });
    }

        showWorkingForDay(date);


        panel.classList.add('open');
        let [year, month, day] = date.split('-');
        let localDate = new Date(year, month - 1, day);
        let formatted = localDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        panelDate.textContent = formatted;

        formDate.value = date;


        // Build dropdowns for this date
        timeslotContainer.innerHTML = ''; // clear previous

        timeslots.forEach(slot => {
            let assigned = scheduled[date]?.[slot.TimeslotId] ?? null;
            let alreadyAssigned = { ...scheduled[date] };

            delete alreadyAssigned[slot.TimeslotId];

            let selectHTML = `<div class="slot">
                <label>${slot.label}</label>
                <select name="assign[${slot.TimeslotId}]">
                    <option value="">-- Select Employee --</option>`;

            employees.forEach(emp => {
                if (!Object.values(alreadyAssigned).includes(emp.EmployeeID)) {
                    let selected = assigned == emp.EmployeeID ? 'selected' : '';
                    selectHTML += `<option value="${emp.EmployeeID}" ${selected}>${emp.FirstName}</option>`;
                }
            });

            selectHTML += '</select></div>';
            timeslotContainer.innerHTML += selectHTML;
        });

    });
});

closeBtn.addEventListener('click', () => {
    panel.classList.remove('open');
});
