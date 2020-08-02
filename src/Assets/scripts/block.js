const dateDiff = (firstDate, secondDate) => {
    return secondDate - firstDate;
}
let inputTime = new Date(document.getElementById('inputTime').value);

const timer = setInterval(() => {
    let now = new Date();
    let left = dateDiff(now, inputTime);
    if (left <= 0) {
        clearInterval(timer);
        window.location.href = window.location.href;
    } else {
        let res = new Date(left);
        let str_timer = `${res.getUTCMinutes()}:${res.getUTCSeconds()}`;
        document.getElementById('timer').innerHTML = str_timer;
    }
}, 1000);