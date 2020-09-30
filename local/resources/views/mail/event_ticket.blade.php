
<!DOCTYPE html>
<html>
    <head>
        <title>Tickets</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster|Kreon:400,700' rel='stylesheet' type='text/css'>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="content-type" content="text-html; charset=utf-8">
    </head>

    <style>
        body {
            margin: 0;
            color: #494140;
            font-family: "Kreon", serif;
            font-weight: 400;
            font-size: 25px;
        }

        .container {
            width: 795px;
            margin: 0 auto;
            margin-top:100px; 
            margin-bottom:150px; 
        }

        section {
            position: relative;
            float: left;
            width: 685px;
        }
        section .special {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            position: relative;
            height: 47px;
            padding: 10px 150px 0;
            background-color: #494140;
            color: #fff;
            text-align: center;
        }
        section .special:nth-child(2n+1) {
            background-color: #93ACA2;
        }
        section .special:nth-child(6), section .special:nth-child(7) {
            z-index: 1;
        }
        section .circle {
            position: absolute;
            top: 10px;
            left: 215px;
            width: 255px;
            height: 255px;
            background-color: #fff;
            border-radius: 50%;
            box-shadow: 0px 10px 4px 0px rgba(0, 0, 0, 0.5);
            text-align: center;
            line-height: 30px;
            z-index: 1;
        }
        section .circle .event {
            width: 150px;
            margin: 25px auto 25px;
            font-size: 1.12em;
            font-weight: 700;
            text-transform: uppercase;
        }
        section .circle .title {
            color: #93ACA2;
            font-family: "Lobster", cursive;
            font-size: 2.48em;
        }
        section .seats {
            position: absolute;
            top: 10px;
            left: 30px;
            color: #fff;
            font-weight: 700;
        }
        section .seats span {
            display: inline-block;
        }
        section .seats .label {
            width: 40px;
            margin-right: 20px;
            padding-top: 8px;
            font-size: 0.36em;
            font-weight: 400;
            text-align: right;
            text-transform: uppercase;
            vertical-align: top;
        }

        aside {
            
            width: 100px;
            position: relative;
            left: 500px;
            top: -220px;
           
        }

        aside figure {
            height: 100%;
            margin: 0;
            text-align: center;
        }
        aside figure img {
            margin-top: 25px;
            border: 2px solid;
        }
    </style>

    <body>
        @foreach($data['ticket'] as $ticket)
            <div class="container" style="padding-top:20px">
                <section>
                    <div class="circle">
                        <div class="event">{{$ticket->event->title}}</div>
                        <div class="title">Lorem</div>
                    </div>
                    <div class="special"></div>
                    <div class="special"></div>
                    <div class="special"></div>
                    <div class="special">
                        <div class="seats">
                        <span class="label">Ticket</span><span>{{$ticket->ticketType->name}}</span>
                        </div>
                    </div>
                    <div class="special">
                        <div class="seats">
                        <span class="label">Price</span><span>NRs. 500</span>
                        </div>
                        <!-- SATURDAY, AUGUST 25 2020  -->
                        {{$ticket->event->event_date}}
                    </div>
                    <div class="special">
                        <div class="seats">
                        <span class="label">Seat</span><span>120</span>
                        </div>
                        {{$ticket->event->venue}}
                    </div>
                </section>
                <aside>
                    <figure>
                        <div class="qrcode" style="width:100px; height:100px; padding:50px;"></div>
                    </figure>
                </aside>
            </div>
        @endforeach

        <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
        <script src="{{asset('assets/dist/js/qrcode.min.js')}}"></script>
        <script type="text/javascript">
            var qrcode = new QRCode(document.getElementByClassName("qrcode"), {
                width : 100,
                height : 100
            });
            qrcode.makeCode('25');
        </script>
    </body>

</html>