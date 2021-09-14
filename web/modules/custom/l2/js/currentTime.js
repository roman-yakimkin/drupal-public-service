setInterval(() => {
  let now = new Date();
  let time = {};
  time['year'] = now.getFullYear();
  time['month'] = 1 + now.getMonth();
  time['day'] = now.getDate();
  time['hour'] = now.getHours();
  time['min'] = now.getMinutes();
  time['sec'] = now.getSeconds();

  let needsLeadingZero = ['month', 'day', 'hour', 'min', 'sec'];

  for (let idx in needsLeadingZero) {
    let idValue = needsLeadingZero[idx];
    if (time[idValue] < 10) {
      time[idValue] = '0'.concat(String(time[idValue]));
    }
  }
  let timeStr = time['day'] + '.' + time['month'] + '.' + time['year'] + ' ' +
      time['hour'] + ':' + time['min'] + ':' + time['sec'];

  window.document.querySelector('.l2-current-time').textContent = timeStr;

}, 1000);
