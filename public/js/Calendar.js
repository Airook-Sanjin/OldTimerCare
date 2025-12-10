document.addEventListener('DOMContentLoaded', () => {
let cells = document.querySelectorAll('.calendar .cell');
let panel = document.getElementById('side-panel');
let panelDate = document.getElementById('panel-date');
let formDate = document.getElementById('form-date');
let PatientformDate = document.getElementById('Patient-form-date');

let CaregiverTimeslotContainer = document.getElementById('Caregiver-timeslot-selects');
let DoctorTimeslotContainer = document.getElementById('Doctor-timeslot-selects');
let SupervisorTimeslotContainer = document.getElementById('Supervisor-timeslot-selects');



let closeBtn = document.getElementById('close-panel');


    const employeeRoles = JSON.parse(document.getElementById('js-employee-roles').textContent);
    const patients = JSON.parse(document.getElementById('js-patients').textContent);
    const timeslots = JSON.parse(document.getElementById('js-timeslots').textContent);
    const employees = JSON.parse(document.getElementById('js-employees').textContent);
    const scheduled = JSON.parse(document.getElementById('js-scheduled').textContent);
    const simpleScheduled = JSON.parse(document.getElementById('js-simpleScheduled').textContent);

    
cells.forEach(cell => {
    cell.addEventListener('click', () => {
        let date = cell.dataset.date;
        
        PatientformDate.value = date;

    function showWorkingForDay(date) {
        let workingDiv = document.getElementById('working-today');
        workingDiv.innerHTML = ``; // reset
        // console.log("scheduled today:", scheduled[date]);

        // Find all employees assigned to this date
        let todayAssignments = simpleScheduled[date] ?? {};
        console.log("Today assignments:", todayAssignments);

        // Group by employee
        let employeesWorking = [];

        Object.values(todayAssignments).forEach(arr => {
            arr.forEach(empId => {
                let emp = employeeRoles.find(e => e.EmployeeID == empId);
            if (emp) employeesWorking.push(emp);
            });
            
        });

        // Build role sections
        const roles = ["Supervisor", "Doctor", "Caregiver"];

        roles.forEach(role => {
            const list = employeesWorking.filter(e => e.Role === role);
            // console.log(list);
            let html = `<div class='role-group'><h4>${role}s</h4>`;

            if (list.length === 0) {
                html += `<p><em>No ${role.toLowerCase()} assigned.</em></p>`;
            } else {
                html += "<ul>";
                list.forEach(e => {
                    console.log(list)
                    html += `<li>${e.FirstName}`;
                    // If caregiver → show patients
                    if (role === "Caregiver") {
                        
                        let todaysSchedule = scheduled[date]??[];
                        let PatientID = [];
                        Object.values(todaysSchedule).forEach(slotEntries=>{
                            slotEntries.forEach(entry => {
                                if (entry.EmployeeID == e.EmployeeID && entry.PatientID){
                                    PatientID.push(entry.PatientID)
                                }
                            })
                        })
                        let assignedPatients = PatientID.map(pid =>{
                            let p =patients.find(x=>x.PatientID==pid);
                            return p ? p.FirstName :'Unknown';
                        });

                        if (assignedPatients.length > 0) {
                            html += ` — Patient: ${assignedPatients.join(', ')}`;
                        } else {
                            html += ` — No patients assigned`;
                        }
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
        

        CaregiverTimeslotContainer.innerHTML = '<h4>Caregivers</h4>';
        DoctorTimeslotContainer.innerHTML = '<h4>Doctors</h4>';
        SupervisorTimeslotContainer.innerHTML = '<h4>Supervisor</h4>';

        let PatientTimeslotContainer = document.getElementById('Patient-timeslot-selects');
            PatientTimeslotContainer.innerHTML = '';
            
        
        

            timeslots.forEach(slot => {
                
                let assigned = simpleScheduled[date]?.[slot.TimeslotId] ?? null;
                let alreadyAssigned = { ...simpleScheduled[date] };
                delete alreadyAssigned[slot.TimeslotId];
                console.log('Assigned', alreadyAssigned);

                 
                    
                    
                    if(slot.TimeslotId !== 4){
// ---------------------------------------------------------
                
                let scheduledForSlot = (scheduled[date] && scheduled[date][slot.TimeslotId]) ||[];
                if(!scheduledForSlot.length){
                    PatientTimeslotContainer.innerHTML += `
                    <div class='slot'>
                        <h6>${slot.label}</h6>
                        <p class="muted">No caregivers scheduled for this shift.</p>
                    </div>
                    `;
                    
                }
                let slotSection = `<div class="slot"><h6>${slot.label}</h6>`;
                scheduledForSlot.forEach(s=>{
                    let emp = employees.find(e => e.EmployeeID == s.EmployeeID);
                    if(!emp)return;
                    let prePatientID = s.PatientID ?? '';
                    let options = `<option value=""> --Select Patient--</option>`;
                    if(emp.RoleID===4){
                    // let html = `<div class="caregiver-assign">
                    // <label>${emp.FirstName} ${emp.LastName}</label>
                    // <select name="assignPatient[${slot.TimeslotId}][${emp.EmployeeID}]">
                    // <option value="">-- Select Patient --</option>`;

                    patients.forEach(p=>{
                        let sel = (String(p.PatientID) === String(prePatientID)) ? 'selected' : '';
                        options += `<option value ="${p.PatientID}" ${sel}> ${p.FirstName}</option>`;
                        }); 
                        slotSection+=`
                            <div class="caregiver-assign">
                                <label>${emp.FirstName} ${emp.LastName}</label>
                                <select name="assignPatient[${slot.TimeslotId}][${emp.EmployeeID}]">
                                    ${options}
                                </select>
                            </div>
                        `;
                        }    
                    });
                    slotSection+=`</div>`;
                     PatientTimeslotContainer.innerHTML+=slotSection; 
//  ------------------------------------------------------

                    let CaregiverSelectHTML = `<div class="slot">
                        <label>${slot.label}</label>
                        <select name="assignEmployee[caregiver][${slot.TimeslotId}]">
                            <option value="">-- Select Caregiver --</option>`;
                    
                        
                    // Caregivers Assignmentselect dropdown
                    employees.forEach(emp => {
                        let exclude=[1,2,3];
                        let isExcluded = exclude.some(x => x === emp.RoleID);

                        if (!isExcluded) {
                            let selected = assigned == emp.EmployeeID ? 'selected' : '';
                            CaregiverSelectHTML += `<option value="${emp.EmployeeID}" ${selected}>${emp.FirstName}</option>`;
                        }
                        });

                        CaregiverSelectHTML += '</select></div>';
                        CaregiverTimeslotContainer.innerHTML += CaregiverSelectHTML;

                        

                        // Patient Form
                        
                    }
                if(slot.TimeslotId === 4){
                    
                    // console.log('WAHDFAH')
                //    console.log('alreadyAssigned', alreadyAssigned[4]);

                    let DoctorSelectHTML = `<div class="slot">
                    <label>${slot.label}</label>
                    <select name="assignEmployee[doctor][${slot.TimeslotId}]">
                    <option value="">-- Select Doctor --</option>`;

                    
                       // Doctor select dropdown
                    employees.forEach(emp => {
                        let exclude=[1,2,4];
                        let isExcluded = exclude.some(x => x === emp.RoleID);

                        if (!isExcluded) {
                            let selected = Array.isArray(assigned) && assigned.includes(emp.EmployeeID) ? 'selected' : '';
                            DoctorSelectHTML += `<option value="${emp.EmployeeID}" ${selected}>${emp.FirstName}</option>`;
                        }
                        });
                        DoctorSelectHTML += '</select></div>';
                        DoctorTimeslotContainer.innerHTML += DoctorSelectHTML;

                        let SupervisorSelectHTML = `<div class="slot">
                            <label>${slot.label}</label>
                            <select name="assignEmployee[supervisor][${slot.TimeslotId}]">
                            <option value="">-- Select Supervisor --</option>`;
                            
                        employees.forEach(emp => {
                        let exclude=[1,3,4];
                        let isExcluded = exclude.some(x => x === emp.RoleID);

                        if (!isExcluded) {
                            let selected = Array.isArray(assigned) && assigned.includes(emp.EmployeeID) ? 'selected' : '';
                            SupervisorSelectHTML += `<option value="${emp.EmployeeID}" ${selected}>${emp.FirstName}</option>`;
                        }
                        });
                        
                        SupervisorSelectHTML += '</select></div>';
                        SupervisorTimeslotContainer.innerHTML += SupervisorSelectHTML;

                }
                
                
            });

           

            

    });
});

closeBtn.addEventListener('click', () => {
    panel.classList.remove('open');
});
});
