<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"  prefix="og: http://ogp.me/ns#" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>How to use Instascan an HTML5 QR scanner</title>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"  ></script>

	<div class="container-fluid">
		
			<div class="col">
				<script src="instascan.min.js"></script>
				 
				<div class="col-sm-12">
					<video id="camera" class="p-1 border" style="width:100%;border :1px solid #ddd"></video>
					<div id="qrcode"></div>
				</div>
				<script type="text/javascript">

// let scanner = new Instascan.Scanner({
//   video: document.getElementById("camera")
// });

// let resultado = document.getElementById("qrcode");
// scanner.addListener("scan", function(content) {
//   resultado.innerText = content;
//   scanner.stop();
// });
// Instascan.Camera.getCameras()
//   .then(function(cameras) {
//     if (cameras.length > 0) {
//       scanner.start(cameras[0]);
//     } else {
//       resultado.innerText = "No cameras found.";
//     }
//   })
//   .catch(function(e) {
//     resultado.innerText = e;
//   });

					var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
					scanner.addListener('scan',function(content){
						alert(content);
						//window.location.href=content;
					});
					Instascan.Camera.getCameras().then(function (cameras){
						if(cameras.length>0){
							scanner.start(cameras[0]);
							$('[name="options"]').on('change',function(){
								if($(this).val()==1){
									if(cameras[0]!=""){
										scanner.start(cameras[0]);
									}else{
										alert('No Front camera found!');
									}
								}else if($(this).val()==2){
									if(cameras[1]!=""){
										scanner.start(cameras[1]);
									}else{
										alert('No Back camera found!');
									}
								}
							});
						}else{
							console.error('No cameras found.');
							alert('No cameras found.');
						}
					}).catch(function(e){
						console.error(e);
						alert(e);
					});
				</script>

				 <video autoplay controls></video>
    <button>Open Cam</button>
    <script>
    function getCam(){
        window.navigator.mediaDevices.getUserMedia({video:true}).then((stream)=>{
            // let videoTrack = stream.getVideoTracks()[0];
            // console.log(videoTrack);
            document.querySelector("video").srcObject = stream;
        }).catch(err=> console.log(err.name))
    }
    // getCam();
    document.querySelector("button").addEventListener("click", getCam);
    </script>
				<div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
				  <label class="btn btn-primary active">
					<input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
				  </label>
				  <label class="btn btn-secondary">
					<input type="radio" name="options" value="2" autocomplete="off"> Back Camera
				  </label>
				</div>
			</div> 
		</div>
	</div>
</body>
</html>
