function handle_retrieved_info(result) {
    let container = document.getElementById('dynamic-content');
    let faculty_list = model_faculty(result.scheduleTable);

    container.appendChild(perFacultyTables(faculty_list, result.inputConstraint));
}