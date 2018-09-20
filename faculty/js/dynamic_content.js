//options passed to $.multiselect for non-multiple select elements
var selectionConfig = {
    buttonClass: 'selection-toggler',
    buttonText: function(options, select) {
        if(options.length === 0) {
            return '!'
        }
        else {
            var labels = [];
            options.each(function() {
                labels.push(this.dataset.label);
            });
            return labels.join(', ');
        }
    }
    /**
     * TODO: Ensure at least one selection is selected.
     * See: https://github.com/snapappointments/bootstrap-select/issues/1010
     ,onChange: function(option, isChecked) {
        if(!isChecked && $(this).find('option:selected').length === 0) {
            $($(this)[0].nextSibling).on('hidden.bs.dropdown', function() {
                if(nagiisa ang current selection at isChecked === false) {
                    alert('There must at least be one selection.');
                    $($(this)[0].previousSibling).multiselect('select', option[0].value);
                }
            });
        }
    }.bind(this)
    */
}

/**
 * Display faculty information as tables.
 * @param   {Array} faculty          Faculty information and their schedules
 * @param   {Array} inputConstraints Constraints set for input elements
 * @returns {DocumentFragment}     Document fragment containing the list of tables.
 */
function perFacultyTables(faculty, inputConstraints) {
    let content = document.createDocumentFragment();
    let theaders = document.createElement('thead');
    theaders.className = 'thead-light';
    theaders.innerHTML = `
        <th>Subject</th>
        <th>Unit</th>
        <th>Course</th>
        <th>Year & Sec.</th>
        <th>Time</th>
        <th>Days</th>
        <th>Room</th>
        <th>No. of Stud.</th>
    `;

    //for each faculty
    for(let facultyIndex = 0; facultyIndex < faculty.length; ++facultyIndex) {
        let faculty_instance = faculty[facultyIndex];
        let tbody = document.createElement('tbody');

        //for each subject handled  
        for(var subjectIndex = 0; subjectIndex < faculty_instance.subject.length; ++subjectIndex) {
            var subject_instance = faculty_instance.subject[subjectIndex];
            let aggregatedSched = aggregateSchedules(subject_instance.schedule);
            var rowspan = aggregatedSched.length;

            //for each schedule (i.e. combination of class, weekday, time and room) of the subject being taught by the faculty
            for(var schedIndex = 0; schedIndex < aggregatedSched.length; ++schedIndex) {
                let sched_instance = aggregatedSched[schedIndex];
                var tr = document.createElement('tr');
                let td, input, select, option;

                //populate 'Subject' column
                if(schedIndex === 0) {
                    td = document.createElement('td');
                    td.rowSpan = rowspan;

                    //TODO: Add mechanism that populates this selection with options
                    option = document.createElement('option');
                    option.dataset.label = subject_instance.code;
                    option.innerHTML = `${subject_instance.code} &mdash; ${subject_instance.description}`;
                    option.selected = true;

                    select = document.createElement('select');
                    select.className = 'single-selection';
                    select.appendChild(option);
                    select.addEventListener('DOMNodeInserted', function() {
                        $(this).multiselect(selectionConfig);
                    });

                    td.appendChild(select);
                    tr.appendChild(td);
                }

                //populate 'Units' column
                if(schedIndex === 0) {
                    td = document.createElement('td');
                    td.rowSpan = rowspan;

                    //include lecture unit
                    let div = document.createElement('div');
                    div.innerHTML = `<td>Lec: ${parseFloat(subject_instance.unit.lecture).toFixed(2)}</td>`;
                    td.appendChild(div);

                    //include lab unit
                    div = document.createElement('div');
                    div.innerHTML = `<td>Lab: ${parseFloat(subject_instance.unit.lab).toFixed(2)}</td>`;
                    td.appendChild(div);

                    //include credit unit
                    div = document.createElement('div');
                    div.innerHTML = `<td>Cre: ${parseFloat(subject_instance.unit.credit).toFixed(2)}</td>`;
                    td.appendChild(div);
                    tr.appendChild(td);
                }

                //populate 'Course' column
                td = document.createElement('td');

                //TODO: Add mechanism that populates this selection with options
                option = document.createElement('option');
                option.dataset.label = 'WIP';
                option.innerHTML = 'No database support.'; //TODO: Fill this with proper content
                option.selected = true;
                
                select = document.createElement('select');
                select.className = 'single-selection';
                select.appendChild(option);
                select.addEventListener('DOMNodeInserted', function() {
                    $(this).multiselect(selectionConfig);
                });

                td.appendChild(select);
                tr.appendChild(td);
                tbody.appendChild(tr);

                //populate 'Year & Sec.' column
                td = document.createElement('td');

                //TODO: Add mechanism that populates this selection with options
                option = document.createElement('option');
                option.dataset.label = sched_instance.class.block;
                option.innerHTML = sched_instance.class.block;
                option.selected = true;

                select = document.createElement('select');
                select.className = 'single-selection';
                select.appendChild(option);
                select.addEventListener('DOMNodeInserted', function() {
                    $(this).multiselect(selectionConfig);
                });

                td.appendChild(select);
                tr.appendChild(td);

                //populate 'Time' column
                td = document.createElement('td');
                td.style.verticalAlign = 'middle';
                td.innerHTML = `
                    <span class="time-container"><input type="time" step="${inputConstraints.time.step}" value="${sched_instance.time.start}"></span>
                    <span class="time-separator">&ndash;</span>
                    <span class="time-container"><input type="time" step="${inputConstraints.time.step}" value="${sched_instance.time.end}"></span>
                `;
                tr.appendChild(td);

                //populate 'Day' column
                td = document.createElement('td');
                select = document.createElement('select');
                select.className = 'multiple-selection';
                select.multiple = 'multiple';

                for(let i = 0; i < inputConstraints.dayLiteral.abbr.length; ++i) {
                    option = document.createElement('option');
                    option.dataset.label = inputConstraints.dayLiteral.abbr[i];
                    option.value = inputConstraints.dayLiteral.abbr.indexOf(option.dataset.label);
                    option.innerHTML = inputConstraints.dayLiteral.full[i];

                    if(sched_instance.day.includes(option.value))
                        option.selected = true;

                    select.appendChild(option);
                }

                select.addEventListener('DOMNodeInserted', function() {
                    $(this).multiselect(selectionConfig);
                });
                td.appendChild(select);
                tr.appendChild(td);

                //populate 'Room' column
                td = document.createElement('td');

                //TODO: Add mechanism that populates this selection with options
                option = document.createElement('option');
                option.dataset.label = sched_instance.room.label;
                option.innerHTML = sched_instance.room.label;
                option.selected = true;

                select = document.createElement('select');
                select.className = 'single-selection';
                select.appendChild(option);
                select.addEventListener('DOMNodeInserted', function() {
                    $(this).multiselect(selectionConfig);
                });

                td.appendChild(select);
                tr.appendChild(td);

                //populate 'No. of Stud.' column
                if(schedIndex === 0) {
                    td = document.createElement('td');
                    td.rowSpan = rowspan;
                    td.innerHTML = 'No database support.';
                    tr.appendChild(td);
                }
            }
        }

        let table = document.createElement('table');
        table.className = 'table table-sm table-bordered';
        table.innerHTML = `<caption><address>${faculty_instance.name.last}, ${faculty_instance.name.first}</address></caption>`;
        table.appendChild(theaders.cloneNode(true));
        table.appendChild(tbody);

        content.appendChild(table);
    }

    return content;
}