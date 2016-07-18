<?php 
if(!isset($_GET['searchbox']))
	header('location: search.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Googly search</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  
  <link rel="stylesheet" href="AdminLTE/css/AdminLTE.min.css">
  <link rel="stylesheet" href="AdminLTE/css/skins/_all-skins.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/jquery-ui.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="AdminLTE/js/app.js"></script>
</head>
<body>

<header id="hdr">
            GOOGLY...intranet never seemed so navigable !
    </header>

	<div class="row">
	<div class="col-sm-10 col-sm-offset-1" style="padding-top: 3%; padding-bottom: 2%">
        <div class="panel panel-danger">
        	<ul class="nav nav-tabs">
              <li class="col-sm-4"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><center><h4><b>Intranet</b></h4></center></a></li>
              <li class="active col-sm-4"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><center><h4><b>Images</b></h4></center></a></li>
              <li class="col-sm-4"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><center><h4><b>Forms</b></h4></center></a></li>
            </ul>
          	<div class="tab-content">
            <div class="tab-pane" id="tab_1">
	            <div class="panel-title">
	              <center><a href="search.html">
	              	<img src="googly.png" style="height: 100px; width: 300px"/></a></center><br>
	              <form class="form-horizontal" role="form" method="get" action="ab.php">
	                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                          <div class="col-sm-10">
                            <input id="intranet" type="text" class="form-control" name="searchbox" required></div>
                            <div class="col-sm-1"><a data-toggle="tooltip" data-placement="bottom" title="Play">
                             <button id="button-play-ws" type="button" class="btn btn-sm btn-success"><i class="fa fa-fw fa-microphone"></i></button></a></div>
                             <div class="col-sm-1"><a data-toggle="tooltip" data-placement="bottom" title="Stop">
                             <button id="button-stop-ws" type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-microphone-slash"></i></button></a></div>
                            
                            
                              <script>
        // Test browser support
        window.SpeechRecognition = window.SpeechRecognition       ||
                                   window.webkitSpeechRecognition ||
                                   null;

        if (window.SpeechRecognition === null) {
          document.getElementById('ws-unsupported').classList.remove('hidden');
          document.getElementById('button-play-ws').setAttribute('disabled', 'disabled');
          document.getElementById('button-stop-ws').setAttribute('disabled', 'disabled');
        } else {
          var recognizer = new window.SpeechRecognition();
          var transcription = document.getElementById('intranet');
          var log = document.getElementById('log');

          // Recogniser doesn't stop listening even if the user pauses
          recognizer.continuous = true;

          // Start recognising
          recognizer.onresult = function(event) {
            transcription.value = '';

            for (var i = event.resultIndex; i < event.results.length; i++) {
              if (event.results[i].isFinal) {
                transcription.value = event.results[i][0].transcript;
              } else {
                transcription.value += event.results[i][0].transcript;
              }
            }
          };

          // Listen for errors
          recognizer.onerror = function(event) {
            log.innerHTML = 'Recognition error: ' + event.message + '<br />' + log.innerHTML;
          };

          document.getElementById('button-play-ws').addEventListener('click', function() {
            // Set if we need interim results
            recognizer.interimResults = true;


            try {
              recognizer.start();
              log.innerHTML = 'Recognition started' + '<br />' + log.innerHTML;
            } catch(ex) {
              log.innerHTML = 'Recognition error: ' + ex.message + '<br />' + log.innerHTML;
            }
          });

          document.getElementById('button-stop-ws').addEventListener('click', function() {
            recognizer.stop();
            log.innerHTML = 'Recognition stopped' + '<br />' + log.innerHTML;
          });

          document.getElementById('clear-all').addEventListener('click', function() {
            transcription.value = '';
            log.value = '';
          });
        }
      </script>
                      <input type="hidden" name="startrow" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <center><button type="submit" name="search" class="btn">&nbspIntranet search</button>&nbsp&nbsp
                              <button type="submit" name="lucky" class="btn">&nbsp Top result </button></center>
                        </div>
                    </div>
	                </form>
	            </div>
	               
	        </div>
	         <div class="tab-pane active" id="tab_2">
	            <div class="panel-title">
	              <center><a href="search.html">
	              	<img src="googly.png" style="height: 100px; width: 300px"/></a></center><br>
	              <form class="form-horizontal" role="form" method="get" action="a.php">
	                    <div class="form-group">
	                        <div class="col-sm-8 col-sm-offset-2">
	                            <input type="text" class="form-control" name="searchbox" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col-sm-offset-3 col-sm-6">
	                            <center><button type="submit" name="search" class="btn">
	                            <i class="fa fa-fw fa-search"></i>&nbspSearch Images</button>
	                        	</center>
	                        </div>
	                    </div>
	                </form>
	            </div>
	            <div class="panel-body">
	               	<?php
					$que=$_GET['searchbox'];
					$api_key="AIzaSyBUHVaTrf1dK0fxYMGGsW4-gu5r71SWK5U";
					$cse_id="010553533250137458312:h4ncp8wh1vg";
					$url="https://www.googleapis.com/customsearch/v1?key=" . urlencode($api_key) . "&cx=" . urlencode($cse_id) . "&searchType=image&q=" . urlencode($que);

						$proxy = '127.0.0.1:8080';
					//$proxyauth = 'user:password';

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_PROXY, $proxy);
					//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

					$data = curl_exec($ch);

					curl_close($ch);
						  // $result = json_decode($data, true);
					$result = json_decode($data, true);
					if($result==null&&json_last_error()!=JSON_ERROR_NONE)
					{
						echo "Incorrect data! ";
					}
					else {
						$temp=$result['queries']['request'][0]['totalResults'];
						if($temp==0)
						{
							if(empty($result['spelling'])) 
							{
								?>
								<h4>Your search - <b><?php echo htmlspecialchars($que, ENT_QUOTES, 'UTF-8'); ?></b> - did not match any documents.</h4>
								<h4>Suggestions:
									<ul>
										<li>Make sure that all words are spelled correctly.</li>
										<li>Try different keywords.</li>
										<li>Try more general keywords.</li>
										<li>Try fewer keywords.</li>
									</ul>
								</h4>
								<?php
							}
							else 
							{
								?>
									<h3>Did u mean - <a href="<?php echo $_SERVER['PHP_SELF'].'?searchbox='.$result['spelling']['correctedQuery']; ?>">
										<i><b style="color: blue"><?php echo $result['spelling']['correctedQuery']; ?></b></i></a></h3>
								<?php
							}
						}
						else{
						$len = sizeof($result['items']); 
						//echo "len is " . $len . "<br>"; 
						//echo "The jpg files are " . "<br>";
						?><br><center><?php
						for($i=0;$i<$len;$i++)
						{
							if($i == $len/2)
							{
								echo "<br><br>";
							}
							?>
							<a href="<?php echo $result['items'][$i]['link']; ?>">
							<img src="<?php echo $result['items'][$i]['link']; ?>" style="border: solid black; height: 200px; width: 200px"/></a>
							<?php
						}
						?>
					</center><br>
					<?php
					//else echo "No such result!";
					}
				}
					?>
			</div>
	        </div>
	        <div class="tab-pane" id="tab_3">
                <div class="panel-title">
              <center><a href="search.html">
	              	<img src="googly.png" style="height: 100px; width: 300px"/></a></center>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="get" action="form.php">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input type="text" class="form-control" name="searchbox" required>
                            <input type="hidden" name="startrow" value="0">
                            <center>
<!--
                            <h3>
                            <label class="checkbox-inline"><input type="checkbox" name="pdf" value=".pdf">pdf</label>
                            <label class="checkbox-inline"><input type="checkbox" name="doc" value=".doc">doc</label>
                            <label class="checkbox-inline"><input type="checkbox" name="exe" value=".exe">exe</label>
                            <label class="checkbox-inline"><input type="checkbox" name="zip" value=".zip">zip</label>
                            <label class="checkbox-inline"><input type="checkbox" name="iso" value=".iso">iso</label>
                            </h3>
-->
                            </center>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <center><button type="submit" name="search" class="btn">&nbspSearch Forms</button>
                              </center>
                        </div>
                    </div>
                </form>
            </div>
            </div>
	    	</div>
         
        </div>
    </div>
</body>
</html>

