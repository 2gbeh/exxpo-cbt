// JavaScript Document
const bom = new Bom();    

function stickyNav() {
  const doc = document.querySelector('.exam .toolbar');
  if (bom.scroll() == true)
    doc.style.top = '0px';
  else
    doc.style.top = '60px';
}

function toggleScrollspy () {
  const doc = document.querySelector('.toolbar section');
	var bool = !doc.style.display || doc.style.display == 'none';
	doc.style.display = bool? 'block': 'none';
}

function selectScrollspy (name) {
  const doc = document.querySelectorAll('.toolbar section ul li a');
  var txt, e;
  for (let i = 0; i < doc.length; i++) {
    txt = doc[i].innerHTML;
    e = txt.toLocaleLowerCase();
    if (e.trim() == name) {
      doc[i].setAttribute('class', 'ans');
      doc[i].setAttribute('title', 'Answered');
    }
  }
}

function examTimer() {
  const date = new Date();
  var hh = date.getHours();
  var mm = date.getMinutes();
  var ss = date.getSeconds();

  hh = hh < 10? '0' + hh: hh;
  mm = mm < 10? '0' + mm: mm;
  ss = ss < 10? '0' + ss: ss;
  var buf =  hh + ':' + mm + ':' + ss;

  document.querySelector('.fab time').innerHTML = buf;
}

function startTimer() {
  var doc = document.querySelector('.fab time');
  const countdown = new Countdown(doc.id);
  //console.log(doc,doc.title);
  countdown.start(
    (cd) => {
      doc.innerHTML = cd.mins_f +':'+ cd.secs_f;
      doc.style.color = cd.mins < 5? 'red': 'blue';
    },
    () => {
      alert('TIME UP!');
      document.querySelector('main form').submit();
    }
  );
}