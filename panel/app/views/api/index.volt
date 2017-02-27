<style>
#wrapper {
    min-height: 100%;
    height: 100%;
    width: 100%;
    left: 0;
    display: inline-block;
}
#main-wrapper {
    height: 100%;
    overflow-y: auto;
    padding: 0px 50px 0px 0px;
}
#main {
    position: relative;
    height: 600px;
    overflow-y: auto;
    padding: 0 15px;
}
#sidebar-wrapper {
    height: 100%;
    border: 1px solid gray;
}
#sidebar {
    position: relative;
    height: 100%;
    overflow:hidden;
}
#sidebar .list-group-item {
        border-radius: 0;
        border-left: 0;
        border-right: 0;
        border-top: 0;
}
@media (max-width: 992px) {
    body {
        padding-top: 0px;
    }
}
@media (min-width: 992px) {
    #main-wrapper {
        float:right;
    }
}
@media (max-width: 992px) {
    #main-wrapper {
        padding-top: 0px;
    }
}
@media (max-width: 992px) {
    #sidebar-wrapper {
        position: static;
        height:auto;
        max-height: 300px;
  		border-right:0;
	}
}
.footer {
    background-color:#ffffff;
	bottom:0;
  	position:fixed;
    padding:10px;
}


</style>
<h2>API</h2>

<div id="wrapper">
  <div id="sidebar-wrapper" class="col-md-2">
            <div id="sidebar">
                <ul class="nav list-group">
                    <li>
                        <a data-toggle="tab" class="list-group-item" href="#login"><i class="icon-home icon-1x"></i>Login</a>
                    </li>
                    <li>
                        <a data-toggle="tab" class="list-group-item" href="#settings"><i class="icon-home icon-1x"></i>Settings</a>
                    </li>
                    <li>
                        <a data-toggle="tab" class="list-group-item" href="#r4t"><i class="icon-home icon-1x"></i>R4t</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="main-wrapper" class="col-md-10 pull-right">
            <div id="main">
<div class="tab-content">
  <div id="login" class="tab-pane fade in active">
    <h3><u>Login</u></h3>
    <pre class="highlight"><h4><em><?="POST /api/login/ HTTP/1.1";?></em></h4></pre>
    <table class="table table-bordered">
    <thead>
    <tr><th>Parameter</th><th>Description</th></tr>
    </thead>
    <tbody>
    <tr><td>email</td><td>Username or email (required)</td></tr>
    <tr><td>password</td><td>Password (required)</td></tr>
    </tbody>
    </table>
    <hr /><h3><u>Sample Output (JSON)</u></h3>
    <pre class="highlight"><code class="hljs http"><?php $json= json_decode('{ "id": "1", "username": "TEST", "token": "033bd94b1168d7e4f0d644c3c95e35bf" }',TRUE); echo json_encode($json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); ?></code></pre>
  </div>
  <div id="settings" class="tab-pane">
    <h3><u>Settings</u></h3>
    <pre class="highlight"><h4><em><?="GET /api/settings/ HTTP/1.1";?></em></h4></pre>
    <hr /><h3><u>Sample Output (JSON)</u></h3>
    <pre class="highlight"><code class="hljs http"><?php $json= json_decode('{"id":"1","server_ip":"XXX.XXX.XXX.XXX","server_port":"XX"}',TRUE); echo json_encode($json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); ?></code></pre>
  </div>
  <div id="r4t" class="tab-pane">
    <h3><u>r4t</u></h3>
    <pre class="highlight"><h4><em><?="GET /api/r4t/[r4t_id]/[token] HTTP/1.1";?></em></h4></pre>
    <table class="table table-bordered">
    <thead>
    <tr><th>Parameter</th><th>Description</th></tr>
    </thead>
    <tbody>
    <tr><td>r4t ID</td><td>Unique r4t ID (required)</td></tr>
    <tr><td>token</td><td>Unique user token (required)</td></tr>
    </tbody>
    </table>
        <hr /><h3><u>Sample Output (JSON)</u></h3>
    <pre class="highlight"><code class="hljs http"><?php $json= json_decode('{"id":"1","name":"TEST","passwd":"033bd94b1168d7e4f0d644c3c95e35bf","userid":"1","startup":"1","hidetaskman":"1"}',TRUE); echo json_encode($json,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); ?></code></pre>
  </div>
</div>
            </div>
          
          
        </div>
</div>