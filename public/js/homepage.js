var d = new Date('2021-06-04T17:30:00+06:00');

// default example
simplyCountdown('.simply-countdown-one', {
    year: d.getFullYear(),
    month: d.getMonth() + 1,
    day: d.getDate(),
    plural: true
});

//jQuery example
$('#simply-countdown-losange').simplyCountdown({
    year: d.getFullYear(),
    month: d.getMonth() + 1,
    day: d.getDate(),
    enableUtc: false
});