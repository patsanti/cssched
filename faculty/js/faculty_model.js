/**
 * Restructures the generic schedule representation as faculty-workload schedules.
 * @param   {Array} schedule_table Schedule data returned from faculty/php/get_schedules.php.
 * @returns {Array}                A new array of schedules on a per-faculty basis.
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

            //advance traversal if the row pertains to the same person handling the same subject,
            //only that their schedules (i.e., weekday, time room, and class) are different
            let k = j;
            for( ; k < schedule_table.length &&
                schedule_table[k].prof_id === schedule_table[j].prof_id &&
                schedule_table[k].subject_id === schedule_table[j].subject_id;
                ++k
            ) {
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
                    lecture: schedule_table[j].lecture_unit,
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

    return faculty_list;
}

/**
 * Aggregates an array of schedule each specifying the class block, time and weekday (room is
 * not important), and clumps them together that order as much as possible.
 * @param   {Array} schedules An array of schedule objects each consisting of `day`, `class`,
 *                            `room`, and `time` keys. Note that this argument will be sorted.
 * @returns {Array}           A new array of aggregated schedules.
 */
function aggregateSchedules(schedules) {
    if(schedules.length <= 1)
        return schedules;

    //sort first to ensure the routine below works correctly
    schedules.sort(function(a, b) {
        if(a.class.block < b.class.block)
            return 1;
        else if(a.class.block > b.class.block)
            return 1;
        else if(a.time.start < b.time.start)
            return -1;
        else if(a.time.start > b.time.start)
            return 1;
        else if(a.day < b.day) //assuming numbers 1 to 7 represents Sunday to Saturday
            return -1;
        else if(a.room.label < b.room.label)
            return -1;
        else if(a.room.label > b.room.label)
            return 1;
        else return 0;
    });

    var aggr_sched_list = [];

    for(let i = 0; i < schedules.length; ) {
        for(var j = i; j < schedules.length && schedules[j].class.id === schedules[i].class.id; ) {
            let day_list = [];
            for(var k = j; k < schedules.length && schedules[k].time.start === schedules[j].time.start && schedules[k].time.end === schedules[j].time.end; ++k) {
                if(!day_list.includes(schedules[k].day)) {
                    day_list.push(schedules[k].day);
                }
            }

            aggr_sched_list.push({
                class: {
                    id: schedules[j].class.id,
                    block: schedules[j].class.block
                },
                time: {
                    start: schedules[j].time.start,
                    end: schedules[j].time.end
                },
                day: day_list,
                room: {
                    id: schedules[j].room.id,
                    label: schedules[j].room.label
                }
            });

            j = k;
        }

        i = j;
    }

    return aggr_sched_list;
}