var x = 0;
var y = 1;
var i = 1;
function addSelect() {
	if (x < 10) {
		var list = document.getElementById('list');
		var div = document.createElement('div');
		div.id = 'select' + ++x;
		div.innerHTML = '<select id="test' + y + '" type="text" name=\'priz5[]\' form=\'forms\'>\n' +
			'<option disabled=\'disabled\' selected></option>\n' +
			'<option value="100">Супер-Выстрел 50000 шт</option>\n' +
			'<option value="100">Усиленная мина 100 шт</option>\n' +
			'<option value="100">Большая аптечка 100 шт</option>\n' +
			'<option value="100">Усиленное поле 100 шт</option>\n' +
			'<option value="100">Усиленный щит 100 шт</option>\n' +
			'<option value="100">Двойной нитро 100 шт</option>\n' +
			'<option value="100">Усиленный сканер 100 шт</option>\n' +
			'<option value="100">Усиленные батареи 100 шт</option>\n' +
			'<option value="100">Дымовой заслон 100 шт</option>\n' +
			'<option value="410">Циклотрон IV+ 1 шт</option>\n' +
			'<option value="350">Катушка V+ 1 шт</option>\n' +
			'<option value="340">Накопитель IV+ 1 шт</option>\n' +
			'<option value="320">Турбонаддув IV+ 1 шт</option>\n' +
			'<option value="260">Обшивка IV+ 1 шт</option>\n' +
			'<option value="220">Стабилизатор V+ 1 шт</option>\n' +
			'<option value="220">Дальнометр V+ 1 шт</option>\n' +
			'<option value="210">Целеуказатель V+ 1 шт</option>\n' +
			'<option value="180">Усилитель руля V+ 1 шт</option>\n' +
			'<option value="170">Подшипник V+ 1 шт</option>\n' +
			'<option value="160">Локатор V+ 1 шт</option>\n' +
			'<option value="110">Антирадар V+ 1 шт</option>\n' +
			'<option value="250">Хищник на 30 дней</option>\n' +
			'<option value="250">Борей на 30 дней</option>\n' +
			'<option value="250">Титан на 30 дней</option>\n' +
			'<option value="250">Тень на 30 дней</option>\n' +
			'<option value="250">Левиафан на 30 дней</option>\n' +
			'<option value="250">VIP-аккаунт на 30 дней</option>\n' +
			'</select>';
		list.appendChild(div);
		++y;
		$(document).ready(function() {
			$('#list').change(sum);
			function sum(){
				let result=0;
				$('#list').find('select').each(function(){
					let value = 0;
					if (typeof $(this).val() == 'object'){
						$.each($(this).val(), function(index, val) {
							value += val*1;
						});
					} else {
						value = $(this).val()
					}
					result+=value*1;
				});
				$('#resultdiv10').val(result);
			}
		});
	}
}
function delSelect() {
	if (x > 0) {
		var div = document.getElementById('select' + x);
		var result = document.getElementById('prizes-result');
		div.remove();
		--x;
		$('#list').find('select').each(function(){
			let value = 0;
			if (typeof $(this).val() == 'object'){
				$.each($(this).val(), function(index, val) {
					value += val*1;
				});
			} else {
				value = $(this).val()
			}
			result+=value*1;
		});
		if (result <= 0) {
			$('#resultdiv10').val('');
		} else {
			$('#resultdiv10').val(result);
		}
	}
}
