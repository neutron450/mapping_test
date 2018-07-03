<html>

<head>
  <title>Ambiarc</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" media="all" href="TemplateData/css/bootstrap.min.css" />
  <link rel="stylesheet" media="all" href="TemplateData/css/style.css" />
  <script src="TemplateData/js/jquery-2.2.4.min.js"></script>
  <script src="TemplateData/js/bootstrap.min.js"></script>
  <script src="TemplateData/js/UnityProgress.js"></script>
  <script src="TemplateData/js/ambiarc.js?nc=<?php echo time(); ?>"></script>
  <script src="TemplateData/js/ambiarc-theme.js"></script>
  <script src="map/b14b32a200649d0650c1a6ff3db39cf4.js"></script>
  <script src="TemplateData/js/UnityCompatibility.js"></script>
  <script>
    var gameInstance = UnityLoader.instantiate("gameContainer", "map/ce972279f24d48acc380ea3677260d4a.json", {
      onProgress: UnityProgress,
      Module: {
        onRuntimeInitialized: function() {
          UnityProgress(gameInstance, "complete");
        }
      }
    });
  </script>
</head>

<body class="guide-kick-background">
  <div class="raasTitleContainer" id="raas_title_container">
    <div class="raasTitle" id="raas_title"></div>
  </div>

  <div id="gameContainer" hidden="">
    <canvas id="#canvas"></canvas>
    <div class="logo Dark">
    </div>
  </div>

  <!-- Compat Modal -->
  <div class="modal fade" id="CompatModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <p>This device or browser is not fully supported, so the map expierence may not work as expected.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="CompatModalGoBack">Go back</button>
          <button type="button" class="btn btn-secondary" id="CompatModalContinue" data-dismiss="modal">Continue</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
