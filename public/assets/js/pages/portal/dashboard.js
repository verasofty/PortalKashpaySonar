$(function(){
    $( "#fechaInicio" ).hide();
    $( "#fechaFin" ).hide();
    $( "#btn-buscar" ).hide();

    $( "#high-line-anual" ).hide();
    $( "#high-line-mensual" ).hide();
    $( "#high-line-semanal" ).show();

    /*$( "#fechaI" ).datepicker({
        dateFormat: 'dd/mm/yy',
    });
    $( "#fechaF" ).datepicker({
        dateFormat: 'dd/mm/yy',
    });*/


    $('#fechaI').datetimepicker();
    $('#fechaF').datetimepicker();

    $( "#chart-anual" ).click(function(event){
        event.preventDefault();
        if (yearlyok[0] != '0') {
            $( "#high-line-anual" ).show();
        }else{
            bootbox.alert({
                message: "No hay datos anuales para mostrar.",
                locale: 'mx'
            });
        }
        $( "#high-line-mensual" ).hide();
        $( "#high-line-semanal" ).hide();
    });

    $( "#chart-mensual" ).click(function(event){
        event.preventDefault();
        $( "#high-line-anual" ).hide();
        if (montlyok[0] != '0') {
            $( "#high-line-mensual" ).show();
        }else{
            bootbox.alert({
                message: "No hay datos mensuales para mostrar.",
                locale: 'mx'
            });
        }       
        $( "#high-line-semanal" ).hide();
    });

    $( "#chart-semanal" ).click(function(event){
        event.preventDefault();
        $( "#high-line-anual" ).hide();
        $( "#high-line-mensual" ).hide();
        if (weeklyok[0] != '0') {
            $( "#high-line-semanal" ).show();;
        }else{
            bootbox.alert({
                message: "No hay datos semanales para mostrar.",
                locale: 'mx'
            });
        }
    });

    $('#rango').change(function(event){
        event.preventDefault();
        var rango = '';
        var mood = '';
        switch($('#rango').val()) {
            case '0':
                rango = '';
                mood = '0';
                break;
            case '-1':
                rango = '';
                mood = '-1';
                break;
            case '-2':
                rango = '';  
                mood = '-2';              
                break;
            case '-3':
                rango = '';  
                mood = '-3';              
                break;
            case '-4':
                rango = ''; 
                mood = '-4';               
                break;
            case '-5':
                rango = ''; 
                mood = '-5';              
                break;
            case '-6':
                rango = '';
                mood = '-6';
                break;
            case '-7':
                rango = ''; 
                mood = '-7';               
                break;
            case '-8':
                rango = '';  
                mood = '-8';              
                break;
            case '-9':
                rango = '';
                mood = '-9';                
                break;
            case '-10':
                rango = ''; 
                mood = '-10';               
                break;
            case '-11':
                rango = $("#fechaInicio").val()+' 00:00 / '+$("#fechaFin").val()+' 23:59'; 
                console.log('rango= '+rango);  
                mood = '';             
                break;
        }

        if ($('#rango').val() == -11) {
            $( "#fechaInicio" ).show();
            $( "#fechaFin" ).show();
            $( "#btn-buscar" ).show();
        }else{
            $( "#fechaInicio" ).hide();
            $( "#fechaFin" ).hide();
            $( "#btn-buscar" ).hide();

            $.ajax({
                url: base_url+"/dashboard/searchResults",
                data: $("#filtros").serialize(),
                type: "post",
                dataType: "json",
                beforeSend: function () {
                    $('#approvedTransactions').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                    $('#failTransactions').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                    $('#acceptancePercentage').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                    $('#accumulatedAmount').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                },
                success: function(respuesta){
                    if(respuesta.rows.success == true){
                        //tabla
                        $('#approvedTransactions').html('<a style="color: #626262;" href="transacciones?rango='+rango+'&estatus=00&subafiliado='+subAfiliado+'&entidad='+entidad+'&sucursal='+sucursal+'&caja='+caja+'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&mood='+mood+'&type=1&page=1" ><span class="imoon imoon-thumbs-up"></span> '+respuesta.rows.dashboardResponse.approvedTransactions+'</a>');
                        $('#failTransactions').html('<a style="color: #626262;" href="transacciones?rango='+rango+'&estatus=&subafiliado='+subAfiliado+'&entidad='+entidad+'&sucursal='+sucursal+'&caja='+caja+'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&mood='+mood+'&type=-1&page=1" ><span class="imoon imoon-thumbs-up2"></span> '+respuesta.rows.dashboardResponse.failTransactions);
                        $('#acceptancePercentage').html(respuesta.rows.dashboardResponse.acceptancePercentage+' <span class="fas fa-percentage"></span>');
                        $('#accumulatedAmount').html('<i class="fas fa-dollar-sign"></i> '+respuesta.rows.dashboardResponse.accumulatedAmount+' <span class="fas fa-file-invoice-dollar"></span>');
                        //Grafica pastel
                        var Colors = [bgPrimary, bgSuccess, bgInfo, bgWarning, bgAlert, bgDanger, bgSystem]; 
                        porcentajes = respuesta.rows.dashboardResponse.doughnutSettings.percentages;
                        marcas = respuesta.rows.dashboardResponse.doughnutSettings.brands;
                        for (var i = 0; i < porcentajes.length; i++) {
                            pastel.push( [marcas[i],  porcentajes[i]]);
                        }
                        var chart10 = c3.generate({
                            bindto: '#donut-chart',
                            color: {
                              pattern: Colors
                            },
                            data: {
                                columns: 
                                    pastel
                                ,
                                type : 'donut',
                                onclick: function (d, i) { console.log("onclick", d, i); },
                                onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                                onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                            },
                            donut: {
                                title: "Porcentaje de aceptación"
                            }
                        });
                        //Grafica Barras
                          if(respuesta.rows.dashboardResponse.weekly.ok != null){
                            weeklyok = [] = respuesta.rows.dashboardResponse.weekly.ok;
                          }else{
                            weeklyok = [] = '0';
                          }
                          if(respuesta.rows.dashboardResponse.weekly.fail != null){
                            weeklyfail = [] = respuesta.rows.dashboardResponse.weekly.fail;
                          }else{
                            weeklyfail = [] = '0';
                          }
                          if(respuesta.rows.dashboardResponse.weekly.date != null){
                            weeklydate = [] = respuesta.rows.dashboardResponse.weekly.date;
                          }else{
                            weeklydate = [] = '0';
                          }

                          if(respuesta.rows.dashboardResponse.montly.ok != null){
                            montlyok = [] = respuesta.rows.dashboardResponse.montly.ok;
                          }else{
                            montlyok = [] = '0';
                          }
                          if(respuesta.rows.dashboardResponse.montly.fail != null){
                            montlyfail = [] = respuesta.rows.dashboardResponse.montly.fail;
                          }else{
                            montlyfail = [] = '0';
                          }
                          if(respuesta.rows.dashboardResponse.montly.date != null){
                            montlydate = [] = respuesta.rows.dashboardResponse.montly.date;
                          }else{
                            montlydate = [] = '0';
                          }

                          if(respuesta.rows.dashboardResponse.yearly.ok != null){
                            yearlyok = [] = respuesta.rows.dashboardResponse.yearly.ok;
                          }else{
                            yearlyok = [] = '0';
                          }
                          if(respuesta.rows.dashboardResponse.yearly.fail != null){
                            yearlyfail = [] = respuesta.rows.dashboardResponse.yearly.fail;
                          }else{
                            yearlyfail = []  = '0';
                          }
                          if(respuesta.rows.dashboardResponse.yearly.date != null){
                            yearlydate = [] = respuesta.rows.dashboardResponse.yearly.date;
                          }else{
                            yearlydate = [] = '0';
                          }

                          barrasAnualok = [];
                          barrasAnualfail = [];
                          barrasAnualdate = [];

                          barrasSemanalok = [];
                          barrasSemanalfail = [];
                          barrasSemanaldate = [];

                          barrasMensualok = [];
                          barrasMensualfail = [];
                          barrasMensualdate = [];
                          
                          for (var iAnu = 0; iAnu < yearlyok.length; iAnu++) {
                            barrasAnualok.push( yearlyok[iAnu] );
                            barrasAnualfail.push( yearlyfail[iAnu] );
                            barrasAnualdate.push( yearlydate[iAnu] );
                          }

                          for (var iMen = 0; iMen < montlyok.length; iMen++) {
                            barrasMensualok.push( montlyok[iMen] );
                            barrasMensualfail.push( montlyfail[iMen] );
                            barrasMensualdate.push( montlydate[iMen] );
                          }

                          for (var iSem = 0; iSem < weeklyok.length; iSem++) {
                            barrasSemanalok.push( weeklyok[iSem] );
                            barrasSemanalfail.push( weeklyfail[iSem] );
                            barrasSemanaldate.push( weeklydate[iSem] );
                          }

                          console.log(barrasSemanaldate);

                          var demoHighCharts = function () {

                            var demoHighLines = function () {

                                var line1 = $('#high-line-anual');

                                if (line1.length) {

                                    // High Line 1
                                    $('#high-line-anual').highcharts({
                                        credits: false,
                                        colors: Colors,
                                        chart: {
                                            type: 'column',
                                            zoomType: 'x',
                                            panning: true,
                                            panKey: 'shift',
                                            marginRight: 50,
                                            marginTop: -5
                                        },
                                        title: {
                                            text: null
                                        },
                                        xAxis: {
                                            gridLineColor: '#e5eaee',
                                            lineColor: '#e5eaee',
                                            tickColor: '#e5eaee',
                                            categories: barrasAnualdate
                                        },
                                        yAxis: {
                                            min: -2,
                                            tickInterval: 5,
                                            gridLineColor: '#e5eaee',
                                            title: {
                                                text: '',
                                                style: {
                                                    color: bgInfo,
                                                    fontWeight: '600'
                                                }
                                            }
                                        },
                                        plotOptions: {
                                            spline: {
                                                lineWidth: 3
                                            },
                                            area: {
                                                fillOpacity: 0.2
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        series: [{
                                            name: 'Transacciones Aprobadas',
                                            data: barrasAnualok
                                        }, {
                                            name: 'Transacciones Rechazadas',
                                            data: barrasAnualfail
                                        }]
                                    });

                                }

                                var line1mensual = $('#high-line-mensual');

                                if (line1mensual.length) {

                                    // High Line 1
                                    $('#high-line-mensual').highcharts({
                                        credits: false,
                                        colors: Colors,
                                        chart: {
                                            type: 'column',
                                            zoomType: 'x',
                                            panning: true,
                                            panKey: 'shift',
                                            marginRight: 50,
                                            marginTop: -5
                                        },
                                        title: {
                                            text: null
                                        },
                                        xAxis: {
                                            gridLineColor: '#e5eaee',
                                            lineColor: '#e5eaee',
                                            tickColor: '#e5eaee',
                                            categories: barrasMensualdate
                                        },
                                        yAxis: {
                                            min: -2,
                                            tickInterval: 5,
                                            gridLineColor: '#e5eaee',
                                            title: {
                                                text: '',
                                                style: {
                                                    color: bgInfo,
                                                    fontWeight: '600'
                                                }
                                            }
                                        },
                                        plotOptions: {
                                            spline: {
                                                lineWidth: 3
                                            },
                                            area: {
                                                fillOpacity: 0.2
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        series: [{
                                            name: 'Transacciones Aprobadas',
                                            data: barrasMensualok
                                        }, {
                                            name: 'Transacciones Rechazadas',
                                            data: barrasMensualfail
                                        }]
                                    });

                                }

                                var line1semanal = $('#high-line-semanal');

                                if (line1semanal.length) {

                                    // High Line 1
                                    $('#high-line-semanal').highcharts({
                                        credits: false,
                                        colors: Colors,
                                        chart: {
                                            type: 'column',
                                            zoomType: 'x',
                                            panning: true,
                                            panKey: 'shift',
                                            marginRight: 50,
                                            marginTop: -5
                                        },
                                        title: {
                                            text: null
                                        },
                                        xAxis: {
                                            gridLineColor: '#e5eaee',
                                            lineColor: '#e5eaee',
                                            tickColor: '#e5eaee',
                                            categories: barrasSemanaldate
                                        },
                                        yAxis: {
                                            min: -2,
                                            tickInterval: 5,
                                            gridLineColor: '#e5eaee',
                                            title: {
                                                text: '',
                                                style: {
                                                    color: bgInfo,
                                                    fontWeight: '600'
                                                }
                                            }
                                        },
                                        plotOptions: {
                                            spline: {
                                                lineWidth: 3
                                            },
                                            area: {
                                                fillOpacity: 0.2
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        series: [{
                                            name: 'Transacciones Aprobadas',
                                            data: barrasSemanalok
                                        }, {
                                            name: 'Transacciones Rechazadas',
                                            data: barrasSemanalfail
                                        }]
                                    });

                                }
                            };

                            demoHighLines();
                          }();
                    }else{
                        bootbox.alert({
                            message: respuesta.rows.error.message,
                            locale: 'mx'
                        });
                    }
                }
            });
        }
    });

    $('#buscar').click(function(event){
        event.preventDefault();
        $.ajax({
            url: base_url+"/dashboard/searchResults",
            data: $("#filtros").serialize(),
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $('#approvedTransactions').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                $('#failTransactions').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                $('#acceptancePercentage').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
                $('#accumulatedAmount').html('<img style="width: 20%;margin: 0 auto;" src="'+base_url+'/public/assets/img/loading.gif">');
            },
            success: function(respuesta){
                if(respuesta.rows.success == true){
                    //tabla

        switch($('#rango').val()) {
            case '0':
                rango = '';
                mood = '0';
                break;
            case '-1':
                rango = '';
                mood = '-1';
                break;
            case '-2':
                rango = '';  
                mood = '-2';              
                break;
            case '-3':
                rango = '';  
                mood = '-3';              
                break;
            case '-4':
                rango = ''; 
                mood = '-4';               
                break;
            case '-5':
                rango = ''; 
                mood = '-5';              
                break;
            case '-6':
                rango = '';
                mood = '-6';
                break;
            case '-7':
                rango = ''; 
                mood = '-7';               
                break;
            case '-8':
                rango = '';  
                mood = '-8';              
                break;
            case '-9':
                rango = '';
                mood = '-9';                
                break;
            case '-10':
                rango = ''; 
                mood = '-10';               
                break;
            case '-11':
                rango = $("#fechaI").val()+' 00:00 / '+$("#fechaF").val()+' 23:59'; 
                console.log('rango= '+rango);  
                mood = '';             
                break;
        }
                    $('#approvedTransactions').html('<a style="color: #626262;" href="transacciones?rango='+rango+'&estatus=00&subafiliado='+subAfiliado+'&entidad='+entidad+'&sucursal='+sucursal+'&caja='+caja+'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&mood=-11&type=1&page=1" ><span class="imoon imoon-thumbs-up"></span> '+respuesta.rows.dashboardResponse.approvedTransactions+'</a>');
                    $('#failTransactions').html('<a style="color: #626262;" href="transacciones?rango='+rango+'&estatus=00&subafiliado='+subAfiliado+'&entidad='+entidad+'&sucursal='+sucursal+'&caja='+caja+'&monto=&typeOperation=&referencia=&autorizacion=&bin=&numTarjeta=&mood=-11&type=-1&page=1" ><span class="imoon imoon-thumbs-up2"></span> '+respuesta.rows.dashboardResponse.failTransactions+'</a>');
                    $('#acceptancePercentage').html(respuesta.rows.dashboardResponse.acceptancePercentage+' <span class="fas fa-percentage"></span>');
                    $('#accumulatedAmount').html('<i class="fas fa-dollar-sign"></i> '+respuesta.rows.dashboardResponse.accumulatedAmount+' <span class="fas fa-file-invoice-dollar"></span>');
                    //Grafica pastel
                    var Colors = [bgPrimary, bgSuccess, bgInfo, bgWarning, bgAlert, bgDanger, bgSystem]; 
                    porcentajes = respuesta.rows.dashboardResponse.doughnutSettings.percentages;
                    marcas = respuesta.rows.dashboardResponse.doughnutSettings.brands;
                    for (var i = 0; i < porcentajes.length; i++) {
                        pastel.push( [marcas[i],  porcentajes[i]]);
                    }
                    var chart10 = c3.generate({
                        bindto: '#donut-chart',
                        color: {
                          pattern: Colors
                        },
                        data: {
                            columns: 
                                pastel
                            ,
                            type : 'donut',
                            onclick: function (d, i) { console.log("onclick", d, i); },
                            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                        },
                        donut: {
                            title: "Porcentaje de aceptación"
                        }
                    });
                    //Grafica Barras
                      if(respuesta.rows.dashboardResponse.weekly.ok != null){
                        weeklyok = [] = respuesta.rows.dashboardResponse.weekly.ok;
                      }else{
                        weeklyok = [] = '0';
                      }
                      if(respuesta.rows.dashboardResponse.weekly.fail != null){
                        weeklyfail = [] = respuesta.rows.dashboardResponse.weekly.fail;
                      }else{
                        weeklyfail = [] = '0';
                      }
                      if(respuesta.rows.dashboardResponse.weekly.date != null){
                        weeklydate = [] = respuesta.rows.dashboardResponse.weekly.date;
                      }else{
                        weeklydate = [] = '0';
                      }

                      if(respuesta.rows.dashboardResponse.montly.ok != null){
                        montlyok = [] = respuesta.rows.dashboardResponse.montly.ok;
                      }else{
                        montlyok = [] = '0';
                      }
                      if(respuesta.rows.dashboardResponse.montly.fail != null){
                        montlyfail = [] = respuesta.rows.dashboardResponse.montly.fail;
                      }else{
                        montlyfail = [] = '0';
                      }
                      if(respuesta.rows.dashboardResponse.montly.date != null){
                        montlydate = [] = respuesta.rows.dashboardResponse.montly.date;
                      }else{
                        montlydate = [] = '0';
                      }

                      if(respuesta.rows.dashboardResponse.yearly.ok != null){
                        yearlyok = [] = respuesta.rows.dashboardResponse.yearly.ok;
                      }else{
                        yearlyok = [] = '0';
                      }
                      if(respuesta.rows.dashboardResponse.yearly.fail != null){
                        yearlyfail = [] = respuesta.rows.dashboardResponse.yearly.fail;
                      }else{
                        yearlyfail = []  = '0';
                      }
                      if(respuesta.rows.dashboardResponse.yearly.date != null){
                        yearlydate = [] = respuesta.rows.dashboardResponse.yearly.date;
                      }else{
                        yearlydate = [] = '0';
                      }

                      barrasAnualok = [];
                      barrasAnualfail = [];
                      barrasAnualdate = [];

                      barrasSemanalok = [];
                      barrasSemanalfail = [];
                      barrasSemanaldate = [];

                      barrasMensualok = [];
                      barrasMensualfail = [];
                      barrasMensualdate = [];
                      
                      for (var iAnu = 0; iAnu < yearlyok.length; iAnu++) {
                        barrasAnualok.push( yearlyok[iAnu] );
                        barrasAnualfail.push( yearlyfail[iAnu] );
                        barrasAnualdate.push( yearlydate[iAnu] );
                      }

                      for (var iMen = 0; iMen < montlyok.length; iMen++) {
                        barrasMensualok.push( montlyok[iMen] );
                        barrasMensualfail.push( montlyfail[iMen] );
                        barrasMensualdate.push( montlydate[iMen] );
                      }

                      for (var iSem = 0; iSem < weeklyok.length; iSem++) {
                        barrasSemanalok.push( weeklyok[iSem] );
                        barrasSemanalfail.push( weeklyfail[iSem] );
                        barrasSemanaldate.push( weeklydate[iSem] );
                      }

                      console.log(barrasSemanaldate);

                      var demoHighCharts = function () {

                        var demoHighLines = function () {

                            var line1 = $('#high-line-anual');

                            if (line1.length) {

                                // High Line 1
                                $('#high-line-anual').highcharts({
                                    credits: false,
                                    colors: Colors,
                                    chart: {
                                        type: 'column',
                                        zoomType: 'x',
                                        panning: true,
                                        panKey: 'shift',
                                        marginRight: 50,
                                        marginTop: -5
                                    },
                                    title: {
                                        text: null
                                    },
                                    xAxis: {
                                        gridLineColor: '#e5eaee',
                                        lineColor: '#e5eaee',
                                        tickColor: '#e5eaee',
                                        categories: barrasAnualdate
                                    },
                                    yAxis: {
                                        min: -2,
                                        tickInterval: 5,
                                        gridLineColor: '#e5eaee',
                                        title: {
                                            text: '',
                                            style: {
                                                color: bgInfo,
                                                fontWeight: '600'
                                            }
                                        }
                                    },
                                    plotOptions: {
                                        spline: {
                                            lineWidth: 3
                                        },
                                        area: {
                                            fillOpacity: 0.2
                                        }
                                    },
                                    legend: {
                                        enabled: false
                                    },
                                    series: [{
                                        name: 'Transacciones Aprobadas',
                                        data: barrasAnualok
                                    }, {
                                        name: 'Transacciones Rechazadas',
                                        data: barrasAnualfail
                                    }]
                                });

                            }

                            var line1mensual = $('#high-line-mensual');

                            if (line1mensual.length) {

                                // High Line 1
                                $('#high-line-mensual').highcharts({
                                    credits: false,
                                    colors: Colors,
                                    chart: {
                                        type: 'column',
                                        zoomType: 'x',
                                        panning: true,
                                        panKey: 'shift',
                                        marginRight: 50,
                                        marginTop: -5
                                    },
                                    title: {
                                        text: null
                                    },
                                    xAxis: {
                                        gridLineColor: '#e5eaee',
                                        lineColor: '#e5eaee',
                                        tickColor: '#e5eaee',
                                        categories: barrasMensualdate
                                    },
                                    yAxis: {
                                        min: -2,
                                        tickInterval: 5,
                                        gridLineColor: '#e5eaee',
                                        title: {
                                            text: '',
                                            style: {
                                                color: bgInfo,
                                                fontWeight: '600'
                                            }
                                        }
                                    },
                                    plotOptions: {
                                        spline: {
                                            lineWidth: 3
                                        },
                                        area: {
                                            fillOpacity: 0.2
                                        }
                                    },
                                    legend: {
                                        enabled: false
                                    },
                                    series: [{
                                        name: 'Transacciones Aprobadas',
                                        data: barrasMensualok
                                    }, {
                                        name: 'Transacciones Rechazadas',
                                        data: barrasMensualfail
                                    }]
                                });

                            }

                            var line1semanal = $('#high-line-semanal');

                            if (line1semanal.length) {

                                // High Line 1
                                $('#high-line-semanal').highcharts({
                                    credits: false,
                                    colors: Colors,
                                    chart: {
                                        type: 'column',
                                        zoomType: 'x',
                                        panning: true,
                                        panKey: 'shift',
                                        marginRight: 50,
                                        marginTop: -5
                                    },
                                    title: {
                                        text: null
                                    },
                                    xAxis: {
                                        gridLineColor: '#e5eaee',
                                        lineColor: '#e5eaee',
                                        tickColor: '#e5eaee',
                                        categories: barrasSemanaldate
                                    },
                                    yAxis: {
                                        min: -2,
                                        tickInterval: 5,
                                        gridLineColor: '#e5eaee',
                                        title: {
                                            text: '',
                                            style: {
                                                color: bgInfo,
                                                fontWeight: '600'
                                            }
                                        }
                                    },
                                    plotOptions: {
                                        spline: {
                                            lineWidth: 3
                                        },
                                        area: {
                                            fillOpacity: 0.2
                                        }
                                    },
                                    legend: {
                                        enabled: false
                                    },
                                    series: [{
                                        name: 'Transacciones Aprobadas',
                                        data: barrasSemanalok
                                    }, {
                                        name: 'Transacciones Rechazadas',
                                        data: barrasSemanalfail
                                    }]
                                });

                            }
                        };

                        demoHighLines();
                      }();
                }else{
                    bootbox.alert({
                        message: respuesta.rows.error.message,
                        locale: 'mx'
                    });
                }
            }
        });
    });



});
