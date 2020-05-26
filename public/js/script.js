//簡易診断(生年月日 プルダウン)

var time = new Date(),
    year = time.getFullYear();

for (var i = year; i >= 1900; i--) {
    $('#bday_year').append('<option value="' + i + '">' + i + '</option>');
}

for (var i = 1; i <= 12; i++) {
    $('#bday_month').append('<option value="' + i + '">' + i + '</option>');
}

for (var i = 1; i <= 31; i++) {
    $('#bday_day').append('<option value="' + i + '">' + i + '</option>');
}