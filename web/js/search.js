$(function(){
	var search_value = $('#searchbox').attr('value');

	update_number = 0;

	$('#searchbox').keyup(function(){
		if (this.value == search_value) return;

		var update = ++update_number;

		search_value = this.value;

		$.get('/api.php', {name: this.value}, function(data) {
			if (update != update_number) return;

			var html = "<ul>";
			for (var i = 0; i < data.length; i++) {
				html += '<li class="person">';
				html += '<div class="name">' + data[i].name + '</div>';
				html += '<div class="email">' + data[i].uniqname + '@umich.edu</div>';

				if ('number' in data[i]) {
					html += '<div class="number">' + data[i].number + '</div>';
				}

				html += '</li>';
			}
			html += '</ul>';

			$("#results").html(html);

			$('li.person').click(function(){
				$.post('/api.php', {uniqname: $(this).find('.email').text().split("@")[0]}, function() {
					var searchbox = $('#searchbox');
					searchbox.get(0).value = '';
					searchbox.keyup();
					searchbox.focus();
				});
			});
		}, 'json');
	});
});
