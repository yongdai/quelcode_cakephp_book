var request = new XMLHttpRequest();
request.open('HEAD', "#", false);	
request.send(null);	
var current_time = new Date(request.getResponseHeader('Date'));

var countdown = function (time) {

    var sec = Math.floor(time / 1000 % 60);
    var min = Math.floor(time / 1000 / 60) % 60;
    var hours = Math.floor(time / 1000 / 60 / 60) % 24;
    var days = Math.floor(time / 1000 / 60 / 60 / 24);
    var count = [days, hours, min, sec];

    return count;
}

var calc_time = function() {

    current_time.setTime(current_time.getTime() + 1000);
    var endtime = document.getElementsByClassName("endtime");
    var timer = document.getElementsByClassName("timer");

    for (i = 0; i < endtime.length; i++) {

        // 残り時間を算出
        var rest_time =[];
        rest_time[i] = new Date(endtime[i].innerHTML).getTime() - current_time.getTime();
    
        // 残り時間がゼロ以下であれば終了を表示。残り時間がある場合は残り時間を表示
        if (rest_time[i] < 0) {
            timer[i].innerHTML = '終了';
        } else {
            var counter = countdown(rest_time[i]);
            var time = counter[0] + '日' + counter[1] + '時間' + counter[2] + '分' + counter[3] + '秒';
            timer[i].textContent = time;
        }
    }
    setTimeout(calc_time, 1000);
}

//　カウントダウンタイマー開始
calc_time();