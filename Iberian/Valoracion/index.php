<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="https://www.ibventur.es/Content/bootstrap-grid.min.css" rel="stylesheet" />
    <!-- Hotjar Tracking Code for https://ibventur.es -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 1914728,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <script src="https://www.ibventur.es/Scripts/jquery-2.1.1.min.js"></script>
    <script src="https://www.ibventur.es/Scripts/bootstrap.bundle.js"></script>
    <script src="https://www.ibventur.es/Admin/assets/plugins/input-mask/jquery.maskedinput.js"></script>
    <script type="text/javascript">
        var abc = ["0", ".", "0", "0"];

        function CleanLabel(control) {
            document.getElementById(control).innerText = "";
        }

        function ChangeControl(control) {
            document.getElementById(control).style.background = "#ffd517";
            document.getElementById(control).style.color = "#000000";
        }

        function validateInputs() {
            var sector = $('#txtSector').val(); //1 
            var email = $('#txtCorreo').val(); //2
            var revenue = $('#txtUltimaFacturacionAnual').val(); //3 Revenue
            var yearsofgrowth = $('#ddlAniosConsecutivosCrecimiento').val(); //4 Years of growth
            var ebitda = $('#txtEbitda').val(); //5 Avg. EBITDA last 3 years
            var averageNet = $('#txtResultadoNetoUltimoAnio').val(); //6 Avg. net result last 3 years
            var positiveResult = $('#ddlAniosCrecimiento').val(); //7 Years with positive net results
            var netDebt = $('#txtDeudaFinancieraNeta').val(); //8 Net debt
            var fixedAssets = $('#txtTotalActivoInmovilizado').val(); //9 Fixed assets
            var biggestShareholder = $('#txtMayorAccionista').val(); //10 % biggest shareholder                  
            var fromBiggestClient = $('#txtFacturacionClientePrincipal').val(); //11 % revenue from biggest client
            var audited = $('#ddlAuditada').val(); //12  Is the company audited? (yes/ no)    
            var transaction = $('#ddlOperacionesCompra').val(); //13 m&a in the last 5 years? (yes/ no)
            var sellCompany = $('#ddlVenta').val(); //14 Selling 90%? (yes/ no) 

            if (sector.length == 0) $('#lblSectorError').text("El campo Sector en el que ope es requerido.");
            if (email.length == 0) $('#lblCorreoError').text("El campo Correo electrónico de contacto es requerido.");
            if (revenue.length == 0) $('#lblUltimaFacturacionAnualError').text("El campo Facturación media de los últimos 3 años (en €) es requerido.");
            if (ebitda.length == 0) $('#lblEbitdaError').text("El campo EBITDA media de los últimos 3 años (en €) es requerido.");
            if (averageNet.length == 0) $('#lblResultadoNetoUltimoAnioError').text("El campo Resultado neto medio de los últimos 3 años (en €) es requerido.");
            if (netDebt.length == 0) $('#lblDeudaFinancieraNetaError').text("El campo Deuda financiera neta total (en €) es requerido.");
            if (fixedAssets.length == 0) $('#lblTotalActivoInmovilizadoError').text("El campo Total activo inmovilizado (en €) es requerido.");
            if (biggestShareholder.length == 0) $('#lblMayorAccionistaError').text("El campo ¿Porcentaje de la empresa del mayor accionista? es requerido.");
            if (fromBiggestClient.length == 0) $('#lblFacturacionClientePrincipalError').text("El campo Porcentaje de facturación que viene del mayor cliente es requerido.");



            if (sector.length == 0 || email.length == 0 || revenue.length == 0 || ebitda.length == 0 || averageNet.length == 0 || netDebt.length == 0 || fixedAssets.length == 0 || fixedAssets.length == 0 || biggestShareholder == '' || fromBiggestClient == '') {} else {
                computeValidation(sector, email, revenue, yearsofgrowth, ebitda, averageNet, positiveResult, netDebt, fixedAssets, biggestShareholder, fromBiggestClient, audited, transaction, sellCompany);
            }

        }

        function Envia() {

            validateInputs();
        }


        function computeValidation(sector, email, revenue, yearsofgrowth, ebitda, averageNet, positiveResult, netDebt, fixedAssets, biggestShareholder, fromBiggestClient, audited, transaction, sellCompany) {
            // computations
            var EBITDARev = 0;
            if (revenue.length != 0) {
                EBITDARev = (ebitda / revenue) * 100;
            }

            var resultofEBITDARev = 0;
            if (EBITDARev >= 7) {
                resultofEBITDARev = 1;
            }

            var NetMargin = 0;
            if (revenue.length != 0) {
                NetMargin = (averageNet / revenue) * 100;
            }

            var resultofNetMargin = 0;
            if (NetMargin >= 5) {
                resultofNetMargin = 1;
            }

            var DeudaEBITDA = 0;
            if (ebitda.length != 0) {
                DeudaEBITDA = (netDebt / ebitda);
            }

            var AssetToRevenueRatio = 0;
            if (revenue.length != 0) {
                AssetToRevenueRatio = (fixedAssets / revenue);
            }


            var resultofaverageTurnover = 0;
            if (revenue >= 1500000 && revenue <= 10000000) {
                resultofaverageTurnover = 1;
            }

            var resultofgrowth = 0;
            if (yearsofgrowth >= 3) {
                resultofgrowth = 1;
            }

            var resultofEbita = 0;
            if (ebitda >= 150000) {
                resultofEbita = 1;
            }


            var resultofaverageNet = 0;
            if (averageNet >= 70000) {
                resultofaverageNet = 1;
            }

            var resultofPositveresult = 0;
            if (positiveResult >= 3) {
                resultofPositveresult = 1;
            }

            var resultforNetDebt = 0;
            if (DeudaEBITDA <= 2) {
                resultforNetDebt = 1;
            } else if (DeudaEBITDA > 3) {
                resultforNetDebt = -100;
            }

            var resultforAssetToRevenueRatio = 0;
            if (AssetToRevenueRatio <= 1.5) {
                resultforAssetToRevenueRatio = 1;
            }

            var resultofbiggestShareholder = 0;
            if (biggestShareholder >= 65) {
                resultofbiggestShareholder = 1;
            }

            var resultoffromBiggestClient = 0;
            if (fromBiggestClient <= 40) {
                resultoffromBiggestClient = 1;
            }

            var reultofaudited = 0;
            if (audited == 'true') {
                reultofaudited = 1;
            }


            var resultoftransaction = 0;
            if (transaction == 'false') {
                resultoftransaction = 1;
            }

            var resultofsellCompany = 0;
            if (sellCompany == 'true') {
                resultofsellCompany = 1;
            }

            var result = 0;
            result = (resultofEBITDARev + resultofNetMargin + resultofaverageTurnover + resultofgrowth + resultofEbita + resultofaverageNet + resultofPositveresult + resultofsellCompany + resultoftransaction + reultofaudited + resultoffromBiggestClient + resultofbiggestShareholder + resultforAssetToRevenueRatio + resultforNetDebt);

            document.getElementById("btnEnviar").disabled = true;
            document.getElementById("lblEnviar").innerText = "Estamos revisando tu información";
            createMessage(result);


            $.ajax({
                url: '../phpmailer/mailer.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    sector:sector,
                    email:email,
                    revenue: revenue,
                    yearsofgrowth: yearsofgrowth,
                    ebitda: ebitda,
                    averageNet: averageNet,
                    positiveResult: positiveResult,
                    netDebt: netDebt,
                    fixedAssets: fixedAssets,
                    biggestShareholder: biggestShareholder,
                    fromBiggestClient: fromBiggestClient,
                    audited: audited,
                    transaction: transaction,
                    sellCompany: sellCompany
                }
            });

        }

        function createMessage(result) {
            if (result >= 10) {
                successMessage();
            } else {
                errorMessage();
            }

        }

        function successMessage(message, alerttitle) {
            swal({
                    title: "GO",
                    text: "Thanks for sending information about your company.It seems to fit 'Iberian Ventures' investment criteria–an associate in the team will reach out to you for next steps ",
                    type: 'success'
                },
                function() {
                    document.getElementById("btnEnviar").disabled = false;
                    document.getElementById("lblEnviar").innerText = "";
                });
        }

        function errorMessage(message, alerttitle) {
            swal({
                    title: "NO-GO",
                    text: "Thanks for sending information about your company. Unfortunately, it seems that this company does not meet 'Iberian Ventures' investment criteria. Regardless, we will take a second look in detail and send you an email",
                    type: 'warning',
                },
                function() {
                    document.getElementById("btnEnviar").disabled = false;
                    document.getElementById("lblEnviar").innerText = "";
                });
        }
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        Iberian Ventures
    </title>
    <style type="text/css">
        input,
        select {
            padding: 2px;
            border: 2px solid #eee;
            font: normal 1em Verdana, sans-serif;
            color: #777;
        }

        .clase input {
            border-radius: 5px;
            border: 1px solid #eee;
            display: block;
            color: #777;
        }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src='https://www.googletagmanager.com/gtag/js?id=UA-166980235-1'></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-166980235-1');
    </script>
    <link rel='icon' type='image/x-icon' href='https://www.ibventur.es/img/favicon.png'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
    <form method="post" action="./" id="form1">
        <div class="aspNetHidden">
            <input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
            <input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
            <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="iaANnJ7C35aS1JDEwypaHTs43i1p+b7jrQUZN9W2Q0GW/WpBl7TugRnZ1sJl3xfa1PYYMNNzkyL3dxBF/C6VCpfEv2EAVuxNpkvIVy95Ar0=" />
        </div>

        <script type="text/javascript">
            //<![CDATA[
            var theForm = document.forms['form1'];
            if (!theForm) {
                theForm = document.form1;
            }

            function __doPostBack(eventTarget, eventArgument) {
                if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
                    theForm.__EVENTTARGET.value = eventTarget;
                    theForm.__EVENTARGUMENT.value = eventArgument;
                    theForm.submit();
                }
            }
            //]]>
        </script>


        <script src="https://www.ibventur.es/WebResource.axd?d=pynGkmcFUV13He1Qd6_TZM5nLUUCVN-MIrkC4SQrFMYdlUoIn3nGDJGc5CnM7rdMgicw41KqJkRs08tqlx2xVA2&amp;t=637100578300000000" type="text/javascript"></script>


        <script src="https://www.ibventur.es/ScriptResource.axd?d=D9drwtSJ4hBA6O8UhT6CQve6U7_64o2Vz_OTdAepGxxGznlaRoMG1-vePxCGrBvhbzeBw6sfNO3uBODwe5sJdAFqtf9yBZ6FWjwOGG57UXISlSDDRxIThiN-DoKpk--5qWcqYuZ3HMU3i-8Xji-o1P8tda4NBOB5CBO1-cg1jsw1&amp;t=ffffffff9a9577e8" type="text/javascript"></script>
        <script type="text/javascript">
            //<![CDATA[
            if (typeof(Sys) === 'undefined') throw new Error('ASP.NET Ajax client-side framework failed to load.');
            //]]>
        </script>

        <script src="https://www.ibventur.es/ScriptResource.axd?d=JnUc-DEDOM5KzzVKtsL1tZmEQvuvi3MQrnkyR-L6cUaNLG6mRvbr0PHVjdT64lCMbswu_bq_IreerNXzgWu6DFu6UZjFIaFS1vEbS-lqRDrnNzpc8GrYTPtjKd7B_2a7KXtjcAAIL44LxuNsK6Hy8mTdrgGDnKcdcI9qiVk_cZBn-GsGPZwbMqffri8unSfN0&amp;t=ffffffff9a9577e8" type="text/javascript"></script>
        <div class="aspNetHidden">

            <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="EF22BBDE" />
            <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="1viqYxIMztMxZaK6togRsZBBNZRh/F6bA65Fx/3MoGjHNQveqwNrnanZFW9SR/eJtm7mDaOD5hGjk0INWfb8xcpdJkI3m6h3yHseb98z/BNBAhqBKrzrL4gIMcMZR9QIY9aVavkvBAB98TeXAXhq71R+2GNW4Ee/B2G3lEj5kdHus8UjCUi55v7o2E/BV57cUCM7UfPs/MQ2ntW9lZGY3/dRoMbj5BOv3gwT6oqzKasPtEEilMAzGhHPKe/cPCKrzxLqC4d7jcBvbkHlL0PpOdIBaHNfLPDVZCE91ztmgRS3oTuPUcthLpZR1tL0kAj6Hj4/pyBJfXm3iPvjyhprsQrPoHKv+zDj476nuzAlBmUNThPwN2k0Q2rEq9169AyecBHhoC4VPpbmJ//cJAXo0Dzo2VGoUeOyZyKxx8g/Kr0W1xSVbhL14EQiVNkV+nVRVrSQIgjZuNTKwHTdoFnqspoI2TZr3rJlFimbTP3/fla+1zwklk/gFGhRusRDo3zufM77bRDEJOi2M54qSRfC3N6ADiiqDH0Q1XUPkr+MuyPL4x16pU6F8WwkRaZTksVmF4/S0lYB03pGlFXGGMqH8diG0W0nXSAGmLrZ0uaNfbCvZs92d7p5o8VznkB8S9dHcfyD76W0EEDhfojsbnb1ow==" />
        </div>

        <script type="text/javascript">
            //<![CDATA[
            Sys.WebForms.PageRequestManager._initialize('Header$ScriptManagerHeader', 'form1', ['tHeader$UpdatePanelHeader', 'Header_UpdatePanelHeader', 'tUpdatePanel1', 'UpdatePanel1'], [], [], 90, '');
            //]]>
        </script>

        <div id="Header_UpdatePanelHeader">

            <link rel="icon" type="image/x-icon" href="https://www.ibventur.es/img/favicon.png">

            <link rel="stylesheet" href="https://www.ibventur.es/css/fontawesome.min.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/themify-icons.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/elegant-line-icons.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/elegant-font-icons.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/flaticon.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/animate.min.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/bootstrap.min.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/slick.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/slider.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/odometer.min.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/venobox/venobox.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/owl.carousel.css">

            <link rel="stylesheet" href="https://www.ibventur.es/css/main.css">
            <link rel="stylesheet" href="https://www.ibventur.es/css/sitio.css">
            <link href="https://www.ibventur.es/css/sweetalert.css" rel="stylesheet" />

            <link rel="stylesheet" href="https://www.ibventur.es/css/responsive.css">
            <script src="https://www.ibventur.es/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
            <div class="site-preloader-wrap">
                <div class="spinner"></div>
            </div>
            <!-- Header -->
            <header class="header" id="header">
                <div class="primary-header">
                    <div class="container">
                        <div class="primary-header-inner">
                            <div class="header-logo">
                                <a href="/">
                                    <img src="https://www.ibventur.es/img/ibv.png" alt="IBV"></a>
                            </div>
                            <div class="header-menu-wrap">
                                <ul class="dl-menu">
                                    <li><a href="/Home/">Home</a></li>
                                    <li><a href="/Nosotros/">Nosotros</a></li>
                                    <li><a href="/Que-buscamos/">Que buscamos</a></li>
                                    <li><a href="/Valoracion/">Vender tu Negocio</a></li>
                                    <li><a href="/Hunters/">Hunters</a></li>
                                    <li><a href="/Blog/">Blog</a></li>
                                    <li><a href="/Contacto/">Contacto</a></li>
                                </ul>
                            </div>
                            <div class="header-right">
                                <div class="mobile-menu-icon">
                                    <div class="burger-menu">
                                        <div class="line-menu line-half first-line"></div>
                                        <div class="line-menu"></div>
                                        <div class="line-menu line-half last-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        </div>
        </div>
        </header>

        </div>
        <!--End Header -->

        <section class="page-header page-header-nosotros padding">
            <div class="container">
                <div class="page-content text-center">
                    <h2>¿Quieres conocer cuanto vale tu empresa?</h2>
                    <p>Con algunos pocos datos sobre tu negocio, te diremos cual es su valuación y si estamos interesados en comprarla</p>
                </div>
            </div>
        </section>
        <!-- Process area -->
        <section class="work-pro-section bg-grey padding">
            <div class="dots"></div>
            <div class="container">
                <div id="UpdatePanel1">



                    <!-- <div id="pnSolicitud" onkeypress="javascript:return WebForm_FireDefaultButton(event, 'btnEnviar')"> -->
                    <div id="pnSolicitud">

                        <h4>Si te estás planteado vender tu compañía, una de las preguntas fundamentales es <span style='color:red'>“¿Cuánto vale mi empresa?”</span> - Es importante que tengas una idea de cual es el valor de tu negocio y qué elementos son relevantes. <br /><br />Con algunos pocos datos sobre tu negocio, nuestra herramienta te ayudará a determinar una valuación (es decir, cuantos € podrías recibir)</h4>
                        <h4><br />Este formulario de valuación es útil para compañías con <span style='color:red'>más de 1MM€ en ventas al año</span></h4>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-6">

                                <span id="lblEmpresaError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblSector">Sector en el que opera tu empresa:</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtSector" type="text" maxlength="50" id="txtSector" onkeyup="CleanLabel('lblSectorError')" title="¿En qué industria compites?" placeholder="Sector o industria" style="width:100%;" />
                                <span id="lblSectorError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblCorreo">Correo electrónico de contacto:</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtCorreo" type="text" maxlength="50" id="txtCorreo" onkeyup="CleanLabel('lblCorreoError')" title="¿Cuál es el correo electronico del responsable?" placeholder="Correo de contacto" style="width:100%;" />
                                <span id="lblCorreoError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>

                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-6">

                                <span id="lblContactoError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblUltimaFacturacionAnual">Facturación media de los últimos 3 años (en €):</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtUltimaFacturacionAnual" type="number" maxlength="15" id="txtUltimaFacturacionAnual" title="Ingresos del último año" placeholder="¿Cúal fue la facturacion del último año?" style="width:100%;" />
                                <span id="lblUltimaFacturacionAnualError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblAniosConsecutivosCrecimiento">Años consecutivos creciendo ingreso:</span>
                            </div>
                            <div class="col-md-6">
                                <select name="ddlAniosConsecutivosCrecimiento" id="ddlAniosConsecutivosCrecimiento" title="¿Cuantos años consecutivos la empresa ha tenido un incremento en el ingreso?" style="width:70%;">
                                    <option selected="selected" value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">&gt;3</option>

                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblEbitda">EBITDA media de los últimos 3 años (en €):</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtEbitda" type="number" maxlength="9" id="txtEbitda" title="¿Cual es el beneficio bruto de explotación calculado antes de la deducibilidad de los gastos financieros?" placeholder="Ingreso neto antes de impuestos y depreciación" style="width:100%;" />
                                <span id="lblEbitdaError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblResultadoNetoUltimoAnio">Resultado neto medio de los últimos 3 años (en €):</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtResultadoNetoUltimoAnio" type="number" maxlength="9" id="txtResultadoNetoUltimoAnio" title="¿Cúal fue el resultado neto del último año?" placeholder="Resultado neto del último año" style="width:100%;" />
                                <span id="lblResultadoNetoUltimoAnioError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblAniosCrecimiento">Años consecutivos con resultado positivo:</span>
                            </div>
                            <div class="col-md-6">
                                <select name="ddlAniosCrecimiento" id="ddlAniosCrecimiento" title="¿Cuantos años consecutivos se ha tenido un resultado del ejercicio positivo?" style="width:70%;">
                                    <option selected="selected" value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">&gt;3</option>

                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblDeudaFinancieraNeta">Deuda financiera neta total (en €):</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtDeudaFinancieraNeta" type="number" maxlength="9" id="txtDeudaFinancieraNeta" title="¿Cual es la deuda financiera neta de la empresa?" placeholder="Deuda financiera neta total en Euros" style="width:100%;" />
                                <span id="lblDeudaFinancieraNetaError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblTotalActivoInmovilizado">Total activo inmovilizado (en €):</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtTotalActivoInmovilizado" type="number" maxlength="15" id="txtTotalActivoInmovilizado" title="¿Cual es el total activo inmovilizado?" placeholder="Total activo inmovilizado en euros" style="width:100%;" />
                                <span id="lblTotalActivoInmovilizadoError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblMayorAccionista">¿Porcentaje de la empresa del mayor accionista?:</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtMayorAccionista" id="txtMayorAccionista" type="number" maxlength="3" stitle="¿Que porcentaje de la empresa tiene el mayor accionista?" placeholder="Porcentaje de la empresa que tiene el mayor accionista" style="width:100%;" />
                                <span id="lblMayorAccionistaError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblFacturacionClientePrincipal">Porcentaje de facturación que viene del mayor cliente:</span>
                            </div>
                            <div class="col-md-6">
                                <input name="txtFacturacionClientePrincipal" id="txtFacturacionClientePrincipal" type="number" maxlength="3" title="¿Que porcentaje de facturación tiene el mayor cliente?" placeholder="Porcentaje facturación que representa el mayor cliente" style="width:100%;" />
                                <span id="lblFacturacionClientePrincipalError" style="color:Red;font-size:X-Small;"></span>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblAuditada">¿Ha sido auditada la compañía alguna vez?:</span>
                            </div>
                            <div class="col-md-6">
                                <select name="ddlAuditada" id="ddlAuditada" title="¿Está auditada la compañía?" style="width:70%;">
                                    <option value="false">No</option>
                                    <option value="true">Si</option>

                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblOperacionesCompra">¿Operaciones de compra o fusiones en los últimos 5 años?</span>
                            </div>
                            <div class="col-md-6">
                                <select name="ddlOperacionesCompra" id="ddlOperacionesCompra" title="¿Tuvo operaciones de compra o fusiones en los últimos 5 años?" style="width:70%;">
                                    <option value="false">No</option>
                                    <option value="true">Si</option>

                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                                <span id="lblVenta">¿Se quiere vender más del 90% de la compañía?</span>
                            </div>
                            <div class="col-md-6">
                                <select name="ddlVenta" id="ddlVenta" onFocus="ChangeControl('btnEnviar');" style="width:70%;">
                                    <option value="false">No</option>
                                    <option value="true">Si</option>

                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding:10px 0">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-6">
                                <!-- <input type="button" name="btnEnviar" value="Enviar" onclick="Envia();__doPostBack('btnEnviar','')" id="btnEnviar" style="height:45px;width:60%;" /> -->
                                <input type="button" name="btnEnviar" value="Enviar" onclick="Envia();" id="btnEnviar" style="height:45px;width:60%;" />
                                </br>
                                <span id="lblEnviar"></span>
                            </div>
                        </div>

                    </div>
                    <span id="lblMessage" style="color:Red;font-size:X-Small;"></span>

                </div>
            </div>
        </section>
        <!-- End Process area -->

        <!-- Start Footer Area -->
        <section class="widget-section padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp">
                        <div class="footer-logo">
                            <a href="/">
                                <img src="https://www.ibventur.es/img/ibv.png" alt="IBV"></a>
                            <p>Invertimos para generar valor a largo plazo, sin intención de vender.</p>
                        </div>
                        <div class="widgets-social">
                            <a href="https://www.linkedin.com/company/iberian-ventures" target="_blank"><i class="ti-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="300ms">
                        <div class="widget-content">
                            <h4>Conócenos</h4>
                            <ul class="widget-links">
                                <li><a href="/Home/">Home</a></li>
                                <li><a href="/Nosotros/">Nosotros</a></li>
                                <li><a href="/Que-buscamos/">Que buscamos</a></li>
                                <li><a href="/Valoracion/">Vender tu Negocio</a></li>
                                <li><a href="/Hunters/">Hunters</a></li>
                                <li><a href="/Blog/">Blog</a></li>
                                <li><a href="/Contacto/">Contacto</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 sm-padding wow fadeInUp" data-wow-delay="500ms">
                        <div class="widget-content">
                            <h4>Contáctanos</h4>
                            <ul class="widget-links">
                                <li><i class="fa fa-map-marker"></i> Centro de Madrid, España</li>
                                <li><a href="mailto:hello@ibventur.es"><i class="fa fa-envelope"></i> hello@ibventur.es</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Footer Area -->

        <!-- Start Copyright Area -->
        <footer class="footer-section align-center">
            <div class="container">
                <p>Copyright © <script>
                        var d = new Date();
                        document.write(d.getFullYear());
                    </script> By Iberian Ventures.</p>
            </div>
        </footer>
        <!-- End Copyright Area -->
        <a data-scroll href="#header" id="scroll-to-top"><i class="arrow_carrot-up"></i></a>

        <script src="https://www.ibventur.es/js/vendor/jquery-1.12.4.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/bootstrap.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/tether.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/headroom.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/owl.carousel.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/smooth-scroll.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/venobox.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/jquery.ajaxchimp.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/slick.min.js"></script>

        <script src="https://www.ibventur.es/js/waypoints.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/odometer.min.js"></script>

        <script src="https://www.ibventur.es/js/vendor/wow.min.js"></script>

        <script src="https://www.ibventur.es/js/main.js"></script>

        <script src="https://www.ibventur.es/js/sweetalert.min.js"></script>

        <script src="https://www.ibventur.es/js/utils.js"></script>

    </form>
</body>
<script>
    window.scrollTo(0, 300);
</script>

</html>