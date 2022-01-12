// JavaScript Widget
function anumInfo (arr) 
{
	var buf = 'Copyright © 2017 HWP Labs. CRBN 658815 \n\n';
	buf += 'E-MAIL:\t\t webmaster@hwplabs.com \n';
	buf += 'PHONE:\t\t +234(0) 81 6996 0927 \n';	
	buf += 'HOSTED:\t '+ arr[0] +' \n';
	buf += 'EXPIRES:\t\t '+ arr[2] +' \n';	
	buf += 'USED:\t\t '+ arr[7] +'% ('+ arr[5] +' days) \n';
	buf += 'UNUSED:\t '+ arr[8] +'% ('+ arr[6] +' days)';				
	alert(buf);
}
function anumScanner (arr)
{
	var div = document.getElementById('anum_scanner');
	var input = div.querySelector('input');		
	var section = div.querySelector('section');	
	var progress = div.querySelector('progress');
	var output = div.querySelector('output');		
	var button = div.querySelector('button');
	var csv = input.getAttribute('list');
	var list = csv.split(',');
	var n = list.length, m = n - 1, o = n + 10, t = 100;
	
	section.style.display = 'block';	
	button.type = 'button';	
	button.innerHTML = 'Please wait...';
	button.setAttribute('class','sec');	
	
	for (var i = 0, x = 0; i < n; i++) {
		setTimeout(function (j) {
			progress.value = j == m? 100: Math.floor((j * 100) / n);
			output.value = list[j];
		}, i * t, i); 
	}
	
	setTimeout(anumActivate, o * t);
}
function anumActivate ()
{
	var div = document.getElementById('anum_scanner');
	var button = div.querySelector('button');	
	button.type = 'submit';	
	button.innerHTML = 'Activate';
	button.setAttribute('class','pri');
}
function anumCardHide () 
{
	document.getElementById('anum_card').style.display = 'none';
}

// ANIMATION
function timer()
{
	// setInterval(timer,1000);
	var date = new Date(); // Fri Nov 06 2020 21:04:22 GMT+0100 (West Africa Standard Time)
	var hrs = digit_f(date.getHours()); // 00 - 23
	var mins = digit_f(date.getMinutes()); // 00 - 59
	var secs = digit_f(date.getSeconds());	// 00 - 59
	var buf = hrs +':'+ mins +':'+ secs;
	document.getElementById('timer').innerHTML = buf;
}
function counter (meter, stats, start, end, delay)
{
	var i = i == null? 0: i; 
	end = end == null? 100: end;
	delay = delay == null? 60: delay;
	if (i == 0) { 
		i = 1;	
		var width = start;
		var id = setInterval(frame,delay);
		function frame() {
			if (width >= end) {
				clearInterval(id);
				i = 0;
			} else {
				width++;
				document.getElementById(meter).style.width = width + '%';
				document.getElementById(stats).innerHTML = width;
			}
		}
	}
}
function Countdown (ts) 
{
	// var countdown = new Countdown('2020-11-07T16:56:00')
	// countdown.start(callback, callback);
	this.now 	= now = new Date().getTime();
	this.end 	= end = new Date(ts).getTime(); 
	this.dif 	= dif = end - now;
	this.days = Math.floor(dif / (1000 * 60 * 60 * 24));
	this.hrs 	= Math.floor((dif % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	this.mins = Math.floor((dif % (1000 * 60 * 60)) / (1000 * 60));
	this.mins_f = this.mins < 10? '0' + this.mins: this.mins;
	this.secs = Math.floor((dif % (1000 * 60)) / 1000);
	this.secs_f = this.secs < 10? '0' + this.secs: this.secs;
	
	this.start = function (onCount, onFinish) {
		var loop = setInterval(function() {
			onCount(new Countdown(ts));
			if (dif <= 0) {
				clearInterval(loop);
				onFinish();
			}
		},1000);
	};
}
function slider() {}
function carousel(){}

// ANDROID
function splash() 
{
	// var i = 0; setInterval(splash,1000);
	var ptr = document.querySelectorAll('ul li a');	
	if (i < ptr.length)	{
		ptr[i].setAttribute('class','active');
		i++;		
	}	else {
		var nxt = document.querySelector('a[href]').getAttribute('href');
		if (nxt.charAt(0) == '#') {
			i = 0;
			for (var j = 0; j < ptr.length; j++)
				ptr[j].removeAttribute('class');
		}
		else
			location.assign(nxt);
	}
}
function toast (message, callback) 
{
	// Create
	var div = document.createElement('div');
	div.className = 'toast_overlay';
	div.innerHTML = '<div class="toast">'+ message +'</div>';
	document.body.appendChild(div);
	// Animate
  div.className += ' toast_anime';
  setTimeout(function() {
		div.className = 'toast_overlay';
		callback();
  },3000);	
}
function drawer (logic)
{
	var viewport = window.matchMedia('(max-width:600px)');
	var overlay = document.getElementsByClassName('drawer_overlay')[0];
	var wrap = document.getElementsByClassName('drawer')[0];
	if (logic == 1) {
		wrap.style.width = viewport.matches? '80%': '290px';
		overlay.style.display = 'block';
	} else {
		wrap.style.width = 0;		
		overlay.style.display = 'none';			
	}
}
function dialog (message, type, callback)
{
	switch (type) {
		case 100: caption = 'ATTENTION'; color = 'blue'; break;
		case 200: caption = 'SUCCESS'; color = 'green'; break;
		case 300: caption = 'WARNING'; color = 'orange'; break;
		case 400: caption = 'DANGER'; color = 'red'; break;
		default: color = 'black';
	}

	var div = document.createElement('div');
	div.className = 'dialog_overlay';
	div.id = 'dialog';
	div.className += ' dialog_anime';		
	div.innerHTML = '<div class="dialog"> \
    <div class="dialog_head" style="border-color:'+color+';">'+ caption +'</div> \
    <div class="dialog_body">'+ message +'</div> \
    <div class="dialog_link"> \
      <a onClick="dialogCancel()" title="Cancel" style="colo:'+color+';">CANCEL</a> \
      <a onClick="dialogOk(\''+callback+'\')"  title="Continue" style="colo:'+color+';">OK</a> \
    </div> \
	</div>';
	document.body.appendChild(div);
}
function dialogCancel() {document.getElementById('dialog').style.display = 'none';}	
function dialogOk (callback) 
{
	console.log(callback);
	if (typeof callback === 'function')	
		callback(); 
	else 
		location.assign(callback);
}

function fab (icon, tooltip, callback)
{
	var div = document.createElement('div');
	div.className = 'fab';
	div.title = tooltip;
	if (typeof callback === 'function')
		div.addEventListener('click',callback);
	else
		div.addEventListener('click',function() {location.assign(callback)});
	div.innerHTML = '<var>'+ icon +'</var>';
	document.body.appendChild(div);
}
function switches(){}
function loader(){}
function spinner(){}