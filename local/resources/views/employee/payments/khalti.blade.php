
<div class="buttons">
    <div class="center">
        <button id="payment-button" class="btn lightgreen_gradient">Pay with Khalti</button>
    </div>
</div>
<div id="loader" style="visibility:hidden;"></div>
<style>
   .center{
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
   }
   /* Center the loader */
    #loader {
    position: absolute;
    left: 54%;
    top: 64%;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border: 8px solid #dedede;
    border-radius: 50%;
    border-top: 8px solid #3498db;
    width: 40px;
    height: 40px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
    position: relative;
    -webkit-animation-name: animatebottom;
    -webkit-animation-duration: 1s;
    animation-name: animatebottom;
    animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
    from { bottom:-100px; opacity:0 }
    to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom {
    from{ bottom:-100px; opacity:0 }
    to{ bottom:0; opacity:1 }
    }
</style>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name=\'_token\']').val()
        }
    });
    var config = {
        "publicKey": "{{$data['publicKey']}}" ,
        "productIdentity": "{{$data['productIdentity']}}",
        "productName": "{{$data['productName']}}",
        "productUrl": "{{$data['productUrl']}}",
        "paymentPreference": [
            "MOBILE_BANKING",
            "KHALTI",
            "EBANKING",
            "CONNECT_IPS",
            "SCT",
        ],
        "eventHandler": {
            onSuccess (payload) {
                // hit merchant api for initiating verfication
                console.log(payload);
                $("#loader").css({'visibility':'visible'});
                $("#payment-button").css({'visibility':'hidden'});
                $.ajax({
                    type:'POST',
                    url:'{{url("/employee/khalti/verify")}}',
                    data:payload,
                    success:function(data){
                        location.replace("/employee/event/report");
                    }
                });
            },
            onError (error) {
                alert("Something went wrong.");
                console.log(error);
            },
            onClose () {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    let amount = {{$data['amount']}}*100;
    btn.onclick = function () {
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({amount});
    }
</script>
