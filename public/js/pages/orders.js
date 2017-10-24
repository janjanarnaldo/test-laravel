
    $('#equipment_delivery_address').on('focus', geolocate);
    $('#btn-order-submit').on('click', validOrderForm);

    var autocomplete, geocoder;

    function checkShipping(place, input){
       var hasPostal = false;
       var postal_code = 0;
       var suburb = "";
       
       $.each(place, function(index, val){
           if(val.types[0] == "postal_code"){
                hasPostal = true;  
                postal_code = val.long_name;     
           }

       });

        if(!hasPostal){
            alert("Postal code for this address not found.");
            // swal('', "Postal code for this address not found.", 'error');
            input.value = '';
            input.address_components = '';
            input.focus();
            return;
        }
    }

    function initAutocomplete(){
        // var input = document.getElementsByClassName('address');
        var input = document.getElementById('equipment_delivery_address');
        
        // $('.address').each(function() { 
            // var id = $( this ).attr('data-id');

            autocomplete = new google.maps.places.Autocomplete(input, {types: ['geocode']});

            autocomplete.addListener('place_changed', function() {
                // Get the place details from the autocomplete object.
                var place = this.getPlace();

                input.address_components = place.address_components;

                checkShipping(place.address_components, input);



                /*var location = place.geometry.location;
                var lat = location.lat();
                var lng = location.lng();*/

            });
        // });

        geocoder = new google.maps.Geocoder();
    }

    function geolocate() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy
          });

          autocomplete.setBounds(circle.getBounds());
        });
      }
    }


    function getComponents(value, callback) {
        var address = value;
        
        if(geocoder) {
            geocoder.geocode({'address': address}, function(results, status){
                if(status == google.maps.GeocoderStatus.OK){
                    callback(results[0].address_components);
                } else {
                    return null;
                }
            });
        }
    }

    function validOrderForm(e) {
        // e.preventDefault();

        e.preventDefault();

        var input = document.getElementById('equipment_delivery_address');

        var form = $('#order-form');

        var submit = true;

        var hasPostal = false;

        if(input.address_components == undefined || input.address_components == 'undefined'){
           /* alert("Postal code for this address not found.");
            return;*/
        }

        // Validate equipment address
        // Loop through components
        $.each(input.address_components, function(index, val){
                if(val.types[0] == "postal_code"){
                    hasPostal = true;
                    //return false;
                }
        });

        //required for Safari
        var ref = $(form).find("[required]");

        $(ref).each(function(){
            if($(this).val() == ''){
                alert('Required fields should not be blank.');
                
                $(this).focus();

                submit = false;

                return submit;
            }
        });

        if(!hasPostal){
            //alert("Postal code for this address not found.");
        }

        if(submit){
            submitData();
        }

    }

    function submitData(data){
         var data = [];

        $('#order-form').find(':input').each(function(){
            
            var fieldValue = $(this).val();
            var fieldName = $(this).prop('name');

            if($(this).prop('type') == 'radio'){
                fieldValue = $('input[name="'+fieldName+'"]:checked').val();
            }

            if(fieldName){
                data[fieldName] = fieldValue;
            }
        });

       
        var response = Ajax.postRequest('order', $.extend({}, data));

        response.then(function(response){
            if(response.success){
                var href = window.location.href;
                window.location.href = href + '/success';
            }else{
               swal({
                  title: 'Error adding data.',
                  text: "",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonText: "OK",
                  closeOnConfirm: true
                },
                function(){
                   
                });
                $('.loader').hide();
            }

        }).catch(function(e){
            
            $('.loader').hide();
            console.log(e);
        });
        
        return false;
       
    }

    $('.date').datepicker({ dateFormat: 'dd MM yy' });