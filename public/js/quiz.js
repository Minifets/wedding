function countDown(seconds, selector = '.count-down-number')
{
    let element = $(selector);
    element.text(seconds);

    let interval = setInterval(() => {
        seconds--;
        element.text(seconds);

        if (seconds <= 0) {
            clearInterval(interval);
        }
    }, 1000);
}