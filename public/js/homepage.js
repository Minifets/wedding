var d = new Date('2021-06-04 17:30');

// default example
simplyCountdown('.simply-countdown-one', {
    year: d.getFullYear(),
    month: d.getMonth() + 1,
    day: d.getDate()
});

//jQuery example
$('#simply-countdown-losange').simplyCountdown({
    year: d.getFullYear(),
    month: d.getMonth() + 1,
    day: d.getDate(),
    enableUtc: false
});