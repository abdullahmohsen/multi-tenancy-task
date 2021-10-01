$(function() {

	// International Telephone Input
	var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      utilsScript: "{{URL::asset('assets-dashboard/plugins/telephoneinput/utils.js')}}",
    });
});

