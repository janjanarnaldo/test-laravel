var Equipments = {
	deliveredStatus: 4,
	onclickDelivered: function(){
		var id = $(this).attr('data-id');
		var equipments = new Object();
		var element = this;
		var	numberOfEquipments = $('.equipment-line-item').length;

		equipments[id] = {
			status: Equipments.deliveredStatus,
			received_date: Time.getISODateTime($.now())
		};
		
		var data = {
			gym_id: $('#franchisee_id').val(),
			equipments: equipments
		};

		var response = Ajax.postRequest(F45.save_equipments, data);

		response.then(function(response){
			$(element).attr("disabled", true);
			$(element).addClass('disabled');

			if(numberOfEquipments == $('.equipment-line-item .action-delivered.disabled').length){
				$('.equipment_received').removeClass('not-yet').addClass('already');
				$('.equipment_received').append('<i class="fa fa-angle-double-right"></i>');
			}

			// $(element).parent().find('.indicator').removeClass('not-yet').addClass('already');

		}).catch(function(){
			alert("An error occured.");
		});
	},
	onclickDownloadInvoice: function(){
		window.open(F45.download_invoice);
	}
};

$('.action-delivered:not(.disabled)').on('click', Equipments.onclickDelivered);
$('.btn_download_invoice:not(.disabled)').on('click', Equipments.onclickDownloadInvoice);