var BASE_URL = "http://localhost/fitness";
/****** States *****/
function AllStates(){
	$.ajax({
		type: 'post',
		url: BASE_URL + "/function/requestUpdate.php?requestType=GetStates",
		success: function (result) {
			$("#province").html(result);
			$("#locations").html("");
			$("#LocationDetails").html("");
			
		}
	});
}
/******** Cities By States Id *********/
function getAllCities(state_Id){ 
	$.ajax({
		type: 'post',
		url: BASE_URL + "/function/requestUpdate.php?requestType=GetCities",
		data: {"stateId":state_Id},
		success: function (result) {
			$("#cities").html(result);
			$("#locations").html("");
			$("#LocationDetails").html("");
		}
	});
}
/******** Locations of City ********/
function GetAllLocations(cityId=0){
	var state_Id = $("#province").val();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/function/requestUpdate.php?requestType=GetAllLocations",
		data: {"province":state_Id,"city":cityId},
		success: function (result) {
			var result = JSON.parse(result);
			if(result.name==0){
				$("#locations").html("");
				$("#LocationDetails").html("");
			}else{
				$("#locations").html(result.name);
				$("#LocationDetails").html(result.address);
			}
		}
	});
	return false;
}
/******** Address of particular location ********/
function GetLocationData(LocationId){
	$.ajax({
		type: 'post',
		url: BASE_URL + "/function/requestUpdate.php?requestType=GetLocationAddress",
		data: {"LocationId":LocationId},
		success: function (result) {
			var result = JSON.parse(result);
			$("#LocationDetails").html(result.address);
		}
	});
	return false;
}