/**
 * Restructures the generic schedule representation as faculty-workload schedules.
 * @param {Array} schedule_table Schedule data returned from faculty/php/get_schedules.php
 */
function model_faculty(schedule_table) {
    let faculty_list = [];

    //traverse each row in the table
    let i = 0;
    while(i < schedule_table.length) {
        let subject_list = [];

        //advance traversal if the same person
        let j = i;
        while(j < schedule_table.length && schedule_table[j].prof_id === schedule_table[i].prof_id) {
            let schedule_list = [];

            //advance traversal if the row pertains to the same person handling the same subject, only that their schedules (i.e., weekday, time room, and class) are different
            let k = j;
            for( ; k < schedule_table.length && schedule_table[k].prof_id === schedule_table[j].prof_id && schedule_table[k].subject_id === schedule_table[j].subject_id; ++k) {
                schedule_list.push({
                    day: schedule_table[k].day,
                    time: {
                        start: schedule_table[k].start_time,
                        end: schedule_table[k].end_time
                    },
                    room: {
                        id: schedule_table[k].room_id,
                        label: schedule_table[k].room_name
                    },
                    class: {
                        id: schedule_table[k].class_id,
                        block: schedule_table[k].class_yr_blk,
                    }
                });
            }

            subject_list.push({
                id: schedule_table[j].subject_id,
                code: schedule_table[j].subject_name,
                description: schedule_table[j].subject_description,
                unit: {
                    lecture: schedule_table[j].lecute_unit,
                    lab: schedule_table[j].lab_unit,
                    credit: schedule_table[j].credit_unit
                },
                schedule: schedule_list
            });

            j = k;
        }

        faculty_list.push({
            name: {
                first: schedule_table[i].prof_fname,
                middle: schedule_table[i].prof_mname,
                last: schedule_table[i].prof_lname,
            },
            subject: subject_list
        });

        i = j;
    }

    display_faculty(faculty_list);
}