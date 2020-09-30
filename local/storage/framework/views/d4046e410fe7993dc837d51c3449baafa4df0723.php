<!doctype HTML>
<html>
    <head>
        <title>Agora AR.js - Live Streamed WebAR</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    </head>
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="https://rawgit.com/jeromeetienne/AR.js/master/aframe/build/aframe-ar.min.js"></script>
    <script src="<?php echo e(asset('js/agora_test/js/AgoraRTCSDK-3.0.2.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/agora_test/js/agora-rtm-sdk-1.2.2.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/agora_test/js/webar-audience-client.js')); ?>" type="text/javascript"></script>
    <script src="https://rawgit.com/donmccurdy/aframe-extras/master/dist/aframe-extras.loaders.min.js"></script>
    <body style='margin : 0px; overflow: hidden;'>
        <a-scene embedded arjs='sourceType: webcam; debugUIEnabled: false; detectionMode: mono_and_matrix; matrixCodeType: 3x3;'>
            <a-assets>
                <a-asset-item id="broadcaster" src="<?php echo e(asset('js/agora_test/assets/broadcaster.glb')); ?>"></a-asset-item>
            </a-assets>
            <a-marker type='barcode' value='6'>
            </a-marker>
            <a-entity camera></a-entity>
        </a-scene>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/aud.blade.php ENDPATH**/ ?>