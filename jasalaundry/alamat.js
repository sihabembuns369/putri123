var pathweb			= "http://localhost/putri/api_ci/";
var login			= pathweb + "Api/login";
var getbuku			= pathweb + "Api/bukuJSON";
var getpengarang	= pathweb + "Api/pengarangJSON";
var getpenerbit		= pathweb + "Api/penerbitJSON";
var tambahbuku		= pathweb + "Api/tambahbuku";
var hapusbuku       = pathweb + "Api/hapusbuku";
var filterbuku      = pathweb + "Api/filterbuku";
var updatedata      = pathweb + "Api/updatedata";
//membuat variable yang nilainya mengarah ke Api


function ceklogin(){
	// alert(localStorage.AaXzL2kl)
	if(localStorage.AaXzL2kl == '' || localStorage.AaXzL2kl == undefined){
		window.location.href = 'login.html';
		console.log('a')
	}
}