/**
* Environment
*/
/*
	Exact Contact Urls are removed
*/
var Env = {
	url : 'http://localhost/matrix/public_html/v1',
	base_url: $('#base_url').val()
};

/**
* F45 APIs
*/
var F45 = {
	save_equipments: Env.url+'/franchisees/save_equipments',
	download_invoice: Env.url+'/equipments/invoice-pdf/'+$('#franchisee_id').val(),
	playbooklogout: '',
};

/**
* AJAX
*/
var Ajax = {
	postRequest: function(destination, data) {
	    return $.ajax({
	      url: destination,
	      method: 'POST',
	      data: data,
	      beforeSend: function(){
            $('.loader').show();
          },
          complete: function(){
            $('.loader').hide();
          }
	    });
  	},
  	getRequest: function(source) {
	    return $.ajax({
	      url: source,
	      method: 'GET',
	      dataType: 'json'
	    });
  	}
};

/**
* Time
*/
var Time = {
	getISODateTime : function (date) {
		date = new Date(date);

		var set = function(a, b) {
		return(1e15 + a + '').slice(-b)
		};

		return date.getFullYear() + '-' + set(date.getMonth() + 1,2) + '-' + set(date.getDate(), 2) + ' ' + set(date.getHours(), 2) + ':' + set(date.getMinutes(), 2) + ':' + set(date.getSeconds(), 2);
	}
}

$('#btn-logout').on('click', function(e) {
	e.preventDefault();
	// $.cookie('playbooklogin', null, { path: '/' });
	// $.removeCookie('playbooklogin', { path: '/' });
	var logout = $( this ).attr('data-url');
	$.ajax({
		url: F45.playbooklogout,
		method: 'GET',
		dataType: 'json',
		success: function(o) {
			$.cookie("playbooklogin", null);
			$.removeCookie("playbooklogin");

			window.location.href = logout;
		},
    });
})