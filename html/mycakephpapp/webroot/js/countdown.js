var countdown = function (time) {

    var sec = Math.floor(time / 1000 % 60);
    var min = Math.floor(time / 1000 / 60) % 60;
    var hours = Math.floor(time / 1000 / 60 / 60) % 24;
    var days = Math.floor(time / 1000 / 60 / 60 / 24);
    var count = [days, hours, min, sec];

    return count;
}
var endtime = document.getElementsByClassName("timer");

for (i = 0; i < endtime.length; i++) {
    var request = new XMLHttpRequest();
    request.open('HEAD', "#", false);
    request.send(null);
    var now = new Date(request.getResponseHeader('Date'));
    console.log(now);
    var goal =[];
    goal[i] = new Date(endtime[i].innerHTML);
    console.log(goal);
    if (goal[i] < 0) {
        endtime[i].innerHTML = '終了';
    } else {
        var counter = countdown(goal[i]);
        var time = counter[0] + '日' + counter[1] + '時間' + counter[2] + '分' + counter[3] + '秒';
        endtime[i].textContent = time;
    }
}
